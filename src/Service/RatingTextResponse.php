<?php

namespace App\Service;


class RatingTextResponse
{
    public function __construct() {

    }

    public function getRatingDisplay(?float $rating) : string {

        if ($rating == null) {
            return '<i>No ratings yet.</i>';
        }

        $roundedRating = round($rating);

        $filled = $roundedRating;
        $blank = 5 - $roundedRating;

        $emptyStar = '<i class="bi bi-star"></i>';
        $fillStar = '<i class="bi bi-star-fill"></i>';

        return str_repeat($fillStar, $filled).str_repeat($emptyStar, $blank);
    }
}