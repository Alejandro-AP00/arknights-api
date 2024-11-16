<?php

namespace App\Models;

use App\Data\Character\SkillData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Skill extends Model
{
    use WithData;

    protected string $dataClass = SkillData::class;

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
