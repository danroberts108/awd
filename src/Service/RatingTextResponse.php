<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class RatingTextResponse
{
    public function __construct(private EntityManagerInterface $entityManager) {

    }

    public function getRatingDisplay(float $rating) : string {
        $roundedRating = round($rating);

        $filled = $roundedRating;
        $blank = 5 - $roundedRating;

        $emptyStar = '<i class="bi bi-star"></i>';
        $fillStar = '<i class="bi bi-star-fill"></i>';

        return str_repeat($fillStar, $filled).str_repeat($emptyStar, $blank);
    }
}