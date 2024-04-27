<?php

namespace App\Transformers\Characters;

use App\Transformers\RangeTransformer;

class CharacterPhaseTransformer extends BaseTransformer
{
    protected $fields = [
        'character_prefab_key',
        'range_id',
        'max_level',
        'attributes_key_frames',
        'evolve_cost',
    ];

    public function transformAttributesKeyFrames()
    {
        return collect($this->sourceReference->get('attributes_key_frames'))->map(fn ($keyframe) => ['level' => $keyframe['level'], ...$keyframe['data']]);
    }

    public function transformRangeId()
    {
        $range_id = $this->sourceReference->get('range_id');
        $this->output['range'] = (new RangeTransformer($range_id))->transform();

        return $range_id;
    }
}
