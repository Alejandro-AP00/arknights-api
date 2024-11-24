<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\SkillLevelData;
use App\Data\Character\SkillLevelUpCostData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class SkillLevel extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = SkillLevelData::class;

    protected $fillable = [
        'skill_id',
        'range_id',
        'name',
        'description',
        'skill_type',
        'duration_type',
        'sp_data',
        'duration',
        'blackboard',
        'lvl_up_cost',
    ];

    public array $translatable = [
        'name',
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
            'lvl_up_cost' => SkillLevelUpCostData::class,
            'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,

            'sp_data' => 'array',
        ];
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
