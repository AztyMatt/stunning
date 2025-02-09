<?php

namespace App\Entity;

use App\Repository\PrivateInformationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivateInformationsRepository::class)]
class PrivateInformations extends ProjectInformations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'privateInformations', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'project_id', referencedColumnName: 'id', nullable: false)]
    private ?Project $project = null;

    /**
     * @var Collection<int, Link>
     */
    #[ORM\OneToMany(targetEntity: Link::class, mappedBy: 'privateInformations', cascade: ['persist'])]
    private Collection $links;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'privateInformations', cascade: ['persist'])]
    private Collection $medias;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'privateInformations', cascade: ['persist'])]
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
            $this->project->setPrivateInformations(null);
        }

        // set the owning side of the relation if necessary
        if ($project !== null && $project->getPrivateInformations() !== $this) {
            $project->setPrivateInformations($this);
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
            $link->setPrivateInformations($this);
        }

        return $this;
    }

    public function removeLink(Link $link): static
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getPrivateInformations() === $this) {
                $link->setPrivateInformations(null);
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
            $media->setPrivateInformations($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getPrivateInformations() === $this) {
                $media->setPrivateInformations(null);
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
            $comment->setPrivateInformations($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPrivateInformations() === $this) {
                $comment->setPrivateInformations(null);
            }
        }

        return $this;
    }
}
