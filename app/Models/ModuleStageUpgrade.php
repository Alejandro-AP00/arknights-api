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

    protected array $fillable = [
        'is_token',
        'is_hidden',
        'upgrade_type',
    ];

    protected array $casts = [
        'upgrade_type' => ModuleStageUpgradeType::class
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(ModuleStage::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(ModuleStageUpgradeCandidate::class);
    }
}
