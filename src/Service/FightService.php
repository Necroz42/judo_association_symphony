<?php

namespace App\Service;

use App\Entity\Fight;
use App\Repository\FightRepository;
use Doctrine\ORM\EntityManagerInterface;

class FightService
{
    public function __construct(
        private FightRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Fight
    {
        return $this->repository->find($id);
    }

    public function save(Fight $fight): void
    {
        $this->em->persist($fight);
        $this->em->flush();
    }

    public function delete(Fight $fight): void
    {
        $this->em->remove($fight);
        $this->em->flush();
    }

    public function setWinner(Fight $fight, User $winner): void
    {
        $fight->setWinner($winner);

        $winner->setVictories(
            $winner->getVictories() + 1
        );

        $this->em->flush();
    }
}