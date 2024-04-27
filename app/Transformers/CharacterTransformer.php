<?php

namespace App\Transformers;

use App\Contracts\Transformer;
use App\Data\CharacterData;
use App\Transformers\Operators\OperatorBasicTransformer;

class CharacterTransformer implements Transformer
{
    private $transformers = [
        OperatorBasicTransformer::class,
    ];

    public function __construct(private $character)
    {
        $this->$character = $character;
    }

    public function transform(): mixed
    {
        $data = collect([]);

        $this->initializeTransformers()->each(function ($transformer) use (&$data) {
            $data = $data->merge($transformer->transform());
        });

        return CharacterData::from($data);
    }

    public function initializeTransformers()
    {
        return collect($this->transformers)->map(function ($transformer) {
            return new $transformer($this->character);
        });
    }
}
