<?php

namespace App\Transformers\Characters;

use App\Transformers\RangeTransformer;

class CharacterTalentTransformer extends BaseTransformer
{
    protected array $fields = [
        'unlock_condition',
        'required_potential_rank',
        'name',
        'description',
        'range_id',
        'blackboard',
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
