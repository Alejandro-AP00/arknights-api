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
     * @param  Collection<ModuleStageUpgradeData>  $upgrades
     * @param  Collection<InterpolatedValueData>  $attributeBlackboard
     */
    public function __construct(
        public int $stage,
        public Collection $itemCost, // Lives in Uniequip but relates to equipLevel {1: [...itemCosts]}
        public ?Collection $upgrades,
        public ?Collection $attributeBlackboard,
        /** @var array<string, InterpolatedValueData[]> */
        public array $tokenAttributeBlackboard,
    ) {}
}
