<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;

class CharacterPotentialRank extends BaseTransformer
{
    protected array $fields = [
        'type',
        'description',
        'buff',
    ];

    protected array $localize = [
        'description',
    ];
}
