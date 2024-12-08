<?php

namespace App\Data;

use App\Enums\Rarity;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ItemData extends Data
{
    public function __construct(
        public string $itemId,
        public string|LocalizedFieldData $name,
        public string|LocalizedFieldData $description,
        public string|LocalizedFieldData $usage,
        public Rarity $rarity,
    ) {}
}
