<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\User;
use App\Service\APIKeyGenerator;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class APIController extends AbstractFOSRestController {

    #[Rest\Get('/api/v1/movies/', name:'app_api_apimovies')]
    #[Serializer\MaxDepth(1)]
    public function apimovies(EntityManagerInterface $entityManager, Request $request, LoggerInterface $logger, SerializerInterface $serializer) {
        $this->denyAccessUnlessGranted('ROLE_API');

        $data = json_decode($request->getContent());

        $logger->info('Called with key prefix: ' . $request->getContent());

        $movies = $entityManager->getRepository(Movie::class)->findAll();

        return $this->handleView($this->view($movies));
    }
}