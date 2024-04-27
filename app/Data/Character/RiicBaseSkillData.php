<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class RiicBaseSkillData extends Data
{
    public function __construct(
        public string $buffId,
        public string|array $name,
        public string|array $description,
        public string $skillIcon,
        public UnlockConditionData $unlockCondition
    ) {
    }
}
