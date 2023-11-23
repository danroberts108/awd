<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRoleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route('/admin/index', name: 'admin_index')]
    public function index() : Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('/admin/index.html.twig');
    }

    #[Route('/admin/user_roles', name: 'user-roles')]
    public function userRoles(EntityManagerInterface $entityManager) : Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $users = $entityManager->getRepository(User::class)->findAll();

        $thisuser = $entityManager->getRepository(User::class)->find($this->getUser())->getId() - 1;

        unset($users[$thisuser]);

        return $this->render('/admin/user_roles.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/edit_user/{id}', name:'edit-user')]
    public function editUser(EntityManagerInterface $entityManager, int $id, Request $request) : Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = $entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(UserRoleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            if ($data['new_role'] == ' ') {
                $data['new_role'] = '';
            }

            $newRole[] = $data['new_role'];

            $user->setRoles($newRole);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user-roles');
        }

        return $this->render('/admin/edit_user.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}