<?php

namespace App\Models;

use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\InterpolatedValueData;
use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\SkillLevelUpCostData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class SkillLevel extends Model
{
    use HasFactory;

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
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function range()
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
