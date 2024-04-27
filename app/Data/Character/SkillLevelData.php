<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class SkillLevelData extends Data
{
    /**
     * @param  Collection<InterpolatedValueData>  $blackboard
     */
    public function __construct(
        public string|array $name,
        public string|array $description,
        public RangeData $range,
        public string $skillType,
        public string $durationType,
        /** @var array{'spType': string, 'spCost': int, 'initSp': int, 'levelUpCost': mixed, 'maxChargeTime': mixed, 'increment': mixed} */
        public array $spData,
        public int $duration,
        public Collection $blackboard,
        public SkillLevelUpCostData $lvlUpCost,
    ) {
    }
}
