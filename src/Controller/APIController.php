<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ApiMovieSearchType;
use App\Form\ApiMovieType;
use App\Form\ApiReviewType;
use App\Form\ApiSearchType;
use App\Form\MovieIdType;
use App\Form\MovieType;
use App\Form\OmdbType;
use App\Form\ReviewType;
use App\Repository\MovieRepository;
use App\Service\APIKeyGenerator;
use App\Service\MovieService;
use App\Service\OmdbService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;
use Pagerfanta\Pagerfanta;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;
use Pagerfanta\Doctrine\ORM\QueryAdapter;

class APIController extends AbstractFOSRestController {

    #[Rest\Get('/api/v1/movies/getmovies/{page}', name:'app_api_apimovies')]
    #[Serializer\MaxDepth(1)]
    #[OA\Response(
        response: 200,
        description: 'Returns an array of movie objects',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'objects', type: 'array', items: new OA\Items(ref: new Model(type: Movie::class))),
            ],
            type: 'object',
            example: '{  "code":200,"response": "success",  "objects": [    {      "id": 0,      "name": "string",      "studio": "string",      "avg_rating": 0,      "ratings": [        {          "id": 0,          "rating": 0,          "comment": "string",          "author": {            "id": 0,           "email": "string"          },          "movie": "string",          "review_ratings": [            {              "id": 0,              "rating": 0,             "review": "string",              "user": {                "id": 0,                "email": "string"              }            }          ]        }      ],      "director": "string",      "actors": "string",      "runningtime": "string",      "omdbid": "string"    }]}'
        ),
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Not Found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":404,"response": "error", "description": "No movies could be found."}'
        )
    )]
    #[OA\Tag(name: 'Standard')]
    #[Security(name: 'Bearer')]
    public function apimovies(EntityManagerInterface $entityManager, MovieRepository $movieRepository, int $page) {
        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $movies = $entityManager->getRepository(Movie::class)->findAll();

        if ($movies == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'No movies could be found.'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $queryBuilder = $movieRepository->createMovieQueryBuilder();

        $pager = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        $pager->setMaxPerPage(10);

        $pager->setCurrentPage($page);

        $view = $this->view(array('code' => 200, 'response' => 'success', 'objects' => $pager->getCurrentPageResults()), Response::HTTP_OK);

        return $this->handleView($view);
    }

    #[Rest\Get('/api/v1/movies/getbyid/{id}', name: 'app_api_apigetmoviebyid')]
    #[OA\Response(
        response: 200,
        description: 'Responds with the movie searched from ID',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'object', ref: new Model(type: Movie::class), type: 'object'),
            ],
            type: 'object',
            example: '{
  "code": 200,
  "response": "success",
  "object": {
    "id": 0,
    "name": "string",
    "studio": "string",
    "avg_rating": 0,
    "ratings": [
      {
        "id": 0,
        "rating": 0,
        "comment": "string",
        "author": {
          "id": 0,
          "email": "string"
        },
        "movie": "string",
        "review_ratings": [
          {
            "id": 0,
            "rating": 0,
            "review": "string",
            "user": {
              "id": 0,
              "email": "string"
            }
          }
        ]
      }
    ],
    "director": "string",
    "actors": "string",
    "runningtime": "string",
    "omdbid": "string"
  }
}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not find the specified movie',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":404,"response":"error", "description": "Movie not found."}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[OA\Tag(name: 'Standard')]
    #[Security(name: 'Bearer')]
    public function apiGetMovieById(int $id, EntityManagerInterface $entityManager) {
        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if ($movie == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Movie not found.'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        return $this->handleView($this->view(array('code' => 200, 'response' => 'success', 'object' => $movie), Response::HTTP_OK));
    }






    #[Rest\Get('/api/v1/movies/{id}/getreviews', name: 'app_api_getreviewsbymovie')]
    #[OA\Response(
        response: 200,
        description: 'Responds with the reviews for the specified movie.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'objects', type: 'array', items: new OA\Items(ref: new Model(type: Review::class))),
            ],
            example: '{"code":200,"response":"success","objects":[{"id":0,"rating":0,"comment":"string","author":{"id":0,"email":"string"}}]}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not find the specified movie',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":404,"response":"error", "description": "Movie not found."}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: "Standard")]
    public function getReviewsByMovie(EntityManagerInterface $entityManager, int $id) {

        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if($movie == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Movie not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $reviews = $movie->getReviews();

        $view = $this->view(array('code' => 200, 'response' => 'success', 'objects' => $reviews), Response::HTTP_OK);
        return $this->handleView($view);
    }


    #[Rest\Get('/api/v1/reviews/{id}', name: 'app_api_getreviewsbyid')]
    #[OA\Response(
        response: 200,
        description: 'Responds with the review with the ID specified',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'object', ref: new Model(type: Review::class), type: 'object'),
            ],
            type: 'object',
            example: '{
  "code" : 200,
  "response": "success",
  "object": {
    "id": 0,
    "rating": 0,
    "comment": "string",
    "author": {
      "id": 0,
      "email": "string"
    }
  }
}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: 'Standard')]
    public function getReviewById(EntityManagerInterface $entityManager, int $id) {
        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }


        $review = $entityManager->getRepository(Review::class)->find($id);

        if($review == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Review not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $view = $this->view(array('code' => 200, 'response' => 'success', 'object' => $review), Response::HTTP_OK);
        return $this->handleView($view);
    }


    #[Rest\Post('/api/v1/movies/{movieid}/postreview', name: 'app_api_postreview')]
    #[OA\Response(
        response: 201,
        description: 'Posts a review for the specified movie.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'location', type: 'string'),
            ],
            type: 'object',
            example: '{"code":201,"response":"success", "id": 0, "location":"/api/v1/reviews/0"}'
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad Request',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":400,"response":"error", "description":"Bad Request"}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Movie not found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string')
            ],
            type: 'object',
            example: '{"code":404,"response":"error","description":"Movie not found"}'
        )
    )]
    #[OA\RequestBody(
        description: 'Review content',
        required: true,
        content: new Model(type: ApiReviewType::class)
    )]
    #[OA\Tag(name: 'Standard')]
    #[Security(name: 'Bearer')]
    public function postReviewById(int $movieid, EntityManagerInterface $entityManager, Request $request) {
        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $movie = $entityManager->getRepository(Movie::class)->find($movieid);

        if($movie == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Movie not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $form = $this->createForm(ApiReviewType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $review = new Review();
            $review->setMovie($movie);
            $review->setAuthor($entityManager->getRepository(User::class)->find($this->getUser()));
            $review->setRating($data['rating']);
            $review->setComment($data['comment']);

            $entityManager->persist($review);
            $entityManager->flush();

            $review = $entityManager->getRepository(Review::class)->find($review);
            $newid = $review->getId();

            $view = $this->view(array('code' => 201, 'response' => 'success', 'id' => $newid, 'location' => '/api/v1/reviews/'.$newid), Response::HTTP_CREATED);
        } else {
            $view = $this->view(array('code' => 400, 'response' => 'error', 'description' => 'Invalid request'), Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);

    }


    #[Rest\Put('/api/v1/reviews/{id}/put', name: 'app_api_put_review')]
    #[OA\Response(
        response: 200,
        description: 'Review updated',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":200,"response":"success", "description":"Review updated"}'
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad Request',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'integer'),
            ],
            type: 'object',
            example: '{"code":400,"response":"error", "description":"Bad Request"}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Review not found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":404,"response":"error", "description":"Review not found"}'
        )
    )]
    #[OA\RequestBody(
        description: 'Review content',
        required: true,
        content: new Model(type: ApiReviewType::class)
    )]
    #[OA\Tag(name: 'Standard')]
    #[Security(name: 'Bearer')]
    public function putReviewById(int $id, EntityManagerInterface $entityManager, Request $request) {

        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $review = $entityManager->getRepository(Review::class)->find($id);

        if($review == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Review not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $user = $entityManager->getRepository(User::class)->find($this->getUser());


        if ($review->getAuthor()->getId() !== $user->getId() && !$this->isGranted('ROLE_MOD')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $form = $this->createForm(ApiReviewType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setRating($data['rating']);
            $review->setComment($data['comment']);

            $entityManager->persist($review);
            $entityManager->flush();

            $view = $this->view(array('code' => 201, 'response' => 'success', 'description' => 'Review updated'), Response::HTTP_CREATED);
        } else {
            $view = $this->view(array('code' => 400, 'response' => 'error', 'description' => 'Invalid request'), Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);

    }


    #[Rest\Delete('/api/v1/reviews/{id}/delete', name: 'app_api_delete_review')]
    #[OA\Response(
        response: 200,
        description: 'Review deleted',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":200,"response":"success", "description":"Review deleted"}'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'error', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":401,"response":"error", "description":"Unauthorized"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Forbidden',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":403,"response": "error", "description": "Forbidden"}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Review not found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', type: 'integer'),
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"code":404,"response":"error", "description":"Review not found"}'
        )
    )]
    #[OA\Tag(name: 'Standard')]
    #[Security(name: 'Bearer')]
    public function deleteReviewById($id, EntityManagerInterface $entityManager) {
        if(!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $view = $this->view(array('code' => 401, 'response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_UNAUTHORIZED);
            return $this->handleView($view);
        }

        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $review = $entityManager->getRepository(Review::class)->find($id);

        if($review == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Review not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $user = $entityManager->getRepository(User::class)->find($this->getUser());


        if ($review->getAuthor()->getId() !== $user->getId() && !$this->isGranted('ROLE_MOD')) {
            $view = $this->view(array('code' => 403, 'response' => 'error', 'description' => 'Forbidden'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }

        $review = $entityManager->getRepository(Review::class)->find($id);
        if($review == null) {
            $view = $this->view(array('code' => 404, 'response' => 'error', 'description' => 'Review not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $entityManager->remove($review);
        $entityManager->flush();
        $view = $this->view(array('code' => 200, 'response' => 'success', 'description' => 'Review deleted'), Response::HTTP_OK);
        return $this->handleView($view);

    }

}