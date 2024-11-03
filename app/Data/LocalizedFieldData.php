<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class LocalizedFieldData extends Data
{
    public function __construct(
        public string|array $en_US,
        public string|array $ko_KR,
        public string|array $zh_CN,
        public string|array $ja_JP,
    ) {}
}
