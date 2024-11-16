<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use App\Transformers\BaseTransformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CharacterSkillTransformer extends BaseTransformer
{
    protected array $fields = [
        'skill_id',
        'override_token_key',
        'unlock_cond',
        'levels',
    ];

    protected array $rename_keys = [
        'unlock_cond' => 'unlock_condition',
    ];

    public function transformLevels(): ?Collection
    {
        $skill_id = data_get($this->sourceReference, 'skill_id');
        $skill = Cache::get('skills_'.Locales::Chinese->value)->get($skill_id);

        return collect($skill['levels'])->map(function ($level, $level_index) use ($skill_id) {
            $level = collect((new CharacterSkillLevelTransformer($skill_id, 'skills', 'levels.'.$level_index))->transform());

            // The first level is always going to be null
            if ($level_index === 0) {
                return [
                    ...$level,
                    'lvl_up_cost' => null,
                ];
            }

            $reference_key = 'all_skill_lvlup.'.$level_index - 1;

            // Mastery Skill Level Up Conditions exists on the skill object itself instead of the all skill lvlup
            if ($level_index >= 7) {
                $mastery_index = $level_index - 7;
                $reference_key = $this->sourceReferenceKey.'.levelUpCostCond.'.$mastery_index;
            }

            $level_up_cost = collect((new CharacterSkillLevelUpCostTransformer($this->subjectKey, sourceReferenceKey: $reference_key))->transform());

            return [
                ...$level,
                'lvl_up_cost' => empty(array_filter($level_up_cost->toArray())) ? null : $level_up_cost,
            ];
        });
    }
}
