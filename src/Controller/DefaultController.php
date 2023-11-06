<?php
namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\Rating;
use App\Form\MovieType;
use App\Form\ReviewType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class DefaultController extends AbstractController {
    #[Route('/', name: 'index')]
    public function index() : Response {
        return $this->render('default/index.html.twig');
    }

    #[Route('/reviews', name: 'reviews')]
    public function reviews(EntityManagerInterface $entityManager) : Response {
        return $this->render('default/reviews.html.twig');
    }

    #[Route('/movie/create', name: 'create-movie')]
    public function createMovie(EntityManagerInterface $entityManager, Request $request, FileUploader $fileUploader) : Response {

        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $movieImage = $form->get('image_path')->getData();

            if ($movieImage) {
                $movieImageFilename = $fileUploader->upload($movieImage);
                $movie->setImagePath($movieImageFilename);
            }

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('view-movie', ['id' => $movie->getId()]);
        }

        return $this->render('/default/create_movie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/movie/review/create/{id}', name: 'create-review')]
    public function createReview(int $id, EntityManagerInterface $entityManager, Request $request, Security $security) : Response {
        $movie = $entityManager->getRepository(Movie::class)->find($id);

        $form = $this->createForm(ReviewType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $review = new Review();
            $review = $form->getData();
            $review->setAuthor($security->getUser());
            $review->setMovie($movie);

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('view-review', ['id' => $review->getId()]);
        }

        $data = [
            'moviename' => $movie->getName(),
            'form' => $form->createView()
        ];

        return $this->render('/default/create_review.html.twig', $data);
    }

    #[Route('/movie/review/rate/create/{id}', name: 'create-rating')]
    public function createRating(int $id, EntityManagerInterface $entityManager, Security $security, Request $request) : Response {
        $review = $entityManager->getRepository(Review::class)->find($id);

        $form = $this->createForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $rating = new Rating();
            $rating = $form->getData();
            $rating->setAuthor($security->getUser());
            $rating->setReview($review);

            $entityManager->persist($rating);
            $entityManager->flush();
        }

        return $this->render('default/create_rating.twig', [
            'form' => $form->createView(),
            'review' => $review
        ]);
    }

    #[Route('/movie/view/{id}', name: 'view-movie')]
    public function viewMovie(int $id,EntityManagerInterface $entityManager) : Response {

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if(!$movie) {
            throw $this->createNotFoundException('No movie for id '.$id);
        }

        $movieDetails = [
            'id' => $movie->getId(),
            'name' => $movie->getName(),
            'studio' => $movie->getStudio(),
            'rating' => $movie->getAvgRating(),
            'imagepath' => $movie->getImagePath(),
            'ratings' => $movie->getRatings()
        ];

        return $this->render('/default/view_movie.html.twig', $movieDetails);
    }

    #[Route('/review/view/{id}', name: 'view-review')]
    public function viewReview(int $id, EntityManagerInterface $entityManager) : Response {
        $review = $entityManager->getRepository(Review::class)->find($id);

        if (!$review) {
            throw $this->createNotFoundException('No rating for id '.$id);
        }

        $reviewDetails = [
            'movie' => $review->getMovie(),
            'author' => $review->getAuthor(),
            'rating' => $review->getRating(),
            'comment' => $review->getComment()
        ];

        return $this->render('/default/view_review.html.twig', $reviewDetails);
    }

    #[Route('/review/view_rating/{id}', name: 'view-review-review')]
    public function viewReviewReview(int $id, EntityManagerInterface $entityManager) : Response {
        $rating = $entityManager->getRepository(Rating::class)->find($id);

        if (!$rating) {
            throw $this->createNotFoundException("No review rating for id ".$id);
        }

        $reviewDetails = [
            'review' => $rating->getReview(),
            'rating' => $rating->getRating(),
            'author' => $rating->getUser()
        ];

        return $this->render('/default/view_review_review.html.twig', $reviewDetails);
    }
}