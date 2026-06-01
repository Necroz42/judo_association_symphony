<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/activity')]
final class ActivityController extends AbstractController
{
    #[Route(name: 'app_activity_index', methods: ['GET'])]
    public function index(ActivityService $activityService): Response
    {
        return $this->render('activity/index.html.twig', [
            'activities' => $activityService->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activity_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($activity);
            $entityManager->flush();

            $this->addFlash('success', 'Activité créée avec succès.');

            return $this->redirectToRoute('app_activity_index');
        }

        return $this->render('activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activity_show', methods: ['GET'])]
    public function show(Activity $activity): Response
    {
        if (!$activity) {
            throw $this->createNotFoundException('Activité introuvable.');
        }

        return $this->render('activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activity_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Activity $activity,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$activity) {
            throw $this->createNotFoundException('Activité introuvable.');
        }

        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash('success', 'Activité modifiée avec succès.');

            return $this->redirectToRoute('app_activity_index');
        }

        return $this->render('activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activity_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Activity $activity,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$activity) {
            throw $this->createNotFoundException('Activité introuvable.');
        }

        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->getPayload()->getString('_token'))) {

            $entityManager->remove($activity);
            $entityManager->flush();

            $this->addFlash('success', 'Activité supprimée.');
        } else {
            $this->addFlash('danger', 'Token CSRF invalide.');
        }

        return $this->redirectToRoute('app_activity_index');
    }
}