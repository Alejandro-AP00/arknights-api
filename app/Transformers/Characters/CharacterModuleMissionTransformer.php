<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;

class CharacterModuleMissionTransformer extends BaseTransformer
{
    protected array $fields = [
        'desc',
        'uni_equip_mission_id',
        'jump_stage_id',
    ];

    protected array $localize = [
        'desc',
    ];

    protected array $rename_keys = [
        'desc' => 'description',
        'uni_equip_mission_id' => 'mission_id',
    ];
}
