<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class TalentCandidateData extends Data
{
    /**
     * @param  Collection<InterpolatedValueData>  $blackboard
     */
    public function __construct(
        public int $requiredPotentialRank,
        public UnlockConditionData $unlockCondition,
        public string|array $name,
        public string|array $description,
        public RangeData $range,
        public Collection $blackboard,
    ) {
    }
}
