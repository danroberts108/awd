<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Form\ApiMovieSearchType;
use App\Form\ApiMovieType;
use App\Form\ApiSearchType;
use App\Form\OmdbType;
use App\Service\MovieService;
use App\Service\OmdbService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Nelmio\ApiDocBundle\Annotation\Security;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class APIExtraController extends AbstractFOSRestController
{
    #[Rest\Post('/api/v1/movies/search', name:'app_api_apisearchmovie')]
    #[Serializer\MaxDepth(1)]
    #[OA\Response(
    response: 200,
    description: 'Searches for a movie on OMDB from ther API',
    content: new OA\JsonContent(
    type: 'array',
    items: new OA\Items(ref: new Model(type: Movie::class))
    )
    )]
    #[OA\Response(
    response: 404,
    description: 'Could not find any movies'
    )]
    #[OA\Response(
    response: 403,
    description: 'Not Authorized',
    content: new OA\JsonContent(
    properties: [
    new OA\Property(property: 'error', type: 'string')
    ],
    type: 'object'
    )
    )]
    #[OA\Parameter(
    name: 'term',
    description: 'The search term',
    schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'Extended')]
    #[Security(name: 'Bearer')]
    public function apiSearchMovie(EntityManagerInterface $entityManager, Request $request) {

    $form = $this->createForm(ApiSearchType::class);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);

    if ($form->isValid() && $form->isSubmitted()) {
    $movies = $entityManager->getRepository(Movie::class)->search($data['term']);
    return $this->handleView($this->view($movies));
    }

    $view = $this->view(array('response' => 'error', 'description' => 'Data submitted is malformed.'), Response::HTTP_NOT_FOUND);
    return $this->handleView($view);

    }

    #[Rest\Get('/api/v1/movies/get/imdb/{imdbid}', name: 'app_api_apigetmoviebyimdbid')]
    #[OA\Response(
    response: 200,
    description: 'Searches for a movie on OMDB from ther API by IMDB ID'
    )]
    #[OA\Response(
    response: 404,
    description: 'Could not find the specified movie'
    )]
    #[OA\Response(
    response: 403,
    description: 'Not Authorized',
    content: new OA\JsonContent(
    properties: [
    new OA\Property(property: 'error', type: 'string')
    ],
    type: 'object'
    )
    )]
    #[OA\Parameter(
    name: 'term',
    description: 'The IMDB ID',
    schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'Extended')]
    #[Security(name: 'Bearer')]
    public function apiGetMovieByImdbId(string $imdbid, EntityManagerInterface $entityManager) {
    $movie = $entityManager->getRepository(Movie::class)->findOneBy(array('omdbid' => $imdbid));

    if ($movie == null) {
    $view = $this->view(array('error' => 'Movie ID could not be found'));
    return $this->handleView($view);
    }

    return $this->handleView($this->view($movie));
    }

    #[Rest\Post('/api/v1/movies/createbyid', name:'app_api_apiaddbyomdbid')]
    #[OA\Response(
        response: 200,
        description: 'Creates a movie from an IMDB',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'location', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Not Authorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Parameter(
        name: 'imdbid',
        description: 'Movie IMDB ID',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Tag(name: 'Extended')]
    #[Security(name: 'Bearer')]
    public function apiAddByOmdbId(OmdbService $omdb, Request $request, MovieService $movieService, LoggerInterface $logger) {
        $form = $this->createForm(OmdbType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
            $response = $omdb->findById($data['imdbid']);
            if ($response == null) {
                $error = array('error' => 'Invalid IMDB ID');
                $view = $this->view($error, Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $omdbdata = json_decode($response, true);

            if ($omdbdata['Response'] == "False") {
                $error = array('error' => 'Invalid IMDB ID');
                $view = $this->view($error, Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }

            $movie = $movieService->createMovie($omdbdata);

            $view = $this->view($this->generateUrl('app_api_getmoviebyimdbid', array('imdbid' => $movie->getOmdbid())), Response::HTTP_CREATED);
            return $this->handleView($view);
        }

        $error = array('error' => 'Movie not found');

        $view = $this->view($error, Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
    }

    #[Rest\Get('/api/v1/movies/getbyid/{id}/image', name:'app_api_apigetmovieimagebyid')]
    #[OA\Response(
        response: 200,
        description: 'Web address of movie location',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'poster', type: 'string')
            ],
            type: 'object',
            example: '{"response":"success", "poster": "https://example.com/poster.jpg"}'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Not Authorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"response":"error", "description": "Not Authorized"}'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Movie Not Found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string'),
            ],
            type: 'object',
            example: '{"response":"error", "description": "Movie not found."}'
        )
    )]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: "Extended")]
    public function apiGetMovieImageById(int $id, EntityManagerInterface $entityManager) {
        if(!$this->isGranted('ROLE_API')) {
            $view = $this->view(array('response' => 'error', 'description' => 'Not Authorized'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if ($movie == null) {
            $view = $this->view(array('response' => 'error', 'description' => 'Movie ID could not be found'));
            return $this->handleView($view);
        }

        return $this->view(array('response' => 'success', 'poster' => $movie->getImagePath()), Response::HTTP_OK);
    }

    #[Rest\Post('/api/v1/movies/createbysearch', name: 'app_api_addbyomdbsearch')]
    #[Security(name: 'Bearer')]
    #[OA\Response(
        response: 201,
        description: 'Movie created from search',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'location', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not create a movie from search',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 403,
        description: 'Not Authorized',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Parameter(
        name: 'title',
        description: 'Movie title to search for',
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'year',
        description: 'Movie year',
        required: false,
        schema: new OA\Schema(type: 'int')
    )]
    #[OA\Tag(name: 'Extended')]
    public function addByOmdbSearch(OmdbService $omdb, Request $request, MovieService $movieService, LoggerInterface $logger) {
        $form = $this->createForm(ApiMovieSearchType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
            if ($data['year'] != null) {
                $response = $omdb->searchByTitle($data['title'], $data['year']);
            } else {
                $response = $omdb->searchByTitle($data['title']);
            }

            if ($response == null) {
                $view = $this->view(array('error' => 'No results for search term.'), Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $response = stripcslashes($response);
            $omdbdata = json_decode($response, true);
            $results = (array) json_decode($omdbdata['Search'], true);
            if (sizeof($results) > 1) {
                $error = array('error' => 'Too many results. Try to narrow down your search term or add a year of release.');
                $view = $this->view($error, Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $movie = $movieService->createMovie($omdbdata);

            $responsearray[] = ['location' => $this->generateUrl('app_api_getmoviebyid', array('id' => $movie->getId())), 'title' => $movie->getName()];

            $view = $this->view($responsearray, Response::HTTP_CREATED);
            $this->handleView($view);
        }

        $error = array('error' => 'Invalid Format');
        $view = $this->view($error, Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
    }

    #[Rest\Put('/api/v1/movies/put/', name: 'app_api_apiputbyid')]
    #[Security(name: 'Bearer')]
    #[OA\Response(
        response: 200,
        description: 'Movie updated with submitted information.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'location', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not find movie to update.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Either no data was submitted, or the data submitted was malformed or in the wrong format.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'error', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Parameter(
        name: 'movie',
        description: 'Movie Object',
        schema: new OA\Schema(type: Movie::Class)
    )]
    #[OA\Tag(name: 'Extended')]
    public function apiPutById(MovieService $movieService, Request $request, EntityManagerInterface $entityManager) {
        $form = $this->createForm(ApiMovieType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data['movie']);

        //TODO : Test this call

        if ($form->isValid() && $form->isSubmitted()) {
            $movie = $entityManager->getRepository(Movie::class)->find($form->get('id'));

            if($movie == null) {
                $view = $this->view(array('error' => 'Movie not found'), Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }

            $movie = $form->getData();

            $entityManager->persist($movie);
            $entityManager->flush();

            $view = $this->view(array('location' => $this->generateUrl('app_api_apigetmoviebyid', array('id' => $movie->getId()))), Response::HTTP_OK);
            return $this->handleView($view);
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $view = $this->view(array('error' => 'Bad Request'), Response::HTTP_BAD_REQUEST);
            return $this->handleView($view);
        }

        $view = $this->view(array('error' => 'No data submitted'), Response::HTTP_BAD_REQUEST);
        return $this->handleView($view);
    }

    #[Rest\Delete('/api/v1/movies/delete/{id}', name: 'app_api_apideletebyid')]
    #[Security(name: 'Bearer')]
    #[OA\Response(
        response: 403,
        description: 'Not Authorized.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not find movie to delete.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'error'),
                new OA\Property(property: 'description', type: 'string')
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Movie deleted.',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'response', type: 'string'),
                new OA\Property(property: 'description', type: 'string')
            ]
        )
    )]
    #[OA\Tag(name: 'Extended')]
    public function apiDeleteById(MovieService $movieService, EntityManagerInterface $entityManager, \Symfony\Bundle\SecurityBundle\Security $security, int $id) {
        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if ($movie == null) {
            $view = $this->view(array('error' => 'Movie not found'), Response::HTTP_NOT_FOUND);
            return $this->handleView($view);
        }

        if ($this->isGranted('ROLE_MOD')) {
            $entityManager->remove($movie);
            $entityManager->flush();
            $view = $this->view(array('response' => 'success'), Response::HTTP_OK);
            return $this->handleView($view);
        } else {
            $view = $this->view(array('response' => 'failed', 'description' => 'Not authorized'), Response::HTTP_FORBIDDEN);
            return $this->handleView($view);
        }


    }
}
