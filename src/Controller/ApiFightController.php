<?php

namespace App\Controller;

use App\Repository\FightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ApiFightController extends AbstractController
{
    #[Route('/api/fights', name: 'api_fights_list', methods: ['GET'])]
    public function list(FightRepository $fightRepository): JsonResponse
    {
        $fights = $fightRepository->findAll();

        $data = [];

        foreach ($fights as $fight) {
            $data[] = [
                'id' => $fight->getId(),
                'name' => $fight->getName(), // adapte si besoin
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/fights/{id}', name: 'api_fight_show', methods: ['GET'])]
    public function show(FightRepository $fightRepository, int $id): JsonResponse
    {
        $fight = $fightRepository->find($id);

        if (!$fight) {
            return $this->json(['error' => 'Fight not found'], 404);
        }

        return $this->json([
            'id' => $fight->getId(),
            'name' => $fight->getName(),
        ]);
    }
}