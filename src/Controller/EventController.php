<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Bureau;
use App\Entity\Club;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/event', name: 'app_event_')]
final class EventController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $events  = $entityManager->getRepository(Event::class)->findAll();
        $bureaux = $entityManager->getRepository(Bureau::class)->findAll();
        $clubs   = $entityManager->getRepository(Club::class)->findAll();

        return $this->render('event/index.html.twig', [
            'events'  => $events,
            'bureaux' => $bureaux,
            'clubs'   => $clubs,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $posterFile = $form->get('posterFile')->getData();
            if ($posterFile instanceof UploadedFile) {
                $filename = uniqid('', true) . '.' . $posterFile->guessExtension();
                $posterFile->move($this->getParameter('uploads_dir') . '/events', $filename);
                $event->setPoster($filename);
            }
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form'  => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $posterFile = $form->get('posterFile')->getData();
            if ($posterFile instanceof UploadedFile) {
                $filename = uniqid('', true) . '.' . $posterFile->guessExtension();
                $posterFile->move($this->getParameter('uploads_dir') . '/events', $filename);
                $event->setPoster($filename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form'  => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index');
    }
}