<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use App\Data\RangeData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ModuleStageUpgradeCandidateData extends Data
{
    /**
     * @param  Collection<InterpolatedValueData>  $blackboard
     */
    public function __construct(
        public LocalizedFieldData $description,
        public ?RangeData $range,
        public Collection $blackboard,
        public int $requiredPotentialRank,
        public UnlockConditionData $unlockCondition,
    ) {}
}
