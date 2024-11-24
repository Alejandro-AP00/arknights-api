<?php

namespace App\Models;

use App\Data\Character\ModuleStageUpgradeData;
use App\Enums\ModuleStageUpgradeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class ModuleStageUpgrade extends Model
{
    use WithData;

    protected string $dataClass = ModuleStageUpgradeData::class;

    protected $fillable = [
        'is_token',
        'upgrade_type',
    ];

    protected function casts() : array {
        return [
            'is_token' => 'boolean',
            'upgrade_type' => ModuleStageUpgradeType::class,
        ];
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(ModuleStage::class, 'module_stage_id');
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(ModuleStageUpgradeCandidate::class);
    }
}
