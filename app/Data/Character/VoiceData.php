<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class VoiceData extends Data
{
    public function __construct(
        public string $wordkey,
        public string $voiceLangType,
        /** @var string[] */
        public array $cvName,
    ) {}
}
