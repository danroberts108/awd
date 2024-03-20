<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\User;
use App\Form\ApiMovieSearchType;
use App\Form\ApiMovieType;
use App\Form\ApiSearchType;
use App\Form\MovieType;
use App\Form\OmdbType;
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
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class APIController extends AbstractFOSRestController {

    #[Rest\Get('/api/v1/movies', name:'app_api_apimovies')]
    #[Serializer\MaxDepth(1)]
    #[OA\Response(
        response: 200,
        description: 'Returns an array of movie objects',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Movie::class))
        )
    )]
    #[Security(name: 'Bearer')]
    public function apimovies(EntityManagerInterface $entityManager, Request $request, LoggerInterface $logger) {

        $data = json_decode($request->getContent());

        $logger->info('Called with key prefix: ' . $request->getContent());

        $movies = $entityManager->getRepository(Movie::class)->findAll();

        return $this->handleView($this->view($movies));
    }

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
    #[OA\Parameter(
        name: 'term',
        description: 'The search term',
        schema: new OA\Schema(type: 'string')
    )]
    #[Security(name: 'Bearer')]
    public function apiSearchMovie(EntityManagerInterface $entityManager, Request $request) {

        $form = $this->createForm(ApiSearchType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
            $movies = $entityManager->getRepository(Movie::class)->search($data['term']);
            return $this->handleView($this->view($movies));
        }

        $view = $this->view('Invalid Data', Response::HTTP_NOT_FOUND);
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
    #[OA\Parameter(
        name: 'term',
        description: 'The IMDB ID',
        schema: new OA\Schema(type: 'string')
    )]
    #[Security(name: 'Bearer')]
    public function apiGetMovieByImdbId(string $imdbid, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(array('omdbid' => $imdbid));
        return $this->handleView($this->view($movie));
    }

    #[Rest\Get('/api/v1/movies/get/id/{id}', name: 'app_api_apigetmoviebyid')]
    #[OA\Response(
        response: 200,
        description: 'Responds with the movie searched from ID'
    )]
    #[OA\Response(
        response: 404,
        description: 'Could not find the specified movie'
    )]
    #[Security(name: 'Bearer')]
    public function apiGetMovieById(int $id, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        return $this->handleView($this->view($movie));
    }

    #[Rest\Get('/api/v1/movies/get/id/{id}/image', name:'app_api_apigetmovieimagebyid')]
    #[OA\Response(
        response: 200,
        description: 'Web address of movie location',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'poster', type: 'string')
            ],
            type: 'object'
        )
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'Movie ID',
        schema: new OA\Schema(type: 'int')
    )]
    #[Security(name: 'Bearer')]
    public function apiGetMovieImageById(int $id, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        return $this->handleView($this->view($movie->getImagePath()));
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
    #[OA\Parameter(
        name: 'imdbid',
        description: 'Movie IMDB ID',
        schema: new OA\Schema(type: 'string')
    )]
    #[Security(name: 'Bearer')]
    public function apiAddByOmdbId(OmdbService $omdb, Request $request, MovieService $movieService) {
        $form = $this->createForm(OmdbType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
            $response = $omdb->findById($data['imdbid']);
            if ($response == null) {
                $error = json_encode(array('error' => 'Invalid IMDB ID'));
                $view = $this->view($error, Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $omdbdata = json_decode($response, true);

            if (!$omdbdata['Response']) {
                $error = json_encode(array('error' => 'Invalid IMDB ID'));
                $view = $this->view($error, Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }

            $movie = $movieService->createMovie($omdbdata);

            $view = $this->view($this->generateUrl('app_api_getmoviebyimdbid', array('imdbid' => $movie->getOmdbid())), Response::HTTP_CREATED);
            return $this->handleView($view);
        }

        $error = json_encode(array('error' => 'Movie not found'));

        $view = $this->view($error, Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
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
                $view = $this->view('No results for search term.', Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $response = stripcslashes($response);
            $omdbdata = json_decode($response, true);
            $results = (array) json_decode($omdbdata['Search'], true);
            if (sizeof($results) > 1) {
                $view = $this->view('Too many results. Try to narrow down your search term or add a year of release.', Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $movie = $movieService->createMovie($omdbdata);

            $responsearray[] = ['location' => $this->generateUrl('app_api_getmoviebyid', array('id' => $movie->getId())), 'title' => $movie->getName()];
            $responsejson = json_encode($responsearray);

            $view = $this->view($responsejson, Response::HTTP_CREATED);
            $this->handleView($view);
        }

        $view = $this->view('Invalid Format', Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
    }

    #[Rest\Post('/api/v1/movies/edit/id/{id}', name: 'app_api_apieditbyid')]
    #[Security(name: 'Bearer')]
    public function apiEditById(int $id, MovieService $movieService, Request $request) {
        $form = $this->createForm(ApiMovieType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {

        }



    }

}