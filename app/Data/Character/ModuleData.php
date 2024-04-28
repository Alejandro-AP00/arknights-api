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
     * @param  Collection<ModuleStageData>  $moduleStage
     */
    public function __construct(
        public string $moduleId,
        public LocalizedFieldData $name,
        public LocalizedFieldData $description,
        public string $iconId,
        public Collection $moduleStage,
    ) {
    }
}
