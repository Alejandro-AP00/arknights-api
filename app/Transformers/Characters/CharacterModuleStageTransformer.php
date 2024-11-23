<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;
use Illuminate\Support\Collection;

class CharacterModuleStageTransformer extends BaseTransformer
{
    protected array $fields = [
        'equip_level',
        'attribute_blackboard',
        'token_attribute_blackboard',
    ];

    protected array $rename_keys = [
        'equip_level' => 'stage',
    ];
}
