<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?PublicInformations $publicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?PrivateInformations $privateInformations = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

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
        if ($privateInformations !== null && $this->author !== null) {
            $project = $privateInformations->getProject();
            if ($project !== null && !$project->getUsers()->contains($this->author)) {
                throw new \LogicException("Cannot add comment: the user is not part of the project.");
            }
        }

        $this->privateInformations = $privateInformations;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
