<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ModuleStageUpgradeCandidateData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class ModuleStageUpgradeCandidate extends Model
{
    use WithData;

    protected string $dataClass = ModuleStageUpgradeCandidateData::class;

    protected $fillable = [
        'range_id',
        'description',
        'blackboard',
        'required_potential_rank',
        'unlock_condition',
    ];

    protected function casts() : array {
        return [
            'description' => 'array',
            'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
            'unlock_condition' => UnlockConditionData::class,
        ];
    }

    public function upgrade(): BelongsTo
    {
        return $this->belongsTo(ModuleStageUpgrade::class, 'module_stage_upgrade_id');
    }

    public function range() : BelongsTo {
        return $this->belongsTo(Range::class);
    }
}
