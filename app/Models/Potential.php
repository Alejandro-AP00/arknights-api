<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Potential extends Model
{
    protected $fillable = [
        'character_id',
        'type',
        'description',
        'buff',
    ];

    protected function casts(): array
    {
        return [
            'buff' => 'array',
            'description' => 'array',
        ];
    }

    public array $translatable = [
        'description',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
