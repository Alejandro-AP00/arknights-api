<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum Rarity: string
{
    use EnumHasValues;

    case TIER_1 = 'TIER_1';
    case TIER_2 = 'TIER_2';
    case TIER_3 = 'TIER_3';
    case TIER_4 = 'TIER_4';
    case TIER_5 = 'TIER_5';
    case TIER_6 = 'TIER_6';
}
