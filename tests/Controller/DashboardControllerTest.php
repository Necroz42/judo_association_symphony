<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DashboardControllerTest extends WebTestCase
{
    public function testDashboardPageLoads(): void
    {
        $client = static::createClient();

        $client->request('GET', '/dashboard');

        self::assertResponseIsSuccessful();

        self::assertSelectorTextContains('h1', 'Dashboard');
    }

    public function testDashboardContainsSections(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard');

        self::assertResponseIsSuccessful();

        self::assertSelectorExists('div.card');

        self::assertStringContainsString(
            'Activités',
            $crawler->filter('body')->text()
        );

        self::assertStringContainsString(
            'Sessions',
            $crawler->filter('body')->text()
        );

        self::assertStringContainsString(
            'Combats',
            $crawler->filter('body')->text()
        );

        self::assertStringContainsString(
            'Membres',
            $crawler->filter('body')->text()
        );
    }
}