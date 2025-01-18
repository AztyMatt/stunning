<?php

declare(strict_types=1);

namespace App\EventListener;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: User::class)]
class UserProfilePictureListener
{
    public function prePersist(User $user): void
    {
        if (empty($user->getProfilePicture())) {
            $profilePictureUrl = 'https://ui-avatars.com/api/?rounded=false&size=128&bold=true&background=random&name=' . urlencode($user->getUsername());
            $user->setProfilePicture($profilePictureUrl);
        }
    }
}
