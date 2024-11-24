<?php

namespace App\Data\Character;

use App\Enums\ModuleStageUpgradeType;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ModuleStageUpgradeData extends Data
{
    /**
     * @param  Collection<ModuleStageUpgradeCandidateData>  $candidates
     */
    public function __construct(
        public ?bool $isToken,
        public ModuleStageUpgradeType $upgradeType,
        public ?Collection $candidates
    ) {}
}
