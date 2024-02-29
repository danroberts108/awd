<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\APIKeyGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{

    #[Route('/account/home', name:'account_home')]
    public function accounthome(EntityManagerInterface $entityManager) : Response {
        $user = $entityManager->getRepository(User::class)->find($this->getUser());

        // TODO: Get and set fields for user data

        return $this->render('account/home.html.twig');
    }

    public function enableApiAccess(EntityManagerInterface $entityManager) : Response {
        // TODO: Add API Role

        $user = $entityManager->getRepository(User::class)->find($this->getUser());

        $roles = $user->getRoles();

        $roles[] = 'ROLE_API';

        $user->setRoles($roles);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render();
    }

    public function disableApiAccess(EntityManagerInterface $entityManager) : Response {
        // TODO: Remove API Role

        $user = $entityManager->getRepository(User::class)->find($this->getUser());

        $roles = $user->getRoles();

        $pos = array_search('ROLE_API', $roles);

        unset($roles[$pos]);

        $user->setRoles($roles);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render();
    }

}