<?php

namespace App\Models;

use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\InterpolatedValueData;
use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class TraitCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'range_id',
        'required_potential_rank',
        'unlock_condition',
        'blackboard',
    ];

    protected $casts = [
        'unlock_condition' => UnlockConditionData::class,
        'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function range()
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
