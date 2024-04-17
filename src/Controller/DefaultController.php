<?php
namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Report;
use App\Entity\Review;
use App\Entity\Rating;
use App\Form\AssignImdbType;
use App\Form\ConfirmType;
use App\Form\MovieType;
use App\Form\ReportType;
use App\Form\ReviewType;
use App\Form\SearchType;
use App\Form\SubmitOmdbType;
use App\Repository\MovieRepository;
use App\Service\FileUploader;
use App\Service\MovieService;
use App\Service\OmdbService;
use App\Service\OmdbUpdateService;
use App\Service\RatingTextResponse;
use Doctrine\Common\Collections\Criteria;
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
    public function movies(EntityManagerInterface $entityManager, RatingTextResponse $ratingTextResponse, Request $request, MovieRepository $movieRepository, OmdbUpdateService $omdbUpdate, LoggerInterface $logger) : Response {
        $stars = [];
        $search = null;

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && ($form->get('search')->getData() != null)) {
            $search = $form->get('search')->getData();
            $expressionBuilder = Criteria::expr();
            $criteria = new Criteria();
            $criteria->where($expressionBuilder->contains('name', $search));
            $queryBuilder = $movieRepository->createMovieQueryBuilder()->addCriteria($criteria);
        } else {
            $queryBuilder = $movieRepository->createMovieQueryBuilder();
        }

        $pagerFanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );
        $pagerFanta->setMaxPerPage(12);

        $iterator = $pagerFanta->autoPagingIterator();

        foreach ($iterator as $movie) {
            if ($movie->getAvgRating() == null) {
                $stars[] = "<i>No ratings for this movie yet.</i>";
            } else {
                $stars[] = $ratingTextResponse->getRatingDisplay($movie->getAvgRating());
            }

            if ($movie->getImagePath() == "" && $movie->getOmdbid() != "0") {
                $iterator[$movie] = $omdbUpdate->updateImage($movie);
            }
        }

        if (isset($_GET["page"]) && $pagerFanta->getNbPages() >= $_GET['page']) {
            $pagerFanta->setCurrentPage($_GET["page"]);
        } else {
            $pagerFanta->setCurrentPage(1);
        }


        return $this->render('default/movies_new.html.twig', [
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

    #[Route('/movie/delete/{id}', name: 'app_default_deletemovie')]
    public function deleteMovie(int $id, EntityManagerInterface $entityManager, Request $request) : Response {
        $this->denyAccessUnlessGranted('ROLE_MOD');

        $movie = $entityManager->getRepository(Movie::class)->find($id);

        $form = $this->createForm(ConfirmType::class);
        $form->handleRequest($request);

        if (!$movie) {
            throw $this->createNotFoundException('No movie for id '.$id);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->remove($movie);
            $entityManager->flush();
            return $this->redirectToRoute('movies');
        }

        return $this->render('/default/delete_movie.html.twig', array(
            'movie' => $movie,
            'form' => $form
        ));
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
            $review = $form->getData();

            $entityManager->persist($review);
            $entityManager->flush();

            //TODO: Actually update part in database

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

        $form = $this->createForm(ConfirmType::class);
        $form->handleRequest($request);

        if (!$review) {
            throw $this->createNotFoundException('No review for id '.$id);
        }

        if ($review->getAuthor() !== $security->getUser() && !$security->isGranted('ROLE_MOD')) {
            throw $this->createAccessDeniedException('Not your review.');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->remove($review);
            $entityManager->flush();
            return $this->redirectToRoute('view-movie', array('id' => $review->getMovie()->getId()));
        }

        return $this->render('default/delete_review.html.twig', [
            'review' => $review,
            'form' => $form
        ]);
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

    #[Route('/movie/view/{id}/updatefromomdb', name: 'app_default_updatemoviefromomdb')]
    public function updateMovieFromOmdb(int $id, OmdbUpdateService $omdbUpdate, EntityManagerInterface $entityManager) : Response {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        if ($movie->getOmdbid() != null && $movie->getOmdbid() != '0' && $movie->getOmdbid() != 0) {
            if ($omdbUpdate->updateMovieFromOmdb($movie, $movie->getOmdbid()) == null) {
                return $this->redirectToRoute('app_default_searchformovieomdb', array('id' => $id));
            }
        } else {
            if ($omdbUpdate->updateMovieFromOmdb($movie) == null) {
                return $this->redirectToRoute('app_default_searchformovieomdb', array('id' => $id));
            }
        }

        return $this->redirectToRoute('view-movie', array('id' => $id));
    }

    #[Route('/movie/omdb/search/{id}', name: 'app_default_searchformovieomdb')]
    public function searchForMovieOmdb(LoggerInterface $logger, Request $request, OmdbService $omdb, OmdbUpdateService $omdbUpdate, EntityManagerInterface $entityManager, MovieService $movieService, int $id = 0) : Response {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $search = "";
        $results = [];

        //Checks if search has been submitted
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->get('search')->getData();

            //Checks if search term is an IMDB ID, and updates/creates the movie if this is true
            if (preg_match('/tt\\d\\d\\d\\d\\d\\d\\d/i', $search)) {
                if($id != 0) {
                    if ($omdbUpdate->updateMovieFromOmdb($movie, $search) != null){
                        return $this->redirectToRoute('view-movie', array('id' => $id));
                    }
                } else {
                    $movieobj = json_decode($omdb->findById($search));
                    $movie = $movieService->createMovie($movieobj);
                    return $this->redirectToRoute('view-movie', array('id' => $movie->getId()));
                }
            }

            //Gets the response string from the omdb search call
            $responsestring = $omdb->searchByTerm($search);
            $logger->critical($responsestring);

            //Checks if the response is null meaning there were no results
            if ($responsestring == null) {
                return $this->render('/default/search_omdb.html.twig', [
                    'form' => $form,
                    'search' => $search,
                    'results' => null,
                    'id' => $id
                ]);
            }

            //If the response was not null, decodes the json to an array of movie objects or errors
            $responseobj = json_decode($responsestring, true);

            //Checks if response is false
            if ($responseobj['Response'] == "False") {
                return $this->render('/default/search_omdb.html.twig', [
                    'form' => $form,
                    'search' => $search,
                    'results' => null,
                    'id' => $id
                ]);
            }

            //Drills down into the response array to the array of movie objects
            $results = $responseobj['Search'];

            //return $this->redirectToRoute('app_default_updatemoviefromomdb', array('id' => $id));
            //Renders the page with search results
            return $this->render('/default/search_omdb.html.twig', [
                'form' => $form,
                'search' => $search,
                'results' => $results,
                'id' => $id
            ]);
        }

        //Renders the default page
        return $this->render('/default/search_omdb.html.twig', [
            'form' => $form,
            'search' => $search,
            'results' => $results,
            'id' => $id
        ]);
    }

    #[Route('/movie/omdb/update/{id}/{imdbid}', name: 'app_default_updatemoviefromomdbsearch')]
    public function updateMovieFromOmdbSearch(EntityManagerInterface $entityManager, int $id, string $imdbid, OmdbUpdateService $omdbUpdate) : Response {
        $movie = $entityManager->getRepository(Movie::class)->find($id);
        if ($omdbUpdate->updateMovieFromOmdb($movie, $imdbid) != null){
            return $this->redirectToRoute('view-movie', array('id' => $id));
        } else {
            return $this->redirectToRoute('app_default_searchformovieomdb', array('id' => $id));
        }
    }

    #[Route('/movie/omdb/create/{imdbid}', name: 'app_default_createmoviefromomdbsearch')]
    public function createMovieFromOmdbSearch(EntityManagerInterface $entityManager, string $imdbid, OmdbService $omdb, MovieService $movieService) : Response {
        $response = $omdb->findById($imdbid);
        if ($response == null) {
            return $this->redirectToRoute('app_default_searchformovieomdb');
        }
        $omdbdata = json_decode($response, true);

        $movie = $movieService->createMovie($omdbdata);

        return $this->redirectToRoute('view-movie', array('id' => $movie->getId()));
    }

}