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
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->redirectToRoute('app_home');
    }

    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/create-admin')]
public function createAdmin(
    UserPasswordHasherInterface $hasher,
    EntityManagerInterface $em
): Response {
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