<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActivityControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/activity');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Activités');
    }

    public function testNewPage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/activity/new');

        $this->assertResponseIsSuccessful();
    }
}