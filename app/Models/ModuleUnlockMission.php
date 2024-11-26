<?php

namespace App\Models;

use App\Data\Character\UnlockMissionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class ModuleUnlockMission extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = UnlockMissionData::class;

    protected $fillable = [
        'module_id',
        'mission_id',
        'description',
        'jump_stage_id',
    ];

    public array $translatable = [
        'description',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
