<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FightPageTest extends WebTestCase
{
    public function testFightIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/fight');

        $this->assertResponseIsSuccessful();
    }
}