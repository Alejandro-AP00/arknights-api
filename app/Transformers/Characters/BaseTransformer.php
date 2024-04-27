<?php

namespace App\Transformers\Characters;

use App\Contracts\Transformer as TransformerInterface;
use App\Enums\Locales;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BaseTransformer implements TransformerInterface
{
    protected $fields = [];

    protected $localize = [];

    protected $rekeys = [];

    protected Collection $character;

    protected $sourceReference;

    protected $output = [];

    public function __construct($character, protected $sourceReferenceKey = null)
    {
        $this->character = collect($character)->keyBy(fn ($item, $key) => Str::snake($key));
        $this->sourceReference = $this->character;

        if ($this->sourceReferenceKey !== null) {
            $this->sourceReference = collect(data_get($this->character, $sourceReferenceKey))->keyBy(fn ($item, $key) => Str::snake($key));
        }
    }

    public function transform(): mixed
    {
        foreach ($this->fields as $field) {
            $method_name = Str::camel('transform'.$field);
            $key = $this->rekeys[$field] ?? $field;

            if (method_exists($this, $method_name)) {
                $this->output[$key] = $this->$method_name();

                continue;
            }

            $this->output[$key] = data_get($this->sourceReference, $field);
        }

        foreach ($this->localize as $field) {
            $method_name = Str::camel('localize'.$field);
            $key = $this->rekeys[$field] ?? $field;

            if (method_exists($this, $method_name)) {
                $this->output[$key] = $this->$method_name();

                continue;
            }

            try {
                $this->output[$key] = $this->toLocales($field);

                continue;
            } catch (\Throwable $e) {
                throw new \Exception('Tried to localize field:'.$field.' but no method exists to localize it');
            }
        }

        return $this->output;
    }

    public function toLocales($field): array
    {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $char_id = $this->character->get('char_id');
            $char_data = $locale->characterData()[$char_id] ?? Locales::Chinese->characterData()[$char_id];
            $output[$locale->value] = $this->sourceReferenceKey === null ? data_get($char_data, $field) : data_get($char_data, $this->sourceReferenceKey.'.'.$field);
        }

        return $output;
    }
}
