<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SkinData extends Data
{
    public function __construct(
        public LocalizedFieldData $name,
        public string $skinId,
        public ?string $illustId,
        public string $avatarId,
        public ?string $portraitId,
        public DisplaySkinData $displaySkin,
        public string $type,
        public ?array $obtainSources,
        public ?int $cost,
        public ?string $tokenType,
    ) {}
}
