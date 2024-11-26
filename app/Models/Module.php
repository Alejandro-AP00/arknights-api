<?php

namespace App\Models;

use App\Data\Character\ModuleData;
use App\Data\Character\UnlockConditionData;
use App\Data\Character\UnlockMissionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Module extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = ModuleData::class;

    protected $fillable = [
        'character_id',
        'module_id',
        'icon_id',
        'name',
        'description',
        'type_icon',
        'type_name1',
        'type_name2',
        'shining_color',
        'type',
        'order_by',
        'unlock_condition',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'unlock_condition' => UnlockConditionData::class,
        ];
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function stages(): HasMany
    {
        return $this->hasMany(ModuleStage::class);
    }

    public function unlockMissions() : HasMany
    {
        return $this->hasMany(ModuleUnlockMission::class);
    }
}
