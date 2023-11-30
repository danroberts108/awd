<?php
namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Report;
use App\Entity\Review;
use App\Entity\Rating;
use App\Form\MovieType;
use App\Form\ReportType;
use App\Form\ReviewType;
use App\Form\SearchType;
use App\Service\FileUploader;
use App\Service\RatingTextResponse;
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
        //return $this->render('default/index.html.twig');
        return $this->redirectToRoute('movies');
    }

    #[Route('/movies', name: 'movies')]
    public function movies(EntityManagerInterface $entityManager, RatingTextResponse $ratingTextResponse, Request $request) : Response {
        $stars = [];
        $search = null;

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && ($form->get('search')->getData() != null)) {
            $movies = $entityManager->getRepository(Movie::class)->search($form->get('search')->getData());
            $search = $form->get('search')->getData();
        } else {
            $movies = $entityManager->getRepository(Movie::class)->findAll();
        }

        if ($movies != null) {
            foreach ($movies as $movie) {
                if ($movie->getAvgRating() == null) {
                    $stars[] = "";
                    continue;
                }
                $stars[] = $ratingTextResponse->getRatingDisplay($movie->getAvgRating());
            }
        }


        return $this->render('default/movies.html.twig', [
            'movies' => $movies,
            'stars' => $stars,
            'search' => $search,
            'form' => $form
        ]);
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

            $prevStars = $movie->getAvgRating();
            $newStars = 0.0;

            if($prevStars == null) {
                $newStars = $review->getRating();
            } else {
                $ratings = $movie->getReviews();
                $ratingsum = $review->getRating();
                $ratingnum = 1;

                foreach ($ratings as $rate) {
                    $ratingsum += $rate->getRating();
                    $ratingnum += 1;
                }

                $newStars = $ratingsum / $ratingnum;
            }

            $movie->setAvgRating($newStars);

            $entityManager->persist($movie);
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

        $form = $this->createForm(Rating::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $rating = new Rating();
            $rating = $form->getData();
            $rating->setAuthor($security->getUser());
            $rating->setReview($review);

            $entityManager->persist($rating);
            $entityManager->flush();

            return $this->redirectToRoute('view-review', ['id' => $review->getId()]);
        }

        return $this->render('create_rating.html.twig', [
            'form' => $form->createView(),
            'review' => $review
        ]);
    }

    #[Route('/movie/view/{id}', name: 'view-movie')]
    public function viewMovie(int $id,EntityManagerInterface $entityManager, RatingTextResponse $ratingTextResponse) : Response {

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        if(!$movie) {
            throw $this->createNotFoundException('No movie for id '.$id);
        }

        $movieStars = $ratingTextResponse->getRatingDisplay($movie->getAvgRating());

        $reviews = $movie->getReviews();
        $stars = [];

        foreach ($reviews as $review) {
            if ($review->getRating() == null) {
                $stars[] = '';
                continue;
            }
            $stars[] = $ratingTextResponse->getRatingDisplay($review->getRating());
        }

        return $this->render('/default/view_movie.html.twig', [
            'movie' => $movie,
            'reviews' => $reviews,
            'stars' => $stars,
            'moviestars' => $movieStars
        ]);
    }

    #[Route('/review/view/{id}', name: 'view-review')]
    public function viewReview(int $id, EntityManagerInterface $entityManager, RatingTextResponse $ratingTextResponse) : Response {
        $review = $entityManager->getRepository(Review::class)->find($id);

        if (!$review) {
            throw $this->createNotFoundException('No rating for id '.$id);
        }

        $stars = $ratingTextResponse->getRatingDisplay($review->getRating());

        $reviewDetails = [
            'review' => $review,
            'stars' => $stars
        ];

        return $this->render('/default/view_review.html.twig', $reviewDetails);
    }

    #[Route('/review/view_rating/{id}', name: 'view-rating')]
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

    #[Route('/review/report/{id}', name:'create-report')]
    public function createReport(int $id, EntityManagerInterface $entityManager, Request $request, Security $security) : Response {
        $review = $entityManager->getRepository(Review::class)->find($id);

        $form = $this->createForm(ReportType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $report = new Report();
            $report = $form->getData();

            $report->setUser($security->getUser());
            $report->setReview($review);

            $entityManager->persist($report);
            $entityManager->flush();

            return $this->redirectToRoute('view-review', ['id' => $review->getId()]);

        }

        return $this->render('/default/create_report.html.twig', [
            'form' => $form->createView(),
            'review' => $review
        ]);
    }
}