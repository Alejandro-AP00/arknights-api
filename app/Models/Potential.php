<?php

namespace App\Models;

use App\Data\Character\PotentialRankData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Potential extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = PotentialRankData::class;

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
