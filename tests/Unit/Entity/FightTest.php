<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Fight;
use App\Enum\FightResult;
use PHPUnit\Framework\TestCase;

class FightTest extends TestCase
{
    public function testFightResult(): void
    {
        $fight = new Fight();

        $fight->setResult(FightResult::OPPONENT1);

        $this->assertSame(FightResult::OPPONENT1, $fight->getResult());
    }
}