<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Bureau;
use App\Entity\Club;
use App\Entity\Event;
use App\Entity\UserBureau;
use App\Entity\UserClub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // 👤 Utilisateur
        $user = new User();
        $user->setEmail('test@polytech.fr');
        $user->setLogin('polyuser');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'password123'));
        $manager->persist($user);

        // 🏢 Bureau
        $bureau = new Bureau();
        $bureau->setName('Bureau des Sports');
        $bureau->setDescription('Le BDS de Polytech Nancy');
        $manager->persist($bureau);

        // 🔗 Liaison User <-> Bureau
        $userBureau = new UserBureau();
        $userBureau->setUser($user);
        $userBureau->setBureau($bureau);
        $userBureau->setRoleInBureau('Président');
        $manager->persist($userBureau);

        // 🎯 Club
        $club = new Club();
        $club->setName('Club Football');
        $club->setDescription('Club de football universitaire');
        $club->setBureau($bureau);
        $manager->persist($club);

        // 🔗 Liaison User <-> Club
        $userClub = new UserClub();
        $userClub->setUser($user);
        $userClub->setClub($club);
        $userClub->setRoleInClub('Responsable');
        $manager->persist($userClub);

        // 📅 Événement
        $event = new Event();
        $event->setTitle('Tournoi de foot inter-écoles');
        $event->setDescription('Un tournoi regroupant toutes les écoles de Nancy');
        $event->setStartDate(new \DateTime('+5 days'));
        $event->setEndDate(new \DateTime('+6 days'));
        $event->setCapacity(50);
        $event->setClub($club);
        $event->setBureau($bureau);
        $event->setOrganizer($user);
        $event->setPoster(null); // ou un nom d’image si tu veux tester l’affichage
        $manager->persist($event);

        $manager->flush();
    }
}
