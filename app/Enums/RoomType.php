<?php

namespace App\Enums;

use App\Traits\EnumHasValues;

enum RoomType: string
{
    use EnumHasValues;

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
}
