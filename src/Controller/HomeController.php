<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Bureau;
use App\Entity\Club;
use App\Entity\Event;
use App\Entity\UserBureau;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/accueil', name: 'accueil_index')]
    public function index(): Response
    {
        return $this->render('acceuille.html.twig'); // On appelle le template créé
    }

    #[Route('/', name: 'accueil_events_index')]
    public function indexEvents(EntityManagerInterface $entityManager): Response
    {
        $bureaux = $entityManager
            ->getRepository(Bureau::class)
            ->findAll();

        $events = $entityManager
            ->getRepository(Event::class)
            ->findAll();

        return $this->render('front/events-accueil.html.twig', [
            'bureaux' => $bureaux,
            'events'=> $events,
        ]);
    }

    #[Route('/calendrier', name: 'calendar_index')]
    public function indexCalendar(Request $request): Response
    {
        // Récupère le mois choisi dans le formulaire (GET), ou le mois courant par défaut
        $mois = $request->query->get('mois', date('m'));
    
        return $this->render('front/calendar.html.twig', [
            'mois' => $mois,
        ]);
    }
    #[Route('/accueil-bureaux', name: 'bureau_accueil')]
    public function indexBureaux(EntityManagerInterface $entityManager): Response
    {
        $bureaux = $entityManager
            ->getRepository(Bureau::class)
            ->findBy([], null, 5);

        return $this->render('front/bureaux.html.twig', [
            'bureaux' => $bureaux
        ]);
    }

    #[Route('/accueil-bureau-details/{id}', name: 'bureau_accueil_details')]
    public function indexBureauxDetails(EntityManagerInterface $entityManager, Bureau $bureau): Response
    {
        $users = $entityManager
            ->getRepository(UserBureau::class)
            ->findBy(['bureau' => $bureau]);
        $clubs = $entityManager
            ->getRepository(Club::class)
            ->findBy(['bureau' => $bureau]);

        return $this->render('front/bureau-details.html.twig', [
            'bureau' => $bureau,
            'users' => $users,
            'clubs' => $clubs
        ]);
    }
}
