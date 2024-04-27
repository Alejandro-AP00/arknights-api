<?php

namespace App\Data\Character;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ItemCostData extends Data
{
    public function __construct(
        public string $itemId,
        public int $count,
    ) {
    }
}
