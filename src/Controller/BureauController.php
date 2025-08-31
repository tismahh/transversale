<?php

namespace App\Controller;

use App\Entity\Bureau;
use App\Form\BureauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Club;


#[Route('/bureau')]
final class BureauController extends AbstractController
{
    #[Route(name: 'app_bureau_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $bureaus = $entityManager
            ->getRepository(Bureau::class)
            ->findAll();

        return $this->render('bureau/index.html.twig', [
            'bureaus' => $bureaus,
        ]);
    }

    #[Route('/new', name: 'app_bureau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bureau = new Bureau();
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile instanceof UploadedFile) {
                $filename = uniqid().'.'.$logoFile->guessExtension();
                $logoFile->move($this->getParameter('uploads_dir') . '/bureaux', $filename);
                $bureau->setLogo($filename);
            }
            $entityManager->persist($bureau);
            $entityManager->flush();

            return $this->redirectToRoute('app_bureau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bureau/new.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

//    #[Route('/{id}', name: 'app_bureau_show', methods: ['GET'])]
//    public function show(Bureau $bureau): Response
//    {
//        return $this->render('bureau/show.html.twig', [
//            'bureau' => $bureau,
//        ]);
//    }

    #[Route('/{id}', name: 'app_bureau_show', methods: ['GET'])]
    public function show(Bureau $bureau, EntityManagerInterface $em): Response
    {
        $clubs = $em->getRepository(Club::class)->findBy(['bureau' => $bureau]);

        return $this->render('bureau/show.html.twig', [
            'bureau' => $bureau,
            'clubs' => $clubs,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bureau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logoFile')->getData();
            if ($logoFile instanceof UploadedFile) {
                $filename = uniqid().'.'.$logoFile->guessExtension();
                $logoFile->move($this->getParameter('uploads_dir') . '/bureaux', $filename);
                $bureau->setLogo($filename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_bureau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bureau/edit.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bureau_delete', methods: ['POST'])]
    public function delete(Request $request, Bureau $bureau, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bureau->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bureau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bureau_index', [], Response::HTTP_SEE_OTHER);
    }
}
