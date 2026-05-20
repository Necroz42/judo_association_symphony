<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testFullName(): void
    {
        $user = new User();

        $user->setFirstName('Jean');
        $user->setLastName('Dupont');

        $this->assertSame('Jean Dupont', $user->getFullName());
    }
}