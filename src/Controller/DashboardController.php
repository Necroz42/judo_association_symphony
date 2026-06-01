<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use App\Repository\TrainingSessionRepository;
use App\Repository\FightRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_MEMBER')]
    public function index(
        ActivityRepository $activityRepository,
        TrainingSessionRepository $trainingSessionRepository,
        FightRepository $fightRepository,
        UserRepository $userRepository
    ): Response {

        return $this->render('dashboard/index.html.twig', [
            'activities' => $activityRepository->findAll(),
            'trainingSessions' => $trainingSessionRepository->findAll(),
            'fights' => $fightRepository->findAll(),
            'members' => $userRepository->findAll(),
        ]);
    }
}