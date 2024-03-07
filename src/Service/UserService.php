<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $entityManager){}

    public function setApiAccess(User $user, bool $enable) : bool {
        $roles = $user->getRoles();
        if ($enable) {
            $roles[] = 'ROLE_API';
        } else {
            $pos = array_search('ROLE_API', $roles);

            unset($roles[$pos]);
        }

        $user->setRoles($roles);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}