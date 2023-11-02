<?php
namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function createMovie(EntityManagerInterface $entityManager, Request $request, FileUploader $fileUploader) : Response {

        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $movieImage = $form->get('image')->getData();

            if ($movieImage) {
                $movieImageFilename = $fileUploader->upload($movieImage);
                $movie->setImagePath($movieImageFilename);
            }

            return $this->redirectToRoute('view-movie', ['id' => $movie->getId()]);
        }

        return $this->render('/default/create_movie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/movie/review/create', name: 'create-review')]
    public function createReview() : Response {
        return $this->render('/default/create_review.html.twig');
    }

    #[Route('review/create_review', name: 'create-review-review')]
    public function createReviewReview() : Response {
        return $this->render('/default/create_review_review.html.twig');
    }

    #[Route('/movie/view/{id}', name: 'view-movie')]
    public function viewMovie(int $id,EntityManagerInterface $entityManager) : Response {
        return $this->render('/default/view_movie.html.twig');
    }

    #[Route('/review/view', name: 'view-review')]
    public function viewReview() : Response {
        return $this->render('/default/view_review.html.twig');
    }

    #[Route('/review/view_review', name: 'view-review-review')]
    public function viewReviewReview() : Response {
        return $this->render('/default/view_review_review.html.twig');
    }
}