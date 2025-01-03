<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;

class TraitCandidate extends Model
{
    protected $fillable = [
        'character_id',
        'range_id',
        'required_potential_rank',
        'unlock_condition',
        'blackboard',
    ];

    protected function casts(): array
    {
        return [
            'unlock_condition' => UnlockConditionData::class,
            'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
        ];
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
