<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route('/admin/index', name: 'admin_index')]
    public function index() : Response {
        return $this->render('/admin/index.html.twig');
    }

    #[Route('/admin/user_roles', name: 'user-roles')]
    public function userRoles(EntityManagerInterface $entityManager) : Response {
        return $this->render('/admin/user_roles.html.twig');
    }
}