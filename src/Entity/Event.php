<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Bureau;
use App\Entity\Club;

#[ORM\Entity]
#[ORM\Table(name: 'event')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $capacity = null;

    // Nombre de personnes intéressées (si vous voulez un compteur)
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $interestCount = null;

    // Organisateur (un user)
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $organizer = null;

    // Event rattaché à un bureau (optionnel)
    #[ORM\ManyToOne(targetEntity: Bureau::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Bureau $bureau = null;

    // Event rattaché à un club (optionnel)
    #[ORM\ManyToOne(targetEntity: Club::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Club $club = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $poster = null;

    // -----------------------------
    // Getters / Setters
    // -----------------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getInterestCount(): ?int
    {
        return $this->interestCount;
    }

    public function setInterestCount(?int $interestCount): self
    {
        $this->interestCount = $interestCount;
        return $this;
    }

    public function getOrganizer(): ?User
    {
        return $this->organizer;
    }

    public function setOrganizer(?User $organizer): self
    {
        $this->organizer = $organizer;
        return $this;
    }

    public function getBureau(): ?Bureau
    {
        return $this->bureau;
    }

    public function setBureau(?Bureau $bureau): self
    {
        $this->bureau = $bureau;
        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;
        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;
        return $this;
    }
}
