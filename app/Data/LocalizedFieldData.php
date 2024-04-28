<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class LocalizedFieldData extends Data
{
    public function __construct(
        public mixed $en_US,
        public mixed $ko_KR,
        public mixed $zh_CN,
        public mixed $ja_JP,
    ) {
    }
}
