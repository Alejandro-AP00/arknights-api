<?php

namespace App\Transformers;

use App\Enums\Locales;
use Illuminate\Support\Arr;

class RangeTransformer
{
    public function __construct(private $rangeId) {}

    public function transform(): array
    {
        $ranges = \Cache::get('ranges_'.Locales::Chinese->value);

        return Arr::add($ranges->get($this->rangeId), 'range_id', $this->rangeId);
    }
}
