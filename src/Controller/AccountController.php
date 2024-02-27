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

    #[Route('/account/home/create', name:'account_createapi')]
    public function createApiKey(APIKeyGenerator $keyGen, Request $request, EntityManagerInterface $entityManager) : Response {

        // TODO: Inform user they will not be able to view API key after creating

        $keys = $keyGen->genkey();

        $user = $entityManager->getRepository(User::class)->find($this->getUser());
        $user->setApikey($keys['hash']);
        $user->setKeyprefix($keys['prefix']);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('account/home.html.twig', [
            'modal' => 'create',
            'key' => $keys['key']
        ]);
    }


    #[Route('/account/home/delete', name:'account_deleteapi')]
    public function deleteApiKey(EntityManagerInterface $entityManager) : Response {

        // TODO: Implement user reauthentication before deleting key

        $user = $entityManager->getRepository(User::class)->find($this->getUser());
        $user->clearApiKey();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('account/home.html.twig', [
            'modal' => 'delete',
        ]);
    }

}