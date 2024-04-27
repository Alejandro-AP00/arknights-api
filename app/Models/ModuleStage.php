<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ItemCostData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;

class ModuleStage extends Model
{
    protected $fillable = [
        'module_id',
        'range_id',
        'item_cost',
        'unlock_condition',
        'trait_effect_type',
        'talent_effect',
        'talent_index',
        'display_range',
        'attributes_blackboard',
        'required_potential_rank',
        'token_attributes_blackboard',
    ];

    protected $casts = [
        'item_cost' => DataCollection::class.':'.ItemCostData::class,
        'unlock_condition' => UnlockConditionData::class,
        'attributes_blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}