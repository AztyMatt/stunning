<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\UserRepository;

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
    public function register(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
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
            } elseif ($userRepository->isEmailAlreadyUsed($email)) {
                $error = 'Email address already in use.';
            } else {
                $user = new User();
                $user->setEmail($email);
                $user->setPlainPassword($password);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_login');
            }
        }
        return $this->render('security/register.html.twig', [
            'error' => $error,
        ]);
    }

    #[Route(path: '/forgot', name: 'app_forgot')]
    public function forgot(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $userEmail = $request->get('_email');
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $userEmail]);

            if (!$user) {
                $this->addFlash('error', 'User not found.');
                return $this->redirectToRoute('app_forgot');
            } else {
                $resetToken = Uuid::v4();
                $user->setResetToken($resetToken);
                $entityManager->persist($user);
                $entityManager->flush();

                $resetUrl = $this->generateUrl('reset', ['token' => $resetToken], 0);
                $email = (new TemplatedEmail())
                    ->from($_ENV['MAIL_USER'])
                    ->to($userEmail)
                    ->subject('Password Reset Request')
                    ->htmlTemplate('email/reset.html.twig')
                    ->context([
                        'resetUrl' => $resetUrl,
                        'userEmail' => $userEmail
                    ]);

                $mailer->send($email);

                $this->addFlash('success', 'A reset email has been sent.');
                return $this->redirectToRoute('app_forgot');
            }
        }

        return $this->render(view: 'security/forgot.html.twig');
    }

    #[Route(path: '/reset/{token}', name: 'reset')]
    public function reset(string $token, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if (!Uuid::isValid($token)) {
            $this->addFlash('error', 'Invalid reset token.');
            return $this->redirectToRoute('app_forgot');
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('error', 'Invalid or expired reset token.');
            return $this->redirectToRoute('app_forgot');
        }

        if ($request->isMethod('POST')) {
            $password = $request->get('_password');
            $repeatPassword = $request->get('_repeat_password');

            if (empty($password) || empty($repeatPassword)) {
                $this->addFlash('error', 'Password cannot be empty.');
                return $this->redirectToRoute('reset', ['token' => $token]);
            }

            if ($password !== $repeatPassword) {
                $this->addFlash('error', 'Passwords do not match.');
                return $this->redirectToRoute('reset', ['token' => $token]);
            }

            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
            $user->setResetToken(null);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/reset.html.twig', [
            'token' => $token,
            'email' => $user->getEmail()
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
