<?php

namespace App\Models;

use App\Data\InterpolatedValueData;
use App\Data\ItemCostData;
use App\Data\UnlockConditionData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class ModuleStage extends Model
{
    use HasFactory;

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

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function range()
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
