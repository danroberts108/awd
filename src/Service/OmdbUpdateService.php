<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class OmdbUpdateService
{
    public function __construct(private EntityManagerInterface $entityManager, private OmdbService $omdb, private MovieService $movieService)
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

    public function updateMovieFromOmdb(Movie $movie, string $imdb = null) : ?Movie {
        if ($imdb != null) {
            $moviestring = $this->omdb->findById($imdb);
            $moviejson = json_decode($moviestring, true);
            if ($moviejson['Response'] == 'False') {
                return null;
            }
            $movie = $this->movieService->updateMovie($movie, $moviejson);
            $this->entityManager->persist($movie);
        } else {
            $search = $this->omdb->searchByTitle($movie->getName());
            $moviejson = json_decode($search, true);
            if ($moviejson['Response'] == 'False') {
                return null;
            }
            $movie = $this->movieService->updateMovie($movie, $moviejson);
            $this->entityManager->persist($movie);
        }

        $this->entityManager->flush();

        return $movie;
    }
}