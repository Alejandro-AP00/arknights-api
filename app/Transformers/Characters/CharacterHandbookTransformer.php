<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use App\Transformers\BaseTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CharacterHandbookTransformer extends BaseTransformer
{
    protected array $fields = [
        'profile',
        'basic_info',
        'physical_exam',
        'clinical_analysis',
        'promotion_record',
        'performance_review',
        'class_conversion_record',
        'archives',
    ];

    protected array $localize = [
        'profile',
        'basic_info',
        'physical_exam',
        'clinical_analysis',
        'promotion_record',
        'performance_review',
        'class_conversion_record',
        'archives',
    ];

    public function transform(): array
    {
        foreach ($this->fields as $field) {
            $method_name = Str::camel('transform'.$field);
            $key = $this->rename_keys[$field] ?? $field;

            if (method_exists($this, $method_name)) {
                $this->output[$key] = $this->$method_name();

                continue;
            }

            $this->output[$key] = collect($this->subject['story_text_audio'])->where('storyTitle', Locales::Chinese->handbookKeys()[$key])->get('stories');
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
                info($e);
                throw new \RuntimeException('Tried to localize field:'.$field.' but no method exists to localize it');
            }
        }

        return $this->output;
    }

    public function toLocales($field): ?array
    {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $is_fallback = false;
            if (empty(Cache::get($this->sourceTable.'_'.$locale->value)->get($this->subjectKey))) {
                $is_fallback = true;
            }
            $data = Cache::get($this->sourceTable.'_'.$locale->value)->get($this->subjectKey) ?? Cache::get($this->sourceTable.'_'.Locales::Chinese->value)->get($this->subjectKey);
            $data = data_get(collect($data['storyTextAudio'])->firstWhere('storyTitle', $is_fallback ? Locales::Chinese->handbookKeys()[$field] : $locale->handbookKeys()[$field]), 'stories.0.storyText');

            // When parsing basic info or the physical exam parse the text so each title is represented as a title and a value
            if (in_array($field, ['basic_info', 'physical_exam', 'performance_review'])) {
                $data = $this->parseStoryText($data, $is_fallback ? Locales::Chinese : $locale);
            }

            $output[$locale->value] = $data;
        }

        return empty(array_filter($output)) ? null : $output;
    }

    public function transformArchives(): \Illuminate\Support\Collection
    {
        return collect($this->subject['story_text_audio'])->whereIn('storyTitle', collect(Locales::Chinese->handbookKeys()['archives']))->pluck('stories');
    }

    public function localizeArchives(): ?array
    {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $data = Cache::get($this->sourceTable.'_'.$locale->value)->get($this->subjectKey) ?? Cache::get($this->sourceTable.'_'.Locales::Chinese->value)->get($this->subjectKey);
            $data = collect($data['storyTextAudio'])->whereIn('storyTitle', collect($locale->handbookKeys()['archives']))->map(fn ($item) => data_get($item, 'stories.0.storyText'));

            $output[$locale->value] = $data->values()->all();
        }

        return empty(array_filter($output)) ? null : $output;
    }

    public function transformClassConversionRecord(): \Illuminate\Support\Collection
    {
        return collect($this->subject['story_text_audio'])->whereIn('storyTitle', collect(Locales::Chinese->handbookKeys()['class_conversion_record']))->pluck('stories');
    }

    public function localizeClassConversionRecord(): ?array
    {
        $output = [];
        foreach (Locales::cases() as $locale) {
            $data = Cache::get($this->sourceTable.'_'.$locale->value)->get($this->subjectKey) ?? Cache::get($this->sourceTable.'_'.Locales::Chinese->value)->get($this->subjectKey);
            $data = collect($data['storyTextAudio'])->whereIn('storyTitle', collect($locale->handbookKeys()['class_conversion_record']))->map(fn ($item) => data_get($item, 'stories.0.storyText'));

            $output[$locale->value] = $data->values()->all();
        }

        return empty(array_filter($output)) ? null : $output;
    }

    protected function parseStoryText(?string $text, Locales $locale): array
    {
        if (! $text) {
            return [];
        }

        $lines = explode("\n", $text);
        $parsedData = [];
        $currentTitle = '';
        $currentValue = '';

        // Determine regex pattern based on Locales enum
        $pattern = match ($locale) {
            Locales::English, Locales::Korean => '/^\[([\w\s]+)\](.*)$/',
            Locales::Chinese, Locales::Japanese => '/^【([^【】]+)】(.*)$/',
        };

        foreach ($lines as $line) {
            if (preg_match($pattern, $line, $matches)) {
                // Store the previous title-value pair if it exists
                if ($currentTitle) {
                    $parsedData[] = [
                        'title' => trim($currentTitle),
                        'value' => trim($currentValue),
                    ];
                }

                // Set the new title and value
                $currentTitle = $matches[1];
                $currentValue = $matches[2];
            } else {
                // Append the line to the current value if it's part of the same section
                $currentValue .= "\n".$line;
            }
        }

        // Add the last parsed entry if any
        if ($currentTitle) {
            $parsedData[] = [
                'title' => trim($currentTitle),
                'value' => trim($currentValue),
            ];
        }

        return $parsedData;
    }
}
