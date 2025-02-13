<?php

namespace App\Entity;

use App\Enum\ProjectVisibilityEnum;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiSubresource;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['project:read']],
)]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[Groups(['project:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['project:read'])]
    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\Column(enumType: ProjectVisibilityEnum::class)]
    private ?ProjectVisibilityEnum $visibility = null;

    #[Groups(['project:read'])]
    #[ORM\Column]
    private ?int $numberOfViews = null;

    #[Groups(['project:read'])]
    #[ORM\Column]
    private ?int $likes = null;

    #[Groups(['project:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups(['project:read'])]
    #[ApiSubresource]
    #[ORM\OneToOne(mappedBy: 'project', cascade: ['persist', 'remove'])]
    private ?PublicInformations $publicInformations = null;

    #[ORM\OneToOne(mappedBy: 'project', cascade: ['persist', 'remove'])]
    private ?PrivateInformations $privateInformations = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'projects')]
    private Collection $users;

    /**
     * @var Collection<int, Technology>
     */
    #[ORM\ManyToMany(targetEntity: Technology::class, inversedBy: 'projects', cascade: ['persist'])]
    private Collection $technologies;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'projects', cascade: ['persist'])]
    private Collection $tags;

    /**
     * @var Collection<int, Invitation>
     */
    #[ORM\OneToMany(targetEntity: Invitation::class, mappedBy: 'project')]
    private Collection $invitations;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'projects',  cascade: ['persist', 'remove'])]
    private Collection $groups;

    public function __construct()
    {
        $this->visibility = ProjectVisibilityEnum::PUBLIC;
        $this->numberOfViews = 0;
        $this->likes = 0;
        $this->createdAt = new \DateTimeImmutable();
        $this->invitations = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->groups = new ArrayCollection();
    }

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

    public function getVisibility(): ?ProjectVisibilityEnum
    {
        return $this->visibility;
    }

    public function setVisibility(ProjectVisibilityEnum $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->numberOfViews;
    }

    public function setNumberOfViews(int $numberOfViews): static
    {
        $this->numberOfViews = $numberOfViews;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addProject($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Technology>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): static
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies->add($technology);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): static
    {
        $this->technologies->removeElement($technology);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Invitation>
     */
    public function getInvitations(): Collection
    {
        return $this->invitations;
    }

    public function addInvitation(Invitation $invitation): static
    {
        if (!$this->invitations->contains($invitation)) {
            $this->invitations->add($invitation);
            $invitation->setProject($this);
        }

        return $this;
    }

    public function removeInvitation(Invitation $invitation): static
    {
        if ($this->invitations->removeElement($invitation)) {
            // set the owning side to null (unless already changed)
            if ($invitation->getProject() === $this) {
                $invitation->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): static
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
            $group->addProject($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): static
    {
        if ($this->groups->removeElement($group)) {
            $group->removeProject($this);
        }

        return $this;
    }
}
