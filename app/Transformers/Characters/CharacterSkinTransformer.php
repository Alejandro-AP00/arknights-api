<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use App\Transformers\BaseTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CharacterSkinTransformer extends BaseTransformer
{
    protected array $fields = [
        'name',
        'skin_id',
        'illust_id',
        'avatar_id',
        'portrait_id',
        'display_skin',
        'type',
        'obtain_source',
        'cost',
        'token_type',
    ];

    protected array $localize = [
        'name',
    ];

    public function transformType(): string
    {
        $type = 'elite-zero';

        if (is_null($this->subject['display_skin']['skinName'])
            && Str::endsWith($this->subject['avatar_id'], ['_1+', '_2'])) {
            $type = 'elite-one-or-two';
        } elseif (! is_null($this->subject['display_skin']['skinName'])) {
            $type = 'skin';
        }

        return $type;
    }

    public function localizeName(): array
    {
        return collect(Locales::cases())->mapWithKeys(function ($locale) {
            $name = 'Elite 0';
            $skinName = $this->subject['display_skin']['skinName'] ?? null;

            // Check for Elite level if `skinName` is null
            if (is_null($skinName) && Str::endsWith($this->subject['avatar_id'], ['_1+', '_2'])) {
                $elite = Str::endsWith($this->subject['avatar_id'], '_1+') ? 1 : 2;
                $name = "Elite $elite";
            } elseif ($skinName) {
                // Retrieve skin data from cache, with fallback to Chinese locale
                $skin = Cache::get('skins_'.$locale->value)->get($this->subject['skin_id']) ?? Cache::get('skins_'.Locales::Chinese->value)->get($this->subject['skin_id']);
                $name = $skin['displaySkin']['skinName'] ?? 'Elite 0';
            }

            return [$locale->value => $name];
        })->toArray();
    }

    public function transformCost(): ?int
    {
        $skin_cost_data = Cache::get('skin_cost_data', collect([]))->get($this->subject['skin_id']);
        if ($skin_cost_data) {
            $this->output['obtain_sources'] = collect($skin_cost_data['obtain_sources']) ?? null;
            $this->output['token_type'] = $skin_cost_data['token_type'] ?? null;

            return $skin_cost_data['cost'];
        }

        return null;
    }
}
