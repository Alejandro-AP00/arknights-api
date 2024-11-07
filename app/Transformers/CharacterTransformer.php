<?php

namespace App\Transformers;

use App\Data\Character\CharacterData;
use App\Transformers\Characters\CharacterBasicTransformer;
use Illuminate\Support\Collection;

class CharacterTransformer
{
    private array $transformers = [
        CharacterBasicTransformer::class,
    ];

    public function __construct(private $character) {}

    public function transform(): CharacterData
    {
        $data = collect([]);

        $this->initializeTransformers()->each(function ($transformer) use (&$data) {
            $data = $data->merge($transformer->transform());
        });
        //        dd($data);

        return CharacterData::from($data);
    }

    public function initializeTransformers(): Collection
    {
        return collect($this->transformers)->map(function ($transformer) {
            return new $transformer($this->character);
        });
    }
}
