<?php

namespace App\Entity;

use App\Enum\UserCountryEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;
    private ?string $plainPassword = '';

    #[ORM\Column(length: 255)]
    private ?string $profilePicture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $banner = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $websiteLink = null;

    #[ORM\Column(nullable: true, enumType: UserCountryEnum::class)]
    private ?UserCountryEnum $country = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(inversedBy: 'owner', cascade: ['persist', 'remove'])]
    private ?SocialMedias $socialMedias = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users')]
    private Collection $projects;

    /**
     * @var Collection<int, Group>
     */
    #[ORM\OneToMany(targetEntity: Group::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $groups;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'author')]
    private Collection $comments;

    /**
     * @var Collection<int, Invitation>
     */
    #[ORM\OneToMany(targetEntity: Invitation::class, mappedBy: 'sender')]
    private Collection $invitationsSent;

    /**
     * @var Collection<int, Invitation>
     */
    #[ORM\ManyToMany(targetEntity: Invitation::class, mappedBy: 'receiver')]
    private Collection $invitationsReceived;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'uuid', nullable: true)]
    private ?Uuid $resetToken = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->groups = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->invitations = new ArrayCollection();
        $this->invitationsSent = new ArrayCollection();
        $this->invitationsReceived = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): static
    {
        $this->banner = $banner;

        return $this;
    }

    public function getWebsiteLink(): ?string
    {
        return $this->websiteLink;
    }

    public function setWebsiteLink(?string $websiteLink): static
    {
        $this->websiteLink = $websiteLink;

        return $this;
    }

    public function getCountry(): ?UserCountryEnum
    {
        return $this->country;
    }

    public function setCountry(?UserCountryEnum $country): static
    {
        $this->country = $country;

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

    public function getSocialMedias(): ?SocialMedias
    {
        return $this->socialMedias;
    }

    public function setSocialMedias(?SocialMedias $socialMedias): static
    {
        $this->socialMedias = $socialMedias;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        $this->projects->removeElement($project);

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
            $group->setOwner($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): static
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getOwner() === $this) {
                $group->setOwner(null);
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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invitation>
     */
    public function getInvitationsSent(): Collection
    {
        return $this->invitationsSent;
    }

    public function addInvitationsSent(Invitation $invitationsSent): static
    {
        if (!$this->invitationsSent->contains($invitationsSent)) {
            $this->invitationsSent->add($invitationsSent);
            $invitationsSent->setSender($this);
        }

        return $this;
    }

    public function removeInvitationsSent(Invitation $invitationsSent): static
    {
        if ($this->invitationsSent->removeElement($invitationsSent)) {
            // set the owning side to null (unless already changed)
            if ($invitationsSent->getSender() === $this) {
                $invitationsSent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invitation>
     */
    public function getInvitationsReceived(): Collection
    {
        return $this->invitationsReceived;
    }

    public function addInvitationsReceived(Invitation $invitationsReceived): static
    {
        if (!$this->invitationsReceived->contains($invitationsReceived)) {
            $this->invitationsReceived->add($invitationsReceived);
            $invitationsReceived->addReceiver($this);
        }

        return $this;
    }

    public function removeInvitationsReceived(Invitation $invitationsReceived): static
    {
        if ($this->invitationsReceived->removeElement($invitationsReceived)) {
            $invitationsReceived->removeReceiver($this);
        }

        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getResetToken(): ?Uuid
    {
        return $this->resetToken;
    }

    public function setResetToken(?Uuid $resetToken): static
    {
        $this->resetToken = $resetToken;

        return $this;
    }
}
