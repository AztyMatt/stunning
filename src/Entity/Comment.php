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
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?ProjectPublicInformations $projectPublicInformations = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?ProjectPrivateInformations $projectPrivateInformations = null;

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
