<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum ModuleStageUpgradeType: string
{
    use EnumHasValues;

    case TRAIT_UPGRADE = 'TRAIT_UPGRADE';
    case TRAIT_OVERRIDE = 'TRAIT_OVERRIDE';
    case TALENT_UPGRADE = 'TALENT_UPGRADE';
}
