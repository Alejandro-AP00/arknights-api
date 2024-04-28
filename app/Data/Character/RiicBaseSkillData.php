<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Data;

class RiicBaseSkillData extends Data
{
    public function __construct(
        public string $buffId,
        public LocalizedFieldData $name,
        public LocalizedFieldData $description,
        public string $skillIcon,
        public UnlockConditionData $unlockCondition
    ) {
    }
}
