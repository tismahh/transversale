<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, unique: true, nullable: true)]
    private ?string $login = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    // >>> NOUVEAU <<< ---------------------------------
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $lastName = null;
    // --------------------------------------------------

    public function getId(): ?int { return $this->id; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getLogin(): ?string { return $this->login; }
    public function setLogin(?string $login): self { $this->login = $login; return $this; }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles, true)) $roles[] = 'ROLE_USER';
        return $roles;
    }
    public function setRoles(array $roles): self { $this->roles = $roles; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): self { $this->password = $password; return $this; }

    public function eraseCredentials(): void {}

    // >>> IMPORTANT : identifiant de login pour Symfony
    public function getUserIdentifier(): string
    {
        // Choisis l’ordre qui te convient
        return $this->email ?? $this->login ?? (string) $this->id;
    }

    // >>> NOUVEAU : getters/setters prénom/nom
    public function getFirstName(): ?string { return $this->firstName; }
    public function setFirstName(?string $firstName): self { $this->firstName = $firstName; return $this; }

    public function getLastName(): ?string { return $this->lastName; }
    public function setLastName(?string $lastName): self { $this->lastName = $lastName; return $this; }

    // Pratique pour l’affichage
    public function getFullName(): string
    {
        return trim(($this->firstName ?? '') . ' ' . ($this->lastName ?? ''));
    }

    public function __toString(): string
    {
        // évite les erreurs "could not be converted to string"
        $full = $this->getFullName();
        return $full !== '' ? $full : ($this->email ?? $this->login ?? 'Utilisateur');
    }
}