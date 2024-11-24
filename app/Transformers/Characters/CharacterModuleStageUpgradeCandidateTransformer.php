<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use App\Transformers\BaseTransformer;
use App\Transformers\RangeTransformer;
use Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CharacterModuleStageUpgradeCandidateTransformer extends BaseTransformer
{
    protected array $fields = [
        'description',
        'blackboard',
        'unlock_condition',
        'required_potential_rank',
        'range_id',
    ];

    protected array $localize = [
        'description'
    ];

    public function transformRangeId()
    {
        $range_id = $this->sourceReference->get('range_id');
        $this->output['range'] = ! empty($range_id) ? (new RangeTransformer($range_id))->transform() : null;

        return $range_id;
    }

    public function localizeDescription(): ?array {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $data = collect(data_get(Cache::get($this->sourceTable.'_'.$locale->value), $this->tableItem))->get($this->subjectKey) ?? collect(data_get(Cache::get($this->sourceTable.'_'.Locales::Chinese->value), $this->tableItem))->get($this->subjectKey);
            $data = collect($data)->keyBy(fn ($item, $key) => Str::snake($key));
            $data = collect(data_get($data, $this->sourceReferenceKey))->keyBy(fn ($item, $key) => Str::snake($key));
            $output[$locale->value] = data_get($data, 'additional_description') ?? data_get($data, 'override_descripton') ?? data_get($data, 'upgrade_description');
        }

        return empty(array_filter($output)) ? null : $output;
    }
}
