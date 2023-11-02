<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
    #[Route('/index', name: 'index')]
    public function index() : Response {
        return $this->render('default/index.html.twig');
    }

    #[Route('/reviews', name: 'reviews')]
    public function reviews() : Response {
        return $this->render('default/reviews.html.twig');
    }
}