<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ModuleStageData extends Data
{
    /**
     * @param  Collection<ItemCostData>  $itemCost
     * @param  Collection<ModuleStageUpgradeData>  $moduleUpgrades
     * @param  Collection<InterpolatedValueData>  $attributesBlackboard
     */
    public function __construct(
        public Collection $itemCost, // Lives in Uniequip but relates to equipLevel {1: [...itemCosts]}
        public UnlockConditionData $unlockCondition,
        public ?Collection $moduleUpgrades,
        public ?Collection $attributesBlackboard,
        /** @var InterpolatedValueData[][] */
        public array $tokenAttributesBlackboard,
    ) {}
}
