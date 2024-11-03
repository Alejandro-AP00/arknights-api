<?php

namespace App\Console\Commands;

use App\Enums\Locales;
use App\Jobs\ImportCharacterJob;
use App\Jobs\ImportRangesJob;
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
    public function handle(): int
    {
        $this->info('Loading GameData Caches');
        $characters = $this->loadCharacterTable();
        $this->loadRangeTable();
        $this->loadSkinTable();
        $this->loadVoiceTable();

        $this->info('Dispatching Ranges importer');
        ImportRangesJob::dispatch();

        $this->info('Dispatching Character Importer');
        $this->withProgressBar($characters, function ($character) {
            ImportCharacterJob::dispatch($character['char_id'], $character);
        });

        return Command::SUCCESS;
    }

    private function loadCharacterTable(): Collection
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

    private function loadRangeTable(): void
    {
        Cache::remember('ranges_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'range_table.json'));
        });
    }

    private function loadSkinTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('skins_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'skin_table.json')['charSkins']);
            });
        }
    }

    private function loadVoiceTable(): void
    {
        Cache::remember('voices_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'charword_table.json')['voiceLangDict']);
        });
    }
}
