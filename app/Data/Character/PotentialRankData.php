<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Data;

class PotentialRankData extends Data
{
    public function __construct(
        public ?string $type,
        public string|LocalizedFieldData $description,
        public ?array $buff,
    ) {}
}
