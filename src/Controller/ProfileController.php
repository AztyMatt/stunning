<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Enum\UserCountryEnum;
use App\Enum\ProjectVisibilityEnum;
use App\Repository\UserRepository;

#[Route('/profile', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/settings', name: 'settings', methods: ['GET', 'POST'])]
    public function settings(): Response
    {
        $countries = UserCountryEnum::cases();

        return $this->render('settings.html.twig', [
            'countries' => $countries,
        ]);
    }

    #[Route('/{id}', name: 'view', methods: ['GET'])]
    public function profile(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        $currentUser = $this->getUser();
        $isCurrentUser = $currentUser && $currentUser->getId() === $user->getId();

        $isProjectVisible = function ($project) use ($isCurrentUser): bool {
            return $project->getVisibility() === ProjectVisibilityEnum::PUBLIC || $isCurrentUser;
        };

        $groupsWithPublicProjects = [];
        foreach ($user->getGroups() as $group) {
            foreach ($group->getProjects() as $project) {
                if ($isProjectVisible($project)) {
                    $groupsWithPublicProjects[] = $group;
                    break;
                }
            }
            if ($isCurrentUser && !in_array($group, $groupsWithPublicProjects)) {
                $groupsWithPublicProjects[] = $group;
            }
        }

        $publicProjects = [];
        foreach ($user->getProjects() as $project) {
            if ($isProjectVisible($project)) {
                $publicProjects[] = $project;
            }
        }

        return $this->render('profile.html.twig', [
            'user' => $user,
            'groupsWithPublicProjects' => $groupsWithPublicProjects,
            'publicProjects' => $publicProjects,
        ]);
    }
}