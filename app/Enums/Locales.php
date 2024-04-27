<?php

namespace App\Enums;

use Illuminate\Support\Facades\File;

enum Locales: string
{
    case English = 'en_US';
    case Korean = 'ko_KR';
    case Chinese = 'zh_CN';
    case Japanese = 'ja_JP';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    // TODO: Surely there's a better way
    public function characterData()
    {
        return match ($this) {
            Locales::English => (array_merge(
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::English->value.'/gamedata/excel/character_table.json')), true),
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::English->value.'/gamedata/excel/char_patch_table.json')), true)['patchChars']
            )),
            Locales::Korean => (array_merge(
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::Korean->value.'/gamedata/excel/character_table.json')), true),
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::Korean->value.'/gamedata/excel/char_patch_table.json')), true)['patchChars']
            )),
            Locales::Chinese => (array_merge(
                json_decode(File::get(public_path('ArknightsGameData/'.Locales::Chinese->value.'/gamedata/excel/character_table.json')), true),
                json_decode(File::get(public_path('ArknightsGameData/'.Locales::Chinese->value.'/gamedata/excel/char_patch_table.json')), true)['patchChars']
            )),
            Locales::Japanese => (array_merge(
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::Japanese->value.'/gamedata/excel/character_table.json')), true),
                json_decode(File::get(public_path('ArknightsGameData_Yostar/'.Locales::Japanese->value.'/gamedata/excel/char_patch_table.json')), true)['patchChars']
            )),
        };
    }
}
