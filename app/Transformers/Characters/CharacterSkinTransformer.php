<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use Illuminate\Support\Facades\File;
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

            if (is_null($this->subject['display_skin']['skinName'])
                && Str::endsWith($this->subject['avatar_id'], ['_1+', '_2'])) {
                $elite = Str::endsWith($this->subject['avatar_id'], '_1+') ? 1 : 2;
                $name = vsprintf('Elite %s', [$elite]);
            } elseif (! is_null($this->subject['display_skin']['skinName'])) {
                $skin = File::gameData($locale, 'skin_table.json')['charSkins'][$this->subject['skin_id']] ?? File::gameData(Locales::Chinese, 'skin_table.json')['charSkins'][$this->subject['skin_id']];
                $name = $skin['displaySkin']['skinName'];
            }

            return [$locale->value => $name];
        })->toArray();
    }
}
