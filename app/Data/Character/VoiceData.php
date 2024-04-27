<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class VoiceData extends Data
{
    public function __construct(
        public string $wordkey,
        public string $voiceLangType,
        /** @var string[] */
        public array $cvName,
    ) {
    }
}
