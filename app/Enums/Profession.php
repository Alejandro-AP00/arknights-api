<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum Profession: string
{
    use EnumHasValues;

    case CASTER = 'CASTER';
    case TANK = 'TANK';
    case WARRIOR = 'WARRIOR';
    case MEDIC = 'MEDIC';
    case SNIPER = 'SNIPER';
    case SPECIAL = 'SPECIAL';
    case SUPPORT = 'SUPPORT';
    case PIONEER = 'PIONEER';
    case TOKEN = 'TOKEN';
    case TRAP = 'TRAP';

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public function label(): string
    {
        return match ($this) {
            self::CASTER => 'Caster',
            self::TANK => 'Defender',
            self::WARRIOR => 'Guard',
            self::MEDIC => 'Medic',
            self::SNIPER => 'Sniper',
            self::SPECIAL => 'Specialist',
            self::SUPPORT => 'Supporter',
            self::PIONEER => 'Vanguard',
            self::TOKEN => 'Token',
            self::TRAP => 'Trap',
        };
    }
}
