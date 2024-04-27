<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    protected $fillable = [
        'character_id',
        'skill_id',
        'icon_id',
        'unlock_condition',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function levels(): HasMany
    {
        return $this->hasMany(SkillLevel::class);
    }
}
