<?php

namespace App\Enums;

enum TokenType: string
{
    case OriginiumPrime = 'OriginiumPrime';
    case ContingencyContractToken = 'ContingencyContractToken';
    case Unknown = 'Unknown';  // Add a default/unknown type if needed

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
