<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BaseSkillCharacter extends Pivot
{
    protected $fillable = [
        'unlock_condition',
    ];

    protected $casts = [
        'unlock_condition' => 'array',
    ];
}
