<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ItemCostData;
use App\Data\Character\ModuleStageData;
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
        'stage',
        'attribute_blackboard',
        'token_attribute_blackboard',
    ];

    protected function casts(): array
    {
        return [
            'item_cost' => DataCollection::class.':'.ItemCostData::class,
            'attribute_blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
            'token_attribute_blackboard' => 'array',
        ];
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function upgrades(): HasMany
    {
        return $this->hasMany(ModuleStageUpgrade::class);
    }
}
