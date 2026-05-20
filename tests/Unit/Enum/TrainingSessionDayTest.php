<?php

namespace App\Tests\Unit\Enum;

use App\Enum\TrainingSessionDay;
use PHPUnit\Framework\TestCase;

class TrainingSessionDayTest extends TestCase
{
    public function testDaysExist(): void
    {
        $this->assertNotEmpty(TrainingSessionDay::cases());
    }
}