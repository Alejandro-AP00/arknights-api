<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use App\Enums\Locales;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class RangeTransformer implements Transformer
{
    public function __construct(private $rangeId)
    {
    }

    public function transform(): array
    {
        $ranges = File::gameData(Locales::Chinese, 'range_table.json');

        return Arr::add($ranges[$this->rangeId], 'range_id', $this->rangeId);
    }
}
