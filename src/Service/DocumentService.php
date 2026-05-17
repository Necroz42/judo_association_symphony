<?php

namespace App\Service;

use App\Entity\Document;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;

class DocumentService
{
    public function __construct(
        private DocumentRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Document
    {
        return $this->repository->find($id);
    }

    public function save(Document $document): void
    {
        $this->em->persist($document);
        $this->em->flush();
    }

    public function delete(Document $document): void
    {
        $this->em->remove($document);
        $this->em->flush();
    }
}