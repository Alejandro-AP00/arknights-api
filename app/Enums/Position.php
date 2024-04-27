<?php

namespace App\Enums;

enum Position: string
{
    case ALL = 'ALL';
    case MELEE = 'MELEE';
    case NONE = 'NONE';
    case RANGED = 'RANGED';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
