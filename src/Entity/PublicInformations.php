<?php

namespace App\Entity;

use App\Repository\PublicInformationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiSubresource;

#[ORM\Entity(repositoryClass: PublicInformationsRepository::class)]
class PublicInformations extends ProjectInformations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'publicInformations', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'id', nullable: false)]
    private ?Project $project = null;

    /**
     * @var Collection<int, Link>
     */
    #[Groups(['project:read'])]
    #[ApiSubresource]
    #[ORM\OneToMany(targetEntity: Link::class, mappedBy: 'publicInformations', cascade: ['persist'])]
    private Collection $links;

    /**
     * @var Collection<int, Media>
     */
    #[Groups(['project:read'])]
    #[ApiSubresource]
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'publicInformations', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Count(
        min: 1,
        minMessage: 'Public Informations need at least one media.'
    )]
    private Collection $medias;

    /**
     * @var Collection<int, Comment>
     */
    #[Groups(['project:read'])]
    #[ApiSubresource]
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'publicInformations', cascade: ['persist'])]
    private Collection $comments;

    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        // unset the owning side of the relation if necessary
        if ($project === null && $this->project !== null) {
            $this->project->setPublicInformations(null);
        }

        // set the owning side of the relation if necessary
        if ($project !== null && $project->getPublicInformations() !== $this) {
            $project->setPublicInformations($this);
        }

        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): static
    {
        if (!$this->links->contains($link)) {
            $this->links->add($link);
            $link->setPublicInformations($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getPublicInformations() === $this) {
                $link->setPublicInformations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->setPublicInformations($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getPublicInformations() === $this) {
                $media->setPublicInformations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPublicInformations($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPublicInformations() === $this) {
                $comment->setPublicInformations(null);
            }
        }

        return $this;
    }
}
