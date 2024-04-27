<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class RangeGridData extends Data
{
    public function __construct(
        public int $row,
        public int $col,
    ) {
    }
}
