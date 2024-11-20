<?php

namespace App\Data\Character;

use App\Enums\ModuleStageUpgradeType;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ModuleStageUpgradeData extends Data
{
    /**
     * @param  Collection<ModuleStageUpgradeCandidateData>  $candidates
     */
    public function __construct(
        public ?bool $isToken,
        public ?bool $isHidden,
        public ModuleStageUpgradeType $upgradeType,
        public ?Collection $candidates
    ){}
}
