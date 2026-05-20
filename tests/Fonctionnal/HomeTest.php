<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testHomePage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/home');

        $this->assertResponseIsSuccessful();
    }
}