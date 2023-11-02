<?php

namespace App\Entity;

use App\Repository\ReviewRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRatingRepository::class)]
class ReviewRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\ManyToOne(inversedBy: 'reviewRatings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rating $review = null;

    #[ORM\ManyToOne(inversedBy: 'reviewRatings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReview(): ?Rating
    {
        return $this->review;
    }

    public function setReview(?Rating $review): static
    {
        $this->review = $review;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
