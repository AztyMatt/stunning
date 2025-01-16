<?php

namespace App\Entity;

use App\Repository\SocialMediasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocialMediasRepository::class)]
class SocialMedias
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $xTwitter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $github = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $figma = null;

    #[ORM\OneToOne(mappedBy: 'socialMedias', cascade: ['persist', 'remove'])]
    private ?User $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getXTwitter(): ?string
    {
        return $this->xTwitter;
    }

    public function setXTwitter(?string $xTwitter): static
    {
        $this->xTwitter = $xTwitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }

    public function getFigma(): ?string
    {
        return $this->figma;
    }

    public function setFigma(string $figma): static
    {
        $this->figma = $figma;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        // unset the owning side of the relation if necessary
        if ($owner === null && $this->owner !== null) {
            $this->owner->setSocialMedias(null);
        }

        // set the owning side of the relation if necessary
        if ($owner !== null && $owner->getSocialMedias() !== $this) {
            $owner->setSocialMedias($this);
        }

        $this->owner = $owner;

        return $this;
    }
}
