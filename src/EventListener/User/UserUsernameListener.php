<?php

declare(strict_types=1);

namespace App\EventListener\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::preFlush, method: 'handleEmptyUsername', entity: User::class, priority: 100)]

class UserUsernameListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    public function handleEmptyUsername(User $user): void
    {
        if (empty($user->getUsername())) {
            $email = $user->getEmail();

            $username = ucfirst(strstr($email, '@', true));
            $user->setUsername($username);
        }
    }
}
