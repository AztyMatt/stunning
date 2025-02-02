<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationRepository::class)]
class Invitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'invitations')]
    #[ORM\JoinColumn]
    private ?Project $project = null;

    #[ORM\ManyToOne(inversedBy: 'invitationsSent')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?User $sender = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'invitationsReceived')]
    private Collection $receiver;

    public function __construct()
    {
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): static
    {
        if ($sender !== null) {
            if (!$this->project) {
                throw new \LogicException("Cannot send invitation: the project is not set.");
            }

            if (!$this->project->getUsers()->contains($sender)) {
                throw new \LogicException("Cannot send invitation: the user is not part of the project.");
            }
        }

        $this->sender = $sender;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(User $receiver): static
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver->add($receiver);
        }

        return $this;
    }

    public function removeReceiver(User $receiver): static
    {
        $this->receiver->removeElement($receiver);

        return $this;
    }
}
