<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class PotentialRankData extends Data
{
    public function __construct(
        public string $type,
        public string|array $description,
        /** @var ?array{attributes: {attributeModifiers: {attributeType: string, value: int}}[]} */
        public ?array $buff,
    ) {
    }
}
