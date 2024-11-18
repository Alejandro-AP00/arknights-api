<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ItemCostData;
use App\Data\Character\ModuleStageData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class ModuleStage extends Model
{
    use WithData;

    protected string $dataClass = ModuleStageData::class;

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

        'talent_effect' => 'array',
        'trait_effect_type' => 'array',
    ];

    public array $translatable = [
        'talent_effect',
        'trait_effect_type',
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
