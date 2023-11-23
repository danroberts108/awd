<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Report;
use App\Entity\Review;
use App\Form\ReportDecisionType;
use App\Service\RatingTextResponse;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModController extends AbstractController {

    #[Route('/mod/index', name: 'mod_index')]
    public function index() : Response {
        $this->denyAccessUnlessGranted('ROLE_MOD');

        return $this->render('mod/index.html.twig');
    }

    #[Route('/mod/reported', name: 'reported-reviews')]
    public function reportedReviews(EntityManagerInterface $entityManager) : Response {
        $this->denyAccessUnlessGranted('ROLE_MOD');

        $reports = $entityManager->getRepository(Report::class)->findAll();

        return $this->render('mod/reported_reviews.html.twig', [
            'reports' => $reports
        ]);
    }

    #[Route('/mod/reported/review/{id}', name: 'view-report')]
    public function review(int $id, EntityManagerInterface $entityManager, Request $request, RatingTextResponse $ratingTextResponse) : Response {
        $this->denyAccessUnlessGranted('ROLE_MOD');

        $report = $entityManager->getRepository(Report::class)->find($id);
        $review = $entityManager->getRepository(Review::class)->find($report->getReview());
        $movie = $entityManager->getRepository(Movie::class)->find($review->getMovie());

        $stars = $ratingTextResponse->getRatingDisplay($movie->getAvgRating());
        $reviewStars = $ratingTextResponse->getRatingDisplay($review->getRating());

        $form = $this->createForm(ReportDecisionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Logic to either remove review that has been reported or remove the report

            $data = $form->getData();

            //if 'remove' is set to true
                //remove review from database
            //else remove just
            if ($data['remove']) {
                $reports = $review->getReports();

                foreach ($reports as $rep) {
                    $entityManager->remove($rep);
                }

                $entityManager->remove($review);
            } else {
                $entityManager->remove($report);
            }

            $entityManager->flush();

            return $this->redirectToRoute('reported-reviews');
        }

        return $this->render('mod/reported.html.twig', [
            'form' => $form->createView(),
            'review' => $review,
            'movie' => $movie,
            'stars' => $stars,
            'report' => $report,
            'reviewstars' => $reviewStars
        ]);
    }
}