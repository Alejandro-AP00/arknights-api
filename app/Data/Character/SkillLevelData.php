<?php

namespace App\Data\Character;

use App\Data\RangeData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SkillLevelData extends Data
{
    /**
     * @param  Collection<InterpolatedValueData>  $blackboard
     */
    public function __construct(
        public string|array $name,
        public string|array $description,
        public ?RangeData $range,
        public string $skillType,
        public string $durationType,
        /** @var array{'spType': string, 'spCost': int, 'initSp': int, 'levelUpCost': mixed, 'maxChargeTime': mixed, 'increment': mixed} */
        public array $spData,
        public int $duration,
        public Collection $blackboard,
        public ?SkillLevelUpCostData $lvlUpCost,
    ) {}
}
