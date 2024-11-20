<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ItemCostData;
use App\Data\Character\ModuleStageData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class ModuleStage extends Model
{
    use WithData;

    protected string $dataClass = ModuleStageData::class;

    protected $fillable = [
        'module_id',
        'item_cost',
        'unlock_condition',
        'trait_effect_type',
        'attributes_blackboard',
        'token_attributes_blackboard',
    ];

    protected $casts = [
        'item_cost' => DataCollection::class.':'.ItemCostData::class,
        'unlock_condition' => UnlockConditionData::class,
        'attributes_blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
        'token_attributes_blackboard' => 'array',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function moduleUpgrades() : HasMany
    {
        return $this->hasMany(ModuleStageUpgrade::class);
    }
}
