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
use App\Repository\MovieRepository;
use App\Service\FileUploader;
use App\Service\OmdbService;
use App\Service\RatingTextResponse;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Psr\Log\LoggerInterface;
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
    public function movies(EntityManagerInterface $entityManager, RatingTextResponse $ratingTextResponse, Request $request, MovieRepository $movieRepository, OmdbService $omdb, LoggerInterface $logger) : Response {
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

        $queryBuilder = $movieRepository->createMovieQueryBuilder();
        $pagerFanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );
        $pagerFanta->setMaxPerPage(12);

        if (isset($_GET["page"])) {
            $pagerFanta->setCurrentPage($_GET["page"]);
        }

        if ($movies != null) {
            foreach ($movies as $movie) {
                if ($movie->getAvgRating() == null) {
                    $stars[] = "";
                    continue;
                }
                $stars[] = $ratingTextResponse->getRatingDisplay($movie->getAvgRating());
                if ($movie->getImagePath() == "" && $movie->getOmdbid() != 0) {

                    $moviestring = $omdb->findById($movie->getOmdbid());
                    $moviejson = json_decode($moviestring, true);
                    $logger->error($moviestring);
                    $movie->setImagePath($moviejson['Poster']);
                }
            }
        }


        return $this->render('default/movies_new.html.twig', [
            'movies' => $movies,
            'stars' => $stars,
            'search' => $search,
            'form' => $form,
            'pager' => $pagerFanta
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

        if (str_starts_with('download', $movie->getImagePath())) {
            $tmp = $movie->getImagePath();
            $movie->setImagePath('/uploads/movieimages/'.$tmp);
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

    #[Route('/review/edit/{id}', name: 'edit-review')]
    public function editReview(int $id, EntityManagerInterface $entityManager, Request $request, Security $security) : Response {
        $review = $entityManager->getRepository(Review::class)->find($id);

        if (!$review) {
            throw $this->createNotFoundException('No review for id '.$id);
        }

        if ($review->getAuthor() !== $security->getUser() && !$security->isGranted('ROLE_MOD')) {
            throw $this->createAccessDeniedException('You did not create this review.');
        }

        $form = $this->createForm(ReviewType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('view-review', ['id' => $review->getId()]);
        }

        $form->setData($review);

        $reviewDetails = [
            'review' => $review,
            'form' => $form,
            'moviename' => $review->getMovie()->getName()
        ];

        return $this->render('default/edit_review.html.twig', $reviewDetails);
    }

    #[Route('/review/delete/{id}', name: 'delete-review')]
    public function deleteReview(int $id, EntityManagerInterface $entityManager, Security $security, Request $request) : Response {
        $review = $entityManager->getRepository(Review::Class)->find($id);

        if (!$review) {
            $this->createNotFoundException('No review for id '.$id);
        }

        if ($review->getAuthor() !== $security->getUser() && !$security->isGranted('ROLE_MOD')) {
            $this->createAccessDeniedException('Not your review.');
        }

        return $this->render('default/delete_review.html.twig');
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