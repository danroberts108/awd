<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\ReportDecisionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModController extends AbstractController {

    #[Route('/mod/index', name: 'mod_index')]
    public function index() : Response {
        return $this->render('mod/index.html.twig');
    }

    #[Route('/mod/reported', name: 'reported_reviews')]
    public function reportedReviews(EntityManagerInterface $entityManager) : Response {
        $reports = $entityManager->getRepository(Report::class)->findAll();

        return $this->render('mod/reported_reviews.html.twig', [
            'reports' => $reports
        ]);
    }

    #[Route('/mod/reported/review', name: 'view_reported_review')]
    public function review(int $id, EntityManagerInterface $entityManager, Request $request) : Response {
        $report = $entityManager->getRepository(Report::class)->find($id);

        $form = $this->createForm(ReportDecisionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Logic to either remove review that has been reported or remove the report

            $data = $form->getData();

            //if 'remove' is set to true
                //remove review from database

            //remove report from database

            return $this->redirectToRoute('reported_reviews');
        }

        return $this->render('mod/reported.html.twig');
    }
}