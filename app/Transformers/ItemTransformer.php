<?php

namespace App\Transformers;

class ItemTransformer extends BaseTransformer
{
    protected array $fields = [
        'item_id',
        'name',
        'description',
        'usage',
        'rarity',
    ];

    protected array $localize = [
        'name',
        'description',
        'usage',
    ];
}
