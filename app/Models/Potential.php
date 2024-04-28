<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Potential extends Model
{
    use HasTranslations;

    protected $fillable = [
        'character_id',
        'type',
        'description',
        'buff',
    ];

    public array $translatable = [
        'description',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
