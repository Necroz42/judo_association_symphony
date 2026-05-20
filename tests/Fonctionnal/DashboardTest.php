<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardTest extends WebTestCase
{
    public function testDashboardPage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/dashboard');

        $this->assertResponseIsSuccessful();
    }
}