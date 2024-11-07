<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;
use App\Transformers\RangeTransformer;
use Illuminate\Support\Collection;

class CharacterPhaseTransformer extends BaseTransformer
{
    protected array $fields = [
        'character_prefab_key',
        'range_id',
        'max_level',
        'attributes_key_frames',
        'evolve_cost',
    ];

    public function transformAttributesKeyFrames(): Collection
    {
        return collect($this->sourceReference->get('attributes_key_frames'))->map(fn ($keyframe) => ['level' => $keyframe['level'], ...$keyframe['data']]);
    }

    public function transformEvolveCost(): Collection
    {
        return collect($this->sourceReference->get('evolve_cost'))->map(fn ($cost) => ['itemId' => $cost['id'], 'count' => $cost['count']]);
    }

    public function transformRangeId()
    {
        $range_id = $this->sourceReference->get('range_id');
        $this->output['range'] = (new RangeTransformer($range_id))->transform();

        return $range_id;
    }
}
