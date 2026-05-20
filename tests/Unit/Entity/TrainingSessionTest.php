<?php

namespace App\Tests\Unit\Entity;

use App\Entity\TrainingSession;
use App\Enum\TrainingSessionDay;
use PHPUnit\Framework\TestCase;

class TrainingSessionTest extends TestCase
{
    public function testDays(): void
    {
        $session = new TrainingSession();

        $session->setDays([
            TrainingSessionDay::MONDAY,
            TrainingSessionDay::FRIDAY
        ]);

        $this->assertCount(2, $session->getDays());
    }
}