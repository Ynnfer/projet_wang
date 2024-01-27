<?php

namespace App\Enum;

enum GameStatus: string
{
    case Released = 'released';
    case Unreleased = 'unreleased';
    case Withdrawn = 'withdrawn';
}
