<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    private ?ProjectPublicInformations $projectPublicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    private ?ProjectPrivateInformations $projectPrivateInformations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

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
