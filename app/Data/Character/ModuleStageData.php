<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use App\Data\RangeData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ModuleStageData extends Data
{
    /**
     * @param  Collection<ItemCostData>  $itemCost
     * @param  Collection<InterpolatedValueData>  $attributesBlackboard
     */
    public function __construct(
        public Collection $itemCost, // Lives in Uniequip but relates to equipLevel {1: [...itemCosts]}
        public UnlockConditionData $unlockCondition,

        //        public LocalizedFieldData $traitEffectType,
        //        public LocalizedFieldData $talentEffect,
        //        public ?string $talentIndex,
        //        public bool $displayRange,
        //        public ?RangeData $range,
        //        public Collection $attributesBlackboard,
        //        public int $requiredPotentialRank,
        //        /** @var InterpolatedValueData[][] */
        //        public array $tokenAttributesBlackboard,
    ) {}
}
