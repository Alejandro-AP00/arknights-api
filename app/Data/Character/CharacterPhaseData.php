<?php

namespace App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character;

use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\RangeData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class CharacterPhaseData extends Data
{
    /**
     * @param  Collection<ItemCostData>  $evolveCost
     * @param  Collection<KeyFrameData>  $attributesKeyFrames
     */
    public function __construct(
        public string $characterPrefabKey,
        public int $maxLevel,
        public RangeData $range,
        public ?Collection $evolveCost,
        public Collection $attributesKeyFrames,
    ) {
    }
}
