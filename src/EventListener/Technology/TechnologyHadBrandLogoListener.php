<?php

declare(strict_types=1);

namespace App\EventListener\Technology;

use App\Entity\Technology;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use App\Service\ClearbitCheckerService;

#[AsEntityListener(event: Events::preFlush, method: 'hasBrandLogo', entity: Technology::class)]
class TechnologyHadBrandLogoListener
{
    public function __construct(
        protected ClearbitCheckerService $clearbitCheckerService
    ) {}

    public function hasBrandLogo(Technology $technology): void
    {
        $technologyName = $technology->getName();
        $technology->setHasBrandLogo($this->clearbitCheckerService->isValidIcon($technologyName));
    }
}
