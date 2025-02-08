<?php

declare(strict_types=1);

namespace App\EventListener\Technology;

use App\Entity\Technology;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use App\Service\ClearbitRetrieverService;

#[AsEntityListener(event: Events::preFlush, method: 'handleLogo', entity: Technology::class)]
class TechnologyLogoListener
{
    public function __construct(
        protected ClearbitRetrieverService $ClearbitRetrieverService
    ) {}

    public function handleLogo(Technology $technology): void
    {
        if (empty($technology->getLogo())) {
            $technologyName = $technology->getName();
            $technology->setLogo($this->ClearbitRetrieverService->retrieveClearbitLogo($technologyName));
        }
    }
}
