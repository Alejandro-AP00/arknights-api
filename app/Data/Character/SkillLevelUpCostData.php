<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class SkillLevelUpCostData extends Data
{
    /**
     * @param  Collection<ItemCostData>  $itemCost
     */
    public function __construct(
        public ?Collection $itemCost,
        public UnlockConditionData $unlockCond
    ) {
    }
}
