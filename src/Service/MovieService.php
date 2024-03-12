<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

class MovieService
{
    public function __construct(private EntityManagerInterface $entityManager, private LoggerInterface $logger) {

    }

    public function createMovie(array $omdbdata) : Movie {
        $movie = new Movie();
        $movie->setName($omdbdata['Title']);
        $movie->setRunningtime($omdbdata['Runtime']);
        $movie->setActors($omdbdata['Actors']);
        $movie->setDirector($omdbdata['Director']);
        $movie->setOmdbid($omdbdata['imdbID']);
        $movie->setImagePath($omdbdata['Poster']);

        $this->entityManager->persist($movie);
        $this->entityManager->flush();

        return $movie;
    }

    public function updateMovie(Movie $movie, array $omdbdata) {
        $movie->setName($omdbdata['Title']);
        $movie->setRunningtime($omdbdata['Runtime']);
        $movie->setActors($omdbdata['Actors']);
        $movie->setDirector($omdbdata['Director']);
        $movie->setOmdbid($omdbdata['imdbID']);
        $movie->setImagePath($omdbdata['Poster']);

        return $movie;
    }

}