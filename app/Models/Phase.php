<?php

namespace App\Models;

use App\Data\Character\CharacterPhaseData;
use App\Data\Character\ItemCostData;
use App\Data\Character\KeyFrameData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class Phase extends Model
{
    use WithData;

    protected string $dataClass = CharacterPhaseData::class;

    protected $fillable = [
        'character_id',
        'range_id',
        'character_prefab_key',
        'max_level',
        'evolve_cost',
        'attributes_key_frames',
    ];

    protected function casts() : array {
        return [
            'evolve_cost' => DataCollection::class.':'.ItemCostData::class,
            'attributes_key_frames' => DataCollection::class.':'.KeyFrameData::class,
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
