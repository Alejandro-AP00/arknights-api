<?php

namespace App\Data\Character;

use App\Data\RangeData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class TraitCandidateData extends Data
{
    /**
     * @param  Collection<InterpolatedValueData>  $blackboard
     */
    public function __construct(
        public string|array $overrideDescription,
        public RangeData $range,
        public int $requiredPotentialRank,
        public UnlockConditionData $unlockCondition,
        public Collection $blackboard,
    ) {
    }
}
