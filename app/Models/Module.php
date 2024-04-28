<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Module extends Model
{
    use HasTranslations;

    protected $fillable = [
        'character_id',
        'module_id',
        'icon_id',
        'name',
        'description',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function moduleStages(): HasMany
    {
        return $this->hasMany(ModuleStage::class);
    }
}
