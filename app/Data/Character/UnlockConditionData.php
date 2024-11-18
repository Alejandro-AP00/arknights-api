<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class UnlockConditionData extends Data
{
    public function __construct(
        public string|int $phase,
        public int $level,
        public int|array|null $trust
    ) {}
}
