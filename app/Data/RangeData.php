<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class RangeData extends Data
{
    /**
     * @param  Collection<RangeGridData>  $grids
     */
    public function __construct(
        #[MapInputName('id')]
        public string $rangeId,
        public int $direction,
        public Collection $grids,
    ) {}
}
