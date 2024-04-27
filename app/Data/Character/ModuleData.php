<?php

namespace App\Data;

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
        public string|array $name,
        public string|array $description,
        public string $iconId,
        public Collection $moduleStage,
    ) {
    }
}
