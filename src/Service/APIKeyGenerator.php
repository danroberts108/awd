<?php

namespace App\Service;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class APIKeyGenerator
{
    public function __construct(private PasswordHasherInterface $passwordHasher) {

    }

    public function genkey() : string {
        // TODO: implement key gen logic

        return "";
    }
}