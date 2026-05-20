<?php

namespace App\Entity;

use App\Repository\FightRepository;
use App\Enum\FightResult;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightRepository::class)]
class Fight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    private ?User $opponent1 = null;

    #[ORM\ManyToOne]
    private ?User $opponent2 = null;

    #[ORM\ManyToOne(inversedBy: 'fights')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $activity = null;

    #[ORM\Column(enumType: FightResult::class)]
    private FightResult $result = FightResult::PENDING;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getOpponent1(): ?User
    {
        return $this->opponent1;
    }

    public function setOpponent1(?User $opponent1): static
    {
        $this->opponent1 = $opponent1;
        return $this;
    }

    public function getOpponent2(): ?User
    {
        return $this->opponent2;
    }

    public function setOpponent2(?User $opponent2): static
    {
        $this->opponent2 = $opponent2;
        return $this;
    }

    public function getResult(): FightResult
    {
        return $this->result;
    }

    public function setResult(FightResult $result): self
    {
        $this->result = $result;
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
}