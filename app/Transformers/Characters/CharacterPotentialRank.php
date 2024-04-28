<?php

namespace App\Transformers\Characters;

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
