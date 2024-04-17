<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[Serializer\ExclusionPolicy('none')]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(nullable: false)]
    #[Serializer\Exclude()]
    private ?Movie $movie = null;

    #[ORM\OneToMany(mappedBy: 'review', targetEntity: Rating::class, cascade: ['remove'])]
    #[Serializer\Exclude()]
    private Collection $reviewRatings;

    #[ORM\OneToMany(mappedBy: 'review', targetEntity: Report::class, cascade: ['remove'])]
    #[Serializer\Exclude()]
    private Collection $reports;

    public function __construct()
    {
        $this->reviewRatings = new ArrayCollection();
        $this->reports = new ArrayCollection();
    }

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getReviewRatings(): Collection
    {
        return $this->reviewRatings;
    }

    public function addReviewRating(Rating $reviewRating): static
    {
        if (!$this->reviewRatings->contains($reviewRating)) {
            $this->reviewRatings->add($reviewRating);
            $reviewRating->setReview($this);
        }

        return $this;
    }

    public function removeReviewRating(Rating $reviewRating): static
    {
        if ($this->reviewRatings->removeElement($reviewRating)) {
            // set the owning side to null (unless already changed)
            if ($reviewRating->getReview() === $this) {
                $reviewRating->setReview(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Report>
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): static
    {
        if (!$this->reports->contains($report)) {
            $this->reports->add($report);
            $report->setReview($this);
        }

        return $this;
    }

    public function removeReport(Report $report): static
    {
        if ($this->reports->removeElement($report)) {
            // set the owning side to null (unless already changed)
            if ($report->getReview() === $this) {
                $report->setReview(null);
            }
        }

        return $this;
    }
}
