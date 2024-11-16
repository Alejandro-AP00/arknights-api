<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\SkillLevelUpCostData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class SkillLevel extends Model
{
    use WithData;

    protected string $dataClass = SkillLevelUpCostData::class;

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

    protected $casts = [
        'lvl_up_cost' => SkillLevelUpCostData::class,
        'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,

        'name' => 'array',
        'description' => 'array',

        'sp_data' => 'array',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
