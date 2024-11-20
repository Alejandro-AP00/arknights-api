<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum SkinSource: string
{
    use EnumHasValues;

    case ContingencyContractStore = 'ContingencyContractStore';
    case OutfitStore = 'OutfitStore';
    case RedemptionCode = 'RedemptionCode';
    case IntegratedStrategies = 'IntegratedStrategies';
    case Event = 'Event';
    case RealWorldPromotion = 'RealWorldPromotion';
    case Unknown = 'Unknown';
}
