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
    private ?ProjectPublicInformations $projectPublicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    private ?ProjectPrivateInformations $projectPrivateInformations = null;

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

    public function getProjectPublicInformations(): ?ProjectPublicInformations
    {
        return $this->projectPublicInformations;
    }

    public function setProjectPublicInformations(?ProjectPublicInformations $projectPublicInformations): static
    {
        $this->projectPublicInformations = $projectPublicInformations;

        return $this;
    }

    public function getProjectPrivateInformations(): ?ProjectPrivateInformations
    {
        return $this->projectPrivateInformations;
    }

    public function setProjectPrivateInformations(?ProjectPrivateInformations $projectPrivateInformations): static
    {
        $this->projectPrivateInformations = $projectPrivateInformations;

        return $this;
    }
}
