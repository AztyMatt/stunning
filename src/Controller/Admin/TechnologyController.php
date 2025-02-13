<?php

namespace App\Controller\Admin;

use App\Entity\Technology;
use App\Form\TechnologyType;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/technology')]
final class TechnologyController extends AbstractController
{
    #[Route(name: 'app_technology_index', methods: ['GET'])]
    public function index(TechnologyRepository $technologyRepository): Response
    {
        return $this->render('admin/technology/index.html.twig', [
            'technologies' => $technologyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_technology_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $technology = new Technology();
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($technology);
            $entityManager->flush();

            return $this->redirectToRoute('app_technology_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/technology/new.html.twig', [
            'technology' => $technology,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_technology_show', methods: ['GET'])]
    public function show(Technology $technology): Response
    {
        return $this->render('admin/technology/show.html.twig', [
            'technology' => $technology,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_technology_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Technology $technology, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_technology_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/technology/edit.html.twig', [
            'technology' => $technology,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_technology_delete', methods: ['POST'])]
    public function delete(Request $request, Technology $technology, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technology->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($technology);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_technology_index', [], Response::HTTP_SEE_OTHER);
    }
}
