<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\Request;

class APIController extends AbstractFOSRestController {

    #[Rest\Get('/api/v1/movies/', name:'app_api_apimovies')]
    #[Serializer\MaxDepth(1)]
    public function apimovies(EntityManagerInterface $entityManager, Request $request) {
        $movies = $entityManager->getRepository(Movie::class)->findAll();

        $data = json_encode($movies);

        return $this->handleView($this->view($data));
    }
}