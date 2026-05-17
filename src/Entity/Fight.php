<?php

namespace App\Entity;

use App\Repository\FightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightRepository::class)]
class Fight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column]
    private ?int $opponent1 = null;

    #[ORM\Column]
    private ?int $opponent2 = null;

    #[ORM\ManyToOne(inversedBy: 'fight')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $activity = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'fight')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getOpponent1(): ?int
    {
        return $this->opponent1;
    }

    public function setOpponent1(int $opponent1): static
    {
        $this->opponent1 = $opponent1;

        return $this;
    }

    public function getOpponent2(): ?int
    {
        return $this->opponent2;
    }

    public function setOpponent2(int $opponent2): static
    {
        $this->opponent2 = $opponent2;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): static
    {
        $this->activity = $activity;

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
            $user->addFight($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeFight($this);
        }

        return $this;
    }
}
