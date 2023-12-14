<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $studio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?float $avg_rating = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Review::class)]
    private Collection $ratings;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_path = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $director = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $actors = null;

    #[ORM\Column(nullable: true)]
    private ?float $runningtime = null;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStudio(): ?string
    {
        return $this->studio;
    }

    public function setStudio(string $studio): static
    {
        $this->studio = $studio;

        return $this;
    }

    public function getAvgRating(): ?float
    {
        return $this->avg_rating;
    }

    public function setAvgRating(float $avg_rating): static
    {
        $this->avg_rating = $avg_rating;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->ratings;
    }

    public function addReview(Review $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $rating): static
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getMovie() === $this) {
                $rating->setMovie(null);
            }
        }

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(?string $image_path): static
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getActors(): ?array
    {
        return $this->actors;
    }

    public function setActors(?array $actors): static
    {
        $this->actors = $actors;

        return $this;
    }

    public function getRunningtime(): ?float
    {
        return $this->runningtime;
    }

    public function setRunningtime(?float $runningtime): static
    {
        $this->runningtime = $runningtime;

        return $this;
    }
}
