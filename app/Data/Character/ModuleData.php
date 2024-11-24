<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class ModuleData extends Data
{
    /**
     * @param  Collection<ModuleStageData>  $stages
     * @param  Collection<UnlockMissionData>  $unlockMissions
     */
    public function __construct(
        public string $moduleId,
        public string|LocalizedFieldData $name,
        public string|LocalizedFieldData $description,
        public string $iconId,
        public string $typeIcon,
        public string $typeName1,
        public ?string $typeName2,
        public string $shiningColor,
        public string $type,
        public int $order_by, // Sort Order
        public UnlockConditionData $unlockCondition,
        public ?Collection $unlockMissions,
        public ?Collection $stages,
    ) {}
}
