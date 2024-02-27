<?php

namespace App\Service;

use Keygen\Keygen;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class APIKeyGenerator
{

    public function genkey() : array {

        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt'],
            'sodium' => ['algorithm' => 'sodium']
        ]);

        $hasher = $factory->getPasswordHasher('common');

        $keys = [];

        $keys['prefix'] = Keygen::token(8)->generate();
        $keys['suffix'] = Keygen::token(24)->generate();
        $keys['key'] = $keys['prefix'].'.'.$keys['suffix'];
        $keys['hash'] = $hasher->hash($keys['key']);

        return $keys;
    }
}