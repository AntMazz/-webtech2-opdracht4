<?php

namespace App\Controller;

use App\Entity\Boek;
use App\Form\BoekType;
use App\Repository\BoekRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boek')]
final class BoekController extends AbstractController
{
    #[Route(name: 'app_boek_index', methods: ['GET'])]
    public function index(BoekRepository $boekRepository): Response
    {
        return $this->render('boek/index.html.twig', [
            'boeks' => $boekRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_boek_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $boek = new Boek();
        $form = $this->createForm(BoekType::class, $boek);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($boek);
            $entityManager->flush();

            return $this->redirectToRoute('app_boek_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('boek/new.html.twig', [
            'boek' => $boek,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boek_show', methods: ['GET'])]
    public function show(Boek $boek): Response
    {
        return $this->render('boek/show.html.twig', [
            'boek' => $boek,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_boek_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Boek $boek, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BoekType::class, $boek);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_boek_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('boek/edit.html.twig', [
            'boek' => $boek,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boek_delete', methods: ['POST'])]
    public function delete(Request $request, Boek $boek, EntityManagerInterface $entityManager): Response
    {
        // Controleer het CSRF-token voor extra beveiliging
        if ($this->isCsrfTokenValid('delete' . $boek->getId(), $request->request->get('_token'))) {
            $entityManager->remove($boek);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_boek_index', [], Response::HTTP_SEE_OTHER);
    }
}
