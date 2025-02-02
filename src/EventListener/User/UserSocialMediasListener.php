<?php

declare(strict_types=1);

namespace App\EventListener\User;;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::preFlush, method: 'handleEmptySocialMedias', entity: User::class)]

class UserSocialMediasListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    public function handleEmptySocialMedias(User $user): void
    {
        $socialMedias = $user->getSocialMedias(); 

        if ($socialMedias && $socialMedias->areAllFieldsNull()) {
            $this->entityManager->remove($user->getSocialMedias());
            $user->setSocialMedias(null);
        }
    }
}
