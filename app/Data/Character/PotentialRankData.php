<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Data;

class PotentialRankData extends Data
{
    public function __construct(
        public string $type,
        public LocalizedFieldData $description,
        /** @var ?array{attributes: {attributeModifiers: {attributeType: string, value: int}}[]} */
        public ?array $buff,
    ) {
    }
}
