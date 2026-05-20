<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'activities')]
    private Collection $user;

    /**
     * @var Collection<int, Session>
     */
    #[ORM\OneToMany(targetEntity: TrainingSession::class, mappedBy: 'activity', orphanRemoval: true)]
    private Collection $session;

    /**
     * @var Collection<int, Fight>
     */
    #[ORM\OneToMany(targetEntity: Fight::class, mappedBy: 'activity', orphanRemoval: true)]
    private Collection $fight;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->session = new ArrayCollection();
        $this->fight = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(TrainingSession $session): static
    {
        if (!$this->session->contains($session)) {
            $this->session->add($session);
            $session->setActivity($this);
        }

        return $this;
    }

    public function removeSession(TrainingSession $session): static
    {
        if ($this->session->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getActivity() === $this) {
                $session->setActivity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fight>
     */
    public function getFight(): Collection
    {
        return $this->fight;
    }

    public function addFight(Fight $fight): static
    {
        if (!$this->fight->contains($fight)) {
            $this->fight->add($fight);
            $fight->setActivity($this);
        }

        return $this;
    }

    public function removeFight(Fight $fight): static
    {
        if ($this->fight->removeElement($fight)) {
            // set the owning side to null (unless already changed)
            if ($fight->getActivity() === $this) {
                $fight->setActivity(null);
            }
        }

        return $this;
    }
}
