<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\SocialMedias;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function indexUser(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($userRepository->isEmailAlreadyUsed($user->getEmail())) {
                $form->get('email')->addError(new FormError('Email address already in use.'));
            } else {
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($userRepository->isEmailAlreadyUsed($user->getEmail(), $user->getId())) {
                $form->get('email')->addError(new FormError('Email address already in use.'));
            } else {
                $socialMedias = $user->getSocialMedias() ?: new SocialMedias();
                $fields = [
                    'xTwitter' => fn($value) => $socialMedias->setXTwitter($value),
                    'instagram' => fn($value) => $socialMedias->setInstagram($value),
                    'github' => fn($value) => $socialMedias->setGithub($value),
                    'figma' => fn($value) => $socialMedias->setFigma($value),
                ];

                foreach ($fields as $field => $setter) {
                    $value = $form->get('socialMedias')->get($field)->getData();
                    $setter($value);
                }

                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
