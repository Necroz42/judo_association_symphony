<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrainingSessionPageTest extends WebTestCase
{
    public function testTrainingSessionIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/training-session');

        $this->assertResponseIsSuccessful();
    }
}