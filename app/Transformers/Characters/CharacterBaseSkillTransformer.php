<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;

class CharacterBaseSkillTransformer extends BaseTransformer
{
    protected array $fields = [
        'buff_id',
        'buff_color',
        'text_color',
        'skill_icon',
        'room_type',
        'buff_category',
        'buff_name',
        'description',
    ];

    protected array $localize = [
        'buff_name',
        'description',
    ];

    protected array $rename_keys = [
        'buff_name' => 'name',
    ];
}
