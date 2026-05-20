<?php

namespace App\Enum;

enum FightResult: string
{
    case PENDING = 'pending';
    case DRAW = 'draw';
    case OPPONENT1 = 'opponent1';
    case OPPONENT2 = 'opponent2';
}