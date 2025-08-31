<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Bureau;

#[ORM\Entity]
#[ORM\Table(name: 'user_bureau')]
class UserBureau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Bureau::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bureau $bureau = null;

    // Par exemple, rôle qu'occupe le user dans ce bureau (Président, Trésorier, etc.)
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $roleInBureau = null;

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

    public function getBureau(): ?Bureau
    {
        return $this->bureau;
    }

    public function setBureau(?Bureau $bureau): self
    {
        $this->bureau = $bureau;
        return $this;
    }

    public function getRoleInBureau(): ?string
    {
        return $this->roleInBureau;
    }

    public function setRoleInBureau(?string $roleInBureau): self
    {
        $this->roleInBureau = $roleInBureau;
        return $this;
    }
}
