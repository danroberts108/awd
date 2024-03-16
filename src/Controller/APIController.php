<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\User;
use App\Form\ApiMovieSearchType;
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
use Nelmio\ApiDocBundle\Model\Model;
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
    public function apimovies(EntityManagerInterface $entityManager, Request $request, LoggerInterface $logger) {

        $data = json_decode($request->getContent());

        $logger->info('Called with key prefix: ' . $request->getContent());

        $movies = $entityManager->getRepository(Movie::class)->findAll();

        return $this->handleView($this->view($movies));
    }

    #[Rest\Post('/api/v1/movies/search', name:'app_api_apisearchmovie')]
    #[Serializer\MaxDepth(1)]
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
    public function apiGetMovieByImdbId(string $imdbid, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(array('omdbid' => $imdbid));
        return $this->handleView($this->view($movie));
    }

    #[Rest\Get('/api/v1/movies/get/id/{id}', name: 'app_api_apigetmoviebyid')]
    public function apiGetMovieById(int $id, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        return $this->handleView($this->view($movie));
    }

    #[Rest\Get('/api/v1/movies/get/id/{id}/image', name:'app_api_apigetmovieimagebyid')]
    public function apiGetMovieImageById(int $id, EntityManagerInterface $entityManager) {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        return $this->handleView($this->view($movie->getImagePath()));
    }

    #[Rest\Post('/api/v1/movies/createbyid', name:'app_api_apiaddbyomdbid')]
    public function apiAddByOmdbId(OmdbService $omdb, Request $request, MovieService $movieService) {
        $form = $this->createForm(OmdbType::class);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isValid() && $form->isSubmitted()) {
            $response = $omdb->findById($data['imdbid']);
            if ($response == null) {
                $view = $this->view('Invalid IMDB ID', Response::HTTP_NOT_FOUND);
                return $this->handleView($view);
            }
            $omdbdata = json_decode($response, true);

            $movie = $movieService->createMovie($omdbdata);

            $view = $this->view($this->generateUrl('app_api_getmoviebyimdbid', array('imdbid' => $movie->getOmdbid())), Response::HTTP_CREATED);
            return $this->handleView($view);
        }

        $view = $this->view('Invalid format', Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
    }

    #[Rest\Post('/api/v1/movies/createbysearch', name: 'app_api_addbyomdbsearch')]
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
}