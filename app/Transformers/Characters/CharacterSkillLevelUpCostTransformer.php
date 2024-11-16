<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;

class CharacterSkillLevelUpCostTransformer extends BaseTransformer
{
    protected array $fields = [
        'unlock_cond',
        'lvl_up_cost',
    ];

    protected array $rename_keys = [
        'lvl_up_cost' => 'item_cost',
    ];

    public function transformLvlUpCost()
    {
        return data_get($this->sourceReference, 'lvl_up_cost') ?? data_get($this->sourceReference, 'level_up_cost');
    }
}
