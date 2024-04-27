<?php

namespace App\Enums;

enum Profession: string
{
    case CASTER = 'CASTER';
    case TANK = 'DEFENDER';
    case WARRIOR = 'GUARD';
    case MEDIC = 'MEDIC';
    case SNIPER = 'SNIPER';
    case SPECIAL = 'SPECIALIST';
    case SUPPORT = 'SUPPORTER';
    case PIONEER = 'VANGUARD';
    case TOKEN = 'TOKEN';
    case TRAP = 'TRAP';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
