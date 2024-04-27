<?php

namespace App\Data\Character\Character\Character\Character\Character\Character\Character\Character;

use App\Data\Character\Character\Character\Character\Character\Character\Character\RangeData;
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
        public Collection $itemCost,
        public UnlockConditionData $unlockCondition,
        public string $traitEffectType,
        public string $talentEffect,
        public ?string $talentIndex,
        public bool $displayRange,
        public ?RangeData $range,
        public Collection $attributesBlackboard,
        public int $requiredPotentialRank,
        /** @var InterpolatedValueData[][] */
        public array $tokenAttributesBlackboard,
    ) {
    }
}
