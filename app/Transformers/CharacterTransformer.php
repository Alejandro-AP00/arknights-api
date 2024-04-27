<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\CharacterData;
use App\Transformers\Characters\CharacterBasicTransformer;
use Illuminate\Support\Collection;

class CharacterTransformer implements Transformer
{
    private array $transformers = [
        CharacterBasicTransformer::class,
    ];

    public function __construct(private $character)
    {
    }

    public function transform(): CharacterData
    {
        $data = collect([]);

        $this->initializeTransformers()->each(function ($transformer) use (&$data) {
            $data = $data->merge($transformer->transform());
        });

        return CharacterData::from($data);
    }

    public function initializeTransformers(): Collection
    {
        return collect($this->transformers)->map(function ($transformer) {
            return new $transformer($this->character);
        });
    }
}
