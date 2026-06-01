<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->redirectToRoute('app_login');
    }

    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/create-admin', name: 'app_create_admin')]
    public function createAdmin(
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): Response {

        // Sécurité minimale (évite accès public)
        if (!$this->isGranted('ROLE_ADMIN')) {
            return new Response('Accès refusé', 403);
        }

        // Empêche la création multiple
        $existingAdmin = $em->getRepository(User::class)
            ->findOneBy(['email' => 'admin@gmail.com']);

        if ($existingAdmin) {
            return new Response('Admin déjà existant');
        }

        $user = new User();

        $user->setEmail('admin@gmail.com');
        $user->setFirstName('Admin');
        $user->setLastName('Main');
        $user->setRoles(['ROLE_ADMIN']);

        $user->setPassword(
            $hasher->hashPassword($user, 'admin123')
        );

        $em->persist($user);
        $em->flush();

        return new Response('Admin créé');
    }
}