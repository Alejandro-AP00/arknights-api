<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class UnlockMissionData extends Data
{
    public function __construct(
        public LocalizedFieldData $description,
        public string $missionId,
        public ?string $jumpStageId,
    ) {}
}
