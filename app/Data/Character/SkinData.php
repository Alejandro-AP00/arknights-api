<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SkinData extends Data
{
    public function __construct(
        public string|array $name,
        public string $skinId,
        public string $illustId,
        public string $avatarId,
        public string $portraitId,
        public DisplaySkinData $displaySkin,
        public string $type,
        public ?array $obtainSources,
        public ?int $cost,
        public ?string $tokenType,
    ) {
    }
}
