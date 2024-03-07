<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountPageType;
use App\Service\APIKeyGenerator;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{

    #[Route('/account/home', name:'account_home')]
    public function accounthome(EntityManagerInterface $entityManager, Request $request, UserService $userService) : Response {
        $user = $entityManager->getRepository(User::class)->find($this->getUser());

        // TODO: Get and set fields for user data

        $form = $this->createForm(AccountPageType::class);
        $form->handleRequest($request);


        $ferror = $form['fname']->getErrors();
        $lerror = $form['lname']->getErrors();

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setFname($form->get('fname')->getData());
            $user->setLname($form->get('lname')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            $userService->setApiAccess($user, $form->get('api')->getData());
        } else {
            $form->get('fname')->setData($user->getFname());
            $form->get('lname')->setData($user->getLname());
            if ($this->isGranted('ROLE_API')) {
                $form->get('api')->setData(true);
            } else {
                $form->get('api')->setData(false);
            }
        }



        return $this->render('account/home.html.twig', [
            'user' => $user,
            'form' => $form,
            'ferror' => $ferror,
            'lerror' => $lerror
        ]);
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