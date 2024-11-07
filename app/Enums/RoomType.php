<?php

namespace App\Enums;

enum RoomType: string
{
    case CONTROL = 'CONTROL';
    case CORRIDOR = 'CORRIDOR';
    case DORMITORY = 'DORMITORY';
    case ELEVATOR = 'ELEVATOR';
    case FUNCTIONAL = 'FUNCTIONAL';
    case HIRE = 'HIRE';
    case MANUFACTURE = 'MANUFACTURE';
    case MEETING = 'MEETING';
    case NONE = 'NONE';
    case POWER = 'POWER';
    case TRADING = 'TRADING';
    case TRAINING = 'TRAINING';
    case WORKSHOP = 'WORKSHOP';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
