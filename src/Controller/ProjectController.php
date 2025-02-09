<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProjectRepository;

class ProjectController extends AbstractController
{
    #[Route('/project/{id}', name: 'project')]
    public function project(int $id, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->find($id);

        return $this->render('project.html.twig', [
            'project' => $project,
        ]);
    }
}
