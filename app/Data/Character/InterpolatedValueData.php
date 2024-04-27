<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class InterpolatedValueData extends Data
{
    public function __construct(
        public string $key,
        public int $value,
    ) {
    }
}
