<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageLoads(): void
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        self::assertResponseIsSuccessful();
    }

    public function testLoginRedirectIfAlreadyLogged(): void
    {
        $client = static::createClient();

        $userRepo = static::getContainer()->get('doctrine')->getRepository(\App\Entity\User::class);
        $user = $userRepo->findOneBy([]);

        if (!$user) {
            self::markTestSkipped('No user in database');
        }

        $client->loginUser($user);

        $client->request('GET', '/login');

        self::assertResponseRedirects('/home');
    }
}