<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class InterpolatedValueData extends Data
{
    public function __construct(
        public string $key,
        public int $value,
    ) {
    }
}
