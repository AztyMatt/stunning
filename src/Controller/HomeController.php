<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $recentProjects = $projectRepository->findRecentProjects(8);
        $popularProjects = $projectRepository->findPopularProjects(8);

        return $this->render('index.html.twig', [
            'recentProjects' => $recentProjects,
            'popularProjects' => $popularProjects,
        ]);
    }
}
