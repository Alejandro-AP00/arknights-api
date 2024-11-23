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

class Module extends Model
{
    use WithData;

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
        'unlock_missions',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    protected function casts() : array {
        return [
            'name' => 'array',
            'description' => 'array',

            'unlock_condition' => UnlockConditionData::class,
            'unlock_missions' => DataCollection::class.':'.UnlockMissionData::class,
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
}
