<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Club;

#[ORM\Entity]
#[ORM\Table(name: 'user_club')]
class UserClub
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Club::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $club = null;

    // Par exemple, rôle qu'occupe le user dans ce club (Membre, Responsable, etc.)
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $roleInClub = null;

    // -----------------------------
    // Getters / Setters
    // -----------------------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
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

    public function getRoleInClub(): ?string
    {
        return $this->roleInClub;
    }

    public function setRoleInClub(?string $roleInClub): self
    {
        $this->roleInClub = $roleInClub;
        return $this;
    }
}
