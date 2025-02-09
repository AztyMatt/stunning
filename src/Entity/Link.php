<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['project:read'])]
    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[Groups(['project:read'])]
    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'links', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?PublicInformations $publicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'links', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?PrivateInformations $privateInformations = null;

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
