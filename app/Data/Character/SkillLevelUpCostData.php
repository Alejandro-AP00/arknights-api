<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SkillLevelUpCostData extends Data
{
    /**
     * @param  Collection<ItemCostData>  $itemCost
     */
    public function __construct(
        public ?Collection $itemCost,
        public UnlockConditionData $unlockCond
    ) {}
}
