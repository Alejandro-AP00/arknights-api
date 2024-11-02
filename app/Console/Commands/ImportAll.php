<?php

namespace App\Console\Commands;

use App\Enums\Locales;
use App\Models\Character;
use App\Transformers\CharacterTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ImportAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ranges = $this->getRangeTable();
        $this->getSkinTable();
        $this->getVoiceTable();
        $characters = $this->getCharacterTable();

        //        $characters = $characters->where('char_id', 'char_1028_texas2');

        $this->withProgressBar($characters, function ($character) {
            $character = collect($character);
            //            dump($character['char_id']);
            $character = (new CharacterTransformer($character['char_id']))->transform();
            //            dd($character);
            //            $operator = new Character();

            //            $character = collect($character->all())->keyBy(fn ($item, $key) => Str::snake($key));
            //            $operator->fill($character->toArray());
            //            $operator->save();
        });

        return Command::SUCCESS;
    }

    private function getCharacterTable(): Collection
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('characters_'.$locale->value, 3600, function () use ($locale) {
                return collect(array_merge(
                    File::gameData($locale, 'character_table.json'),
                    File::gameData($locale, 'char_patch_table.json')['patchChars'],
                ))->map(function ($operator, $charId) {
                    return [...$operator, 'char_id' => $charId];
                });
            });
        }

        return Cache::get('characters_'.Locales::Chinese->value);
    }

    private function getRangeTable(): Collection
    {
        return Cache::remember('ranges_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'range_table.json'));
        });
    }

    private function getSkinTable()
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('skins_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'skin_table.json')['charSkins']);
            });
        }
    }

    private function getVoiceTable()
    {
        return Cache::remember('voices_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'charword_table.json')['voiceLangDict']);
        });
    }
}
