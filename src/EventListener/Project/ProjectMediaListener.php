<?php

declare(strict_types=1);

namespace App\EventListener\Project;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use App\Enum\MediaTypeEnum;
use App\Validator\ImageUrlValidator;

#[AsEntityListener(event: Events::preFlush, method: 'handleImageType', entity: Media::class)]
class ProjectMediaListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected ImageUrlValidator $imageUrlValidator
    ) {}

    public function handleImageType(Media $media): void
    {
        $mediaFile = $media->getFile();

        if ($this->imageUrlValidator->isImageUrl($mediaFile)) {
            $media->setType(MediaTypeEnum::IMAGE);
        }
    }
}
