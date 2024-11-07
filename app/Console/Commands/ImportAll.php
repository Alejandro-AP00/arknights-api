<?php

namespace App\Console\Commands;

use App\Enums\Locales;
use App\Jobs\ImportAlterInformationJob;
use App\Jobs\ImportBaseSkillsJob;
use App\Jobs\ImportCharacterJob;
use App\Jobs\ImportRangesJob;
use App\Jobs\ImportSummonInformationJob;
use App\Jobs\ScrapeSkinsDataJob;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

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
        $characters = $this->getCharacterTable();
        $this->getReleaseDateAndLimitedInformation();
        $this->getRangeTable();
        $this->getSkinTable();
        $this->getVoiceTable();
        $this->getHandbookTable();
        $this->getBaseDataTable();

        //        ImportRangesJob::dispatchSync();
        //        $characters = $characters->whereIn('char_id', ['char_003_kalts', 'char_193_frostl']);
        //        $characters->each(fn ($character) => ImportCharacterJob::dispatchSync($character));

        Bus::chain([
            new ImportRangesJob,
            new ImportBaseSkillsJob,
            new ScrapeSkinsDataJob,
            Bus::batch(
                $characters->map(fn ($character) => new ImportCharacterJob($character)),
            ),
            new ImportAlterInformationJob,
            new ImportSummonInformationJob,
        ])->dispatch();

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

        Cache::remember('patch_characters', 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'char_patch_table.json'));
        });

        return Cache::get('characters_'.Locales::Chinese->value);
    }

    private function getRangeTable(): void
    {
        Cache::remember('ranges_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'range_table.json'));
        });
    }

    private function getSkinTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('skins_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'skin_table.json')['charSkins']);
            });
        }
    }

    private function getVoiceTable(): void
    {
        Cache::remember('voices_'.Locales::Chinese->value, 3600, function () {
            return collect(File::gameData(Locales::Chinese, 'charword_table.json')['voiceLangDict']);
        });
    }

    private function getHandbookTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('handbook_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'handbook_info_table.json')['handbookDict']);
            });
        }
    }

    private function getBaseDataTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('building_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'building_data.json'));
            });
        }
    }

    private function getReleaseDateAndLimitedInformation(): void
    {
        Cache::remember('release_date', 3600, function () {
            $url = 'https://prts.wiki/w/%E5%B9%B2%E5%91%98%E4%B8%8A%E7%BA%BF%E6%97%B6%E9%97%B4%E4%B8%80%E8%A7%88';

            $client = new Client;
            $response = $client->get($url);
            $htmlContent = $response->getBody()->getContents();

            $crawler = new Crawler($htmlContent);

            $table = $crawler->filter('table.wikitable')->first();

            $data = collect([]);
            $characters = Cache::get('characters_'.Locales::Chinese->value);
            $table->filter('tr')->each(function (Crawler $row) use (&$data, $characters) {
                $columns = $row->filter('td');

                if ($columns->count() >= 2) {
                    // Get operator name and release date
                    $name = trim($columns->eq(0)->text());
                    $character = $characters->firstWhere('name', $name);
                    $char_id = data_get($character, 'char_id');

                    $releaseDate = trim($columns->eq(2)->text());
                    $releaseDate = Date::createFromFormat('Y年m月d日 H:i', $releaseDate)->toDateTimeString();

                    $data->put($char_id, [
                        'release_date' => $releaseDate,
                        'is_limited' => Str::of($columns->eq(4)->text())->startsWith('限定'),
                    ]);
                }
            });

            return $data;
        });
    }
}
