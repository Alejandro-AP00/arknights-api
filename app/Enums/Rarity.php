<?php

namespace App\Enums;

enum Rarity: string
{
    case TIER_1 = 'TIER_1';
    case TIER_2 = 'TIER_2';
    case TIER_3 = 'TIER_3';
    case TIER_4 = 'TIER_4';
    case TIER_5 = 'TIER_5';
    case TIER_6 = 'TIER_6';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
