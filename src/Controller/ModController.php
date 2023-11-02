<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModController extends AbstractController {

    #[Route('/mod/index', name: 'mod_index')]
    public function index() : Response {
        return $this->render('mod/index.html.twig');
    }
}