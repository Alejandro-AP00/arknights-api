<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;
use App\Transformers\RangeTransformer;

class CharacterSkillLevelTransformer extends BaseTransformer
{
    protected array $fields = [
        'name',
        'description',
        'skill_type',
        'duration_type',
        'sp_data',
        'duration',
        'blackboard',
        'range_id',
    ];

    protected array $localize = [
        'name',
        'description',
    ];

    public function transformRangeId()
    {
        $range_id = $this->sourceReference->get('range_id');
        $this->output['range'] = ! empty($range_id) ? (new RangeTransformer($range_id))->transform() : null;

        return $range_id;
    }
}
