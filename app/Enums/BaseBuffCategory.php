<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum BaseBuffCategory: string
{
    use EnumHasValues;

    case FUNCTION = 'FUNCTION';
    case OUTPUT = 'OUTPUT';
    case RECOVERY = 'RECOVERY';
}
