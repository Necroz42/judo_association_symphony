<?php

namespace App\Controller;

use App\Entity\TrainingSession;
use App\Form\TrainingSessionType;
use App\Service\TrainingSessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/training-session')]
final class TrainingSessionController extends AbstractController
{
    #[Route(name: 'app_training_session_index', methods: ['GET'])]
    public function index(TrainingSessionService $trainingSessionService): Response
    {
        return $this->render('training_session/index.html.twig', [
            'trainingSessions' => $trainingSessionService->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_training_session_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $trainingSession = new TrainingSession();

        $form = $this->createForm(TrainingSessionType::class, $trainingSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trainingSession);
            $entityManager->flush();

            return $this->redirectToRoute('app_training_session_index');
        }

        return $this->render('training_session/new.html.twig', [
            'trainingSession' => $trainingSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_session_show', methods: ['GET'])]
    public function show(TrainingSession $trainingSession): Response
    {
        return $this->render('training_session/show.html.twig', [
            'trainingSession' => $trainingSession,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_training_session_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        TrainingSession $trainingSession,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(TrainingSessionType::class, $trainingSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_training_session_index');
        }

        return $this->render('training_session/edit.html.twig', [
            'trainingSession' => $trainingSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_session_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        TrainingSession $trainingSession,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $trainingSession->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainingSession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_training_session_index');
    }
}