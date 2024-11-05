<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Models\Character;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportAlterInformationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle(): void
    {
        $operators = collect(\File::gameData(Locales::Chinese, 'char_meta_table.json')['spCharGroups']);
        $patch = collect(\File::gameData(Locales::Chinese, 'char_patch_table.json')['infos'])->mapWithKeys(fn ($alters, $patch_character) => [$patch_character => $alters['tmplIds']]);

        $characters = Character::whereIn('char_id', $operators->flatten()->merge($patch->flatten()))->get()->keyBy('char_id');
        $operators = $operators->merge($patch);
        $operators->each(function ($alters, $operator) use ($characters) {
            $base_operator = $characters->get($operator);

            if ($base_operator) {
                $alters = collect($alters)->reject(fn ($alter) => $base_operator->char_id === $alter);
                Character::whereIn('char_id', $alters)->update(['base_character_id' => $base_operator->id]);
            }
        });
    }
}
