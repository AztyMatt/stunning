<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;

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

    #[Route('/search', name: 'search')]
    public function search(ProjectRepository $projectRepository, UserRepository $userRepository, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $searchTerm = $request->query->get('query', '');
        $searchResultsProjects = $projectRepository->searchProjects($searchTerm);
        $searchResultsUsers = $userRepository->searchUsers($searchTerm);

        return $this->render('search.html.twig', [
            'searchTerm' => $searchTerm,
            'searchResultsProjects' => $searchResultsProjects,
            'searchResultsUsers' => $searchResultsUsers,
        ]);
    }
}
