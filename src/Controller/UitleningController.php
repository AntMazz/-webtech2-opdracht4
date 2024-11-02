<?php

namespace App\Controller;

use App\Entity\Uitlening;
use App\Form\UitleningType;
use App\Repository\UitleningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/uitlening')]
final class UitleningController extends AbstractController
{
    #[Route(name: 'app_uitlening_index', methods: ['GET'])]
    public function index(UitleningRepository $uitleningRepository): Response
    {
        return $this->render('uitlening/index.html.twig', [
            'uitlenings' => $uitleningRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_uitlening_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $uitlening = new Uitlening();
        $form = $this->createForm(UitleningType::class, $uitlening);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($uitlening);
            $entityManager->flush();

            return $this->redirectToRoute('app_uitlening_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('uitlening/new.html.twig', [
            'uitlening' => $uitlening,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_uitlening_show', methods: ['GET'])]
    public function show(Uitlening $uitlening): Response
    {
        return $this->render('uitlening/show.html.twig', [
            'uitlening' => $uitlening,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_uitlening_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Uitlening $uitlening, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UitleningType::class, $uitlening);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_uitlening_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('uitlening/edit.html.twig', [
            'uitlening' => $uitlening,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_uitlening_delete', methods: ['POST'])]
    public function delete(Request $request, Uitlening $uitlening, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uitlening->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($uitlening);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_uitlening_index', [], Response::HTTP_SEE_OTHER);
    }
}