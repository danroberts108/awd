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

    #[Route('/movie/create', name: 'create-movie')]
    public function createMovie() : Response {
        return $this->render('/default/create_movie.html.twig');
    }

    #[Route('/movie/review/create', name: 'create-review')]
    public function createReview() : Response {
        return $this->render('/default/create_review.html.twig');
    }

    #[Route('review/create_review', name: 'create-review-review')]
    public function createReviewReview() {
        return $this->render('/default/create_review_review.html.twig');
    }

    #[Route('/movie/view', name: 'view-movie')]
    public function viewMovie() : Response {
        $this->render('/default/view_movie.html.twig');
    }

    #[Route('/review/view', name: 'view-review')]
    public function viewReview() : Response {
        $this->render('/default/view_review.html.twig');
    }

    #[Route('/review/view_review', name: 'view-review-review')]
    public function viewReviewReview() : Response {
        $this->render('/default/view_review_review.html.twig');
    }
}