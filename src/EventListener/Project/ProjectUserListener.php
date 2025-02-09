<?php

namespace App\EventListener\Project;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::preFlush, method: 'initializeUser', entity: Project::class)]
class ProjectUserListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        private Security $security,
    ) {}
 
    public function initializeUser(Project $project): void
    {
        if ($project->getUsers()->isEmpty()) {
            $user = $this->security->getUser();
            if ($user instanceof User) {
                $project->addUser($user);
            }
        }
    }
}