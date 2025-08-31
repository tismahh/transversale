<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/club')]
final class ClubController extends AbstractController
{
    
    #[Route(name: 'app_club_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $clubs = $entityManager
            ->getRepository(Club::class)
            ->findAll();

        return $this->render('club/index.html.twig', [
            'clubs' => $clubs,
        ]);
    }

    #[Route('/new', name: 'app_club_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile instanceof UploadedFile) {
                $filename = uniqid().'.'.$logoFile->guessExtension();
                $logoFile->move($this->getParameter('uploads_dir') . '/clubs', $filename);
                $club->setLogo($filename);
            }
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('club/new.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_show', methods: ['GET'])]
    public function show(Club $club, EntityManagerInterface $em): Response
    {
        // Si ton entité Club possède une relation vers les utilisateurs
        // Exemple : OneToMany vers ClubUser ou ManyToMany vers User
        $users = method_exists($club, 'getUsers')
            ? $club->getUsers()
            : [];

        return $this->render('club/show.html.twig', [
            'club'  => $club,
            'users' => $users,
        ]);
    }



    #[Route('/{id}/edit', name: 'app_club_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Club $club, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile instanceof UploadedFile) {
                $filename = uniqid().'.'.$logoFile->guessExtension();
                $logoFile->move($this->getParameter('uploads_dir') . '/clubs', $filename);
                $club->setLogo($filename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('club/edit.html.twig', [
            'club' => $club,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_club_delete', methods: ['POST'])]
    public function delete(Request $request, Club $club, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$club->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($club);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_club_index', [], Response::HTTP_SEE_OTHER);
    }
}
