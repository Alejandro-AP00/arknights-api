<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaseSkill extends Model
{
    protected $fillable = [
        'character_id',
        'buff_id',
        'skill_icon',
        'name',
        'description',
        'unlock_condition',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
