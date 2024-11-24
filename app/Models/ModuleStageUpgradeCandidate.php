<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\ModuleStageUpgradeCandidateData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class ModuleStageUpgradeCandidate extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = ModuleStageUpgradeCandidateData::class;

    protected $fillable = [
        'range_id',
        'description',
        'blackboard',
        'required_potential_rank',
        'unlock_condition',
    ];

    public array $translatable = [
        'description',
    ];

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function casts(): array
    {
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

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class);
    }
}
