<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $email = $request->request->get('_email');
            $password = $request->request->get('_password');
            $repeatPassword = $request->request->get('_repeat_password');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email address.';
            } elseif ($password !== $repeatPassword) {
                $error = 'Passwords do not match.';
            } else {
                $existingUser = $doctrine->getRepository(User::class)->findOneBy(['email' => $email]);
                if ($existingUser) {
                    $error = 'Email address already in use.';
                } else {
                    $username = strstr($email, '@', true);
                    $user = new User();
                    $user->setUsername($username);
                    $user->setEmail($email);
                    $user->setPlainPassword($password);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_login');
                }
            }
        }
        return $this->render('security/register.html.twig', [
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
