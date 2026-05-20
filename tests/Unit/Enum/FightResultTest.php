<?php

namespace App\Tests\Unit\Enum;

use App\Enum\FightResult;
use PHPUnit\Framework\TestCase;

class FightResultTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertSame('pending', FightResult::PENDING->value);
        $this->assertSame('draw', FightResult::DRAW->value);
    }
}