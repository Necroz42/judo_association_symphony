<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterUser(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        /** @var EntityManagerInterface $em */
        $em = $container->get('doctrine')->getManager();
        $userRepository = $container->get(UserRepository::class);

        foreach ($userRepository->findAll() as $user) {
            $em->remove($user);
        }
        $em->flush();

        // GET register page
        $client->request('GET', '/register');

        self::assertResponseIsSuccessful();

        // POST register
        $client->submitForm('Register', [
            'registration_form[email]' => 'test@example.com',
            'registration_form[plainPassword]' => 'password123',
        ]);

        // User created
        self::assertSame(1, $userRepository->count([]));

        $user = $userRepository->findAll()[0];

        self::assertSame('test@example.com', $user->getEmail());
        self::assertContains('ROLE_MEMBER', $user->getRoles());
    }
}