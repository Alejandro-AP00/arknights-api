<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum TokenType: string
{
    use EnumHasValues;

    case OriginiumPrime = 'OriginiumPrime';
    case ContingencyContractToken = 'ContingencyContractToken';
    case Unknown = 'Unknown';  // Add a default/unknown type if needed
}
