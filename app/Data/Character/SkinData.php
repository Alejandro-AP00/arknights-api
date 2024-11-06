<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use App\Enums\SkinSource;
use App\Enums\TokenType;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SkinData extends Data
{
    /**
     * @param  \Illuminate\Support\Collection<SkinSource>  $obtainSources
     */
    public function __construct(
        public LocalizedFieldData $name,
        public string $skinId,
        public ?string $illustId,
        public string $avatarId,
        public ?string $portraitId,
        public DisplaySkinData $displaySkin,
        public string $type,
        public ?Collection $obtainSources,
        public ?int $cost,
        public ?TokenType $tokenType,
    ) {}
}
