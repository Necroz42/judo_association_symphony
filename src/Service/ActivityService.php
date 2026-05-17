<?php

namespace App\Service;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActivityService
{
    public function __construct(
        private ActivityRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Activity
    {
        return $this->repository->find($id);
    }

    public function save(Activity $activity): void
    {
        $this->em->persist($activity);
        $this->em->flush();
    }

    public function delete(Activity $activity): void
    {
        $this->em->remove($activity);
        $this->em->flush();
    }
}