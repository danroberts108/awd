<?php

namespace App\Service;

use Keygen\Keygen;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class APIKeyGenerator
{
    public function __construct(private PasswordHasherInterface $passwordHasher) {

    }

    public function genkey() : array {
        $keys = [];

        $keys['prefix'] = Keygen::token(8)->generate();
        $keys['suffix'] = Keygen::token(24)->generate();
        $keys['key'] = $keys['prefix'].'.'.$keys['suffix'];
        $keys['hash'] = $this->passwordHasher->hash($keys['key']);

        return $keys;
    }
}