<?php

namespace App\Service;

use App\Entity\TrainingSession;
use App\Repository\TrainingSessionRepository;
use Doctrine\ORM\EntityManagerInterface;

class TrainingSessionService
{
    public function __construct(
        private TrainingSessionRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?TrainingSession
    {
        return $this->repository->find($id);
    }
    
    public function save(TrainingSession $session): void
    {
        $this->em->persist($session);
        $this->em->flush();
    }

    public function delete(TrainingSession $session): void
    {
        $this->em->remove($session);
        $this->em->flush();
    }

    public function findUpcomingSessions(): array
    {
        return $this->repository->createQueryBuilder('s')
            ->where('s.date >= :today')
            ->setParameter('today', new \DateTime())
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult();
    }
}