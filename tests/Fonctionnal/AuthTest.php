<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthTest extends WebTestCase
{
    public function testRootRedirect(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseRedirects('/home');
    }
}