<?php

namespace App\Enums;

enum SkinSource: string
{
    case ContingencyContractStore = 'ContingencyContractStore';
    case OutfitStore = 'OutfitStore';
    case RedemptionCode = 'RedemptionCode';
    case IntegratedStrategies = 'IntegratedStrategies';
    case Event = 'Event';
    case RealWorldPromotion = 'RealWorldPromotion';
    case Unknown = 'Unknown';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
