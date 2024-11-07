<?php

namespace App\Transformers\Characters;

use App\Transformers\RangeTransformer;

class CharacterTraitCandidateTransformer extends BaseTransformer
{
    protected array $fields = [
        'override_description',
        'range_id',
        'required_potential_rank',
        'unlock_condition',
        'blackboard',
    ];

    protected array $localize = [
        'override_description',
    ];

    public function transformRangeId()
    {
        $range_id = $this->sourceReference->get('range_id');
        $this->output['range'] = ! empty($range_id) ? (new RangeTransformer($range_id))->transform() : null;

        return $range_id;
    }
}
