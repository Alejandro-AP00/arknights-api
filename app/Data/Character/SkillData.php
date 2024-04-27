<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SkillData extends Data
{
    /**
     * @param  Collection<SkillLevelData>  $levels
     **/
    public function __construct(
        public ?string $skillId,
        public ?string $iconId,
        public UnlockConditionData $unlockCondition,
        public Collection $levels,
    ) {
    }
}
