<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\User;
use App\Form\ApiSearchType;
use App\Form\OmdbType;
use App\Service\APIKeyGenerator;
use App\Service\OmdbService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APIController extends AbstractFOSRestController {

    #[Rest\Get('/api/v1/movies', name:'app_api_apimovies')]
    #[Serializer\MaxDepth(1)]
    public function apimovies(EntityManagerInterface $entityManager, Request $request, LoggerInterface $logger, SerializerInterface $serializer) {

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

    #[Rest\Post('/api/v1/movies/create', name:'app_api_apiaddbyomdbid')]
    public function apiAddByOmdbId(EntityManagerInterface $entityManager, OmdbService $omdb, Request $request) {
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

            $movie = new Movie();
            $movie->setName($omdbdata['Title']);
            $movie->setRunningtime($omdbdata['Runtime']);
            $movie->setActors($omdbdata['Actors']);
            $movie->setDirector($omdbdata['Director']);
            $movie->setOmdbid($omdbdata['imdbID']);
            $movie->setImagePath($omdbdata['Poster']);

            $entityManager->persist($movie);
            $entityManager->flush();

            $view = $this->view($this->generateUrl('app_api_apigetmoviebyimdbid', array('imdbid' => $movie->getOmdbid())), Response::HTTP_CREATED);
            return $this->handleView($view);
        }

        $view = $this->view('Invalid format', Response::HTTP_NOT_FOUND);
        return $this->handleView($view);
    }
}