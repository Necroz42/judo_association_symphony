<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HomeControllerTest extends WebTestCase
{
    public function testHomePageLoads(): void
    {
        $client = static::createClient();

        $client->request('GET', '/home');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('body');
    }

    public function testRootRedirects(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        self::assertResponseRedirects();
    }
}