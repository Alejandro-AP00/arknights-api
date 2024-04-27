<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use Illuminate\Support\Facades\File;

class RangeTransformer implements Transformer
{
    public function __construct(private $rangeId)
    {
    }

    public function transform(): mixed
    {
        $ranges = json_decode(File::get(public_path('ArknightsGameData/zh_CN/gamedata/excel/range_table.json')), true);

        return array_merge($ranges[$this->rangeId], ['range_id' => $this->rangeId]);
    }
}
