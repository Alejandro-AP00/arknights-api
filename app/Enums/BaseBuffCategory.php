<?php

namespace App\Enums;

enum BaseBuffCategory: string
{
    case FUNCTION = 'FUNCTION';
    case OUTPUT = 'OUTPUT';
    case RECOVERY = 'RECOVERY';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
