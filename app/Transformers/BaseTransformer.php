<?php

namespace App\Transformers;

use App\Enums\Locales;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

abstract class BaseTransformer
{
    protected array $fields = [];

    protected array $localize = [];

    protected array $rename_keys = [];

    protected Collection $subject;

    protected Collection $sourceReference;

    protected array $output = [];

    protected Collection $table;

    public function __construct(protected $subjectKey, protected $sourceTable = 'characters', protected $sourceReferenceKey = null, protected $tableItem = null)
    {
        $this->table = collect(data_get(Cache::get($this->sourceTable.'_'.Locales::Chinese->value), $this->tableItem));

        $this->subject = collect($this->table->get($this->subjectKey))->keyBy(fn ($item, $key) => Str::snake($key));
        $this->sourceReference = $this->subject;

        if ($this->sourceReferenceKey !== null) {
            $this->sourceReference = collect(data_get($this->subject, $sourceReferenceKey))->keyBy(fn ($item, $key) => Str::snake($key));
        }
    }

    public function transform(): array
    {
        foreach ($this->fields as $field) {
            $method_name = Str::camel('transform'.$field);
            $key = $this->rename_keys[$field] ?? $field;

            if (method_exists($this, $method_name)) {
                $this->output[$key] = $this->$method_name();

                continue;
            }

            $this->output[$key] = data_get($this->sourceReference, $field);
        }

        foreach ($this->localize as $field) {
            $method_name = Str::camel('localize'.$field);
            $key = $this->rename_keys[$field] ?? $field;

            if (method_exists($this, $method_name)) {
                $this->output[$key] = $this->$method_name();

                continue;
            }

            try {
                $this->output[$key] = $this->toLocales($field);

                continue;
            } catch (\Throwable $e) {
                throw new \RuntimeException('Tried to localize field:'.$field.' but no method exists to localize it');
            }
        }

        return $this->output;
    }

    public function toLocales($field): ?array
    {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $data = collect(data_get(Cache::get($this->sourceTable.'_'.$locale->value), $this->tableItem))->get($this->subjectKey) ?? collect(data_get(Cache::get($this->sourceTable.'_'.Locales::Chinese->value), $this->tableItem))->get($this->subjectKey);
            $data = collect($data)->keyBy(fn ($item, $key) => Str::snake($key));
            $output[$locale->value] = $this->sourceReferenceKey === null ? data_get($data, $field) : data_get($data, $this->sourceReferenceKey.'.'.$field);
        }

        return empty(array_filter($output)) ? null : $output;
    }
}
