<?php

namespace App\EventListener\Project;

use App\Entity\Project;
use Doctrine\ORM\Events;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::preFlush, method: 'initializeInformations', entity: Project::class)]
class ProjectInformationsListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {}

    public function initializeInformations(Project $project): void
    {
        if ($project->getPublicInformations() && $project->getPublicInformations()->getProject() === null) {
            $project->getPublicInformations()->setProject($project);
        }
        if ($project->getPrivateInformations() && $project->getPrivateInformations()->getProject() === null) {
            $project->getPrivateInformations()->setProject($project);
        }
    }
}
