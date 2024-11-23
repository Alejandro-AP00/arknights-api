<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class DisplaySkinData extends Data
{
    public function __construct(
        public ?string $modelName,
        /** @var string[] */
        public ?array $drawerList,
    ) {}
}
