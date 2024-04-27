<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UnlockConditionData extends Data
{
    public function __construct(
        public string|int $phase,
        public int $level
    ) {
    }
}
