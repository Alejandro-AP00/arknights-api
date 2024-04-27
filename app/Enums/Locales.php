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

    public function characterData(): array
    {
        return array_merge(
            File::gameData($this, 'character_table.json'),
            File::gameData($this, 'char_patch_table.json')['patchChars'],
        );
    }
}
