<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class BaseSkill extends Model
{
    use HasTranslations;

    protected $fillable = [
        'character_id',
        'buff_id',
        'skill_icon',
        'name',
        'description',
        'unlock_condition',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
