<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModController extends AbstractController {

    #[Route('/mod/index', name: 'mod_index')]
    public function index() : Response {
        return $this->render('mod/index.html.twig');
    }

    #[Route('/mod/reported', name: 'reported_reviews')]
    public function reportedReviews(EntityManagerInterface $entityManager) : Response {
        return $this->render('mod/reported_reviews.html.twig');
    }

    #[Route('/mod/reported/review', name: 'view_reported_review')]
    public function review(EntityManagerInterface $entityManager) : Response {
        return $this->render('mod/reported.html.twig');
    }
}