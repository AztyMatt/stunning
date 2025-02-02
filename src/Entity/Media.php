<?php

namespace App\Entity;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\Column(enumType: MediaTypeEnum::class)]
    private ?MediaTypeEnum $type = null;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    private ?PublicInformations $publicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    private ?PrivateInformations $privateInformations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getType(): ?MediaTypeEnum
    {
        return $this->type;
    }

    public function setType(MediaTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPublicInformations(): ?PublicInformations
    {
        return $this->publicInformations;
    }

    public function setPublicInformations(?PublicInformations $publicInformations): static
    {
        $this->publicInformations = $publicInformations;

        return $this;
    }

    public function getPrivateInformations(): ?PrivateInformations
    {
        return $this->privateInformations;
    }

    public function setPrivateInformations(?PrivateInformations $privateInformations): static
    {
        $this->privateInformations = $privateInformations;

        return $this;
    }
}
