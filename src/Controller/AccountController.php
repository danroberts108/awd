<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\APIKeyGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route()]
    public function createapikey(APIKeyGenerator $keyGen) : Response {

        // TODO: Inform user they will not be able to view API key after creating
        // TODO: Create downloadable txt file with key in

        return $this->render();
    }


    #[Route()]
    public function deleteapikey(UserPasswordHasherInterface $userPasswordHasher) : Response {

        // TODO: Implement user reauthentication before deleting key

        return $this->render();
    }

}