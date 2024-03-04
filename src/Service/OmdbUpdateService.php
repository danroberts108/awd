<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class OmdbUpdateService
{
    public function __construct(private EntityManagerInterface $entityManager, private OmdbService $omdb)
    {
    }

    public function updateImage(Movie $movie) : Movie {
        $moviestring = $this->omdb->findById($movie->getOmdbid());
        $moviejson = json_decode($moviestring, true);
        $movie->setImagePath($moviejson['Poster']);
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
        return $movie;
    }
}