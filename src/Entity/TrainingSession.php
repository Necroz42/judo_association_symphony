<?php

namespace App\Entity;

use App\Enum\TrainingSessionDay;
use App\Repository\TrainingSessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingSessionRepository::class)]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    private array $days = [];

    #[ORM\Column(type: 'time')]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: 'time')]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Activity $activity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $coach = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDays(): array
    {
        return array_map(
            fn(string $day) => TrainingSessionDay::from($day),
            $this->days
        );
    }

    public function setDays(array $days): static
    {
        $this->days = array_map(
            fn(TrainingSessionDay $day) => $day->value,
            $days
        );

        return $this;
    }

    public function addDay(TrainingSessionDay $day): static
    {
        if (!in_array($day->value, $this->days, true)) {
            $this->days[] = $day->value;
        }

        return $this;
    }

    public function removeDay(TrainingSessionDay $day): static
    {
        $this->days = array_filter(
            $this->days,
            fn($d) => $d !== $day->value
        );

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

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

    public function getCoach(): ?User
    {
        return $this->coach;
    }

    public function setCoach(?User $coach): static
    {
        $this->coach = $coach;

        return $this;
    }
}