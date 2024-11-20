<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum Position: string
{
    use EnumHasValues;

    case ALL = 'ALL';
    case MELEE = 'MELEE';
    case NONE = 'NONE';
    case RANGED = 'RANGED';
}
