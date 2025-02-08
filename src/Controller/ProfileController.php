<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Enum\UserCountryEnum;
use App\Enum\ProjectVisibilityEnum;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SocialMedias;

#[Route('/profile', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/settings', name: 'settings', methods: ['GET', 'POST'])]
    public function settings(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var \App\Entity\User|null $currentUser */
        $currentUser = $this->getUser();
        $countries = UserCountryEnum::cases();

        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            $fields = [
                'username' => fn($value) => $currentUser->setUsername($value ?: null),
                'country' => fn($value) => $currentUser->setCountry($value ? UserCountryEnum::from($value) : null),
                'email' => fn($value) => $currentUser->setEmail($value ?: null),
                'websiteLink' => fn($value) => $currentUser->setWebsiteLink($value ?: null)
            ];
            foreach ($fields as $field => $setter) {
                $setter($data[$field]);
            }

            $socialMedias = $currentUser->getSocialMedias() ?? new SocialMedias();
            $socialFields = [
                'twitter' => fn($value) => $socialMedias->setXTwitter($value ?: null),
                'instagram' => fn($value) => $socialMedias->setInstagram($value ?: null),
                'github' => fn($value) => $socialMedias->setGithub($value ?: null),
                'figma' => fn($value) => $socialMedias->setFigma($value ?: null)
            ];
            foreach ($socialFields as $field => $setter) {
                $setter($data[$field]);
            }
            $currentUser->setSocialMedias($socialMedias);
            
            $entityManager->persist($currentUser);
            $entityManager->flush();

            return $this->redirectToRoute('profile_settings');
        }

        return $this->render('settings.html.twig', [
            'countries' => $countries,
        ]);
    }
    
    #[Route('/{id}', name: 'view', methods: ['GET'])]
    public function profile(int $id, UserRepository $userRepository): Response
    {
        /** @var \App\Entity\User|null $currentUser */
        $currentUser = $this->getUser();
        $user = $userRepository->find($id);

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