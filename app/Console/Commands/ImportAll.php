<?php

namespace App\Console\Commands;

use App\Enums\Locales;
use App\Jobs\ImportAlterInformationJob;
use App\Jobs\ImportBaseSkillsJob;
use App\Jobs\ImportCharacterJob;
use App\Jobs\ImportItemsDataJob;
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
use Process;
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
        Process::run('git submodule update --remote --recursive');
        Process::run('git add .');
        Process::run('git commit -m "Updated Game Data"');


        $characters = $this->getCharacterTable();
        $this->getReleaseDateAndLimitedInformation();
        $this->getRangeTable();
        $this->getSkinTable();
        $this->getVoiceTable();
        $this->getHandbookTable();
        $this->getBaseDataTable();
        $this->getSkillTable();
        $this->getUniequipTable();
        $this->getBattleEquippTable();
        $this->getItemTable();
        //                ImportRangesJob::dispatchSync();
        // $characters = $characters->whereIn('char_id', ['char_4141_marcil', 'char_1038_whitw2']);
        //                $characters = $characters->whereIn('char_id', ['char_003_kalts']);
        //                $characters->each(fn ($character) => ImportCharacterJob::dispatchSync($character));

        Bus::chain([
            new ImportRangesJob,
            new ImportBaseSkillsJob,
            new ScrapeSkinsDataJob,
            ...$characters->chunk(30)->map(function (Collection $characters) {
                return Bus::batch($characters->map(fn ($character) => new ImportCharacterJob($character)));
            })->toArray(),
            new ImportAlterInformationJob,
            new ImportSummonInformationJob,
            new ImportItemsDataJob,
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

    private function getUniequipTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('uniequip_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'uniequip_table.json'));
            });
        }
    }

    private function getBattleEquippTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('battle_equip_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'battle_equip_table.json'));
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

            $override_keys = [
                '阿米娅' => 'char_002_amiya',
                '阿米娅(近卫)' => 'char_1001_amiya2',
                '阿米娅(医疗)' => 'char_1037_amiya3',

                'Stormeye(卫戍协议)' => 'char_611_acnipe',
                'Misery(卫戍协议)' => 'char_615_acspec',
                'Pith(卫戍协议)' => 'char_612_accast',
                'Touch(卫戍协议)' => 'char_613_acmedc',
                'Sharp(卫戍协议)' => 'char_609_acguad',
                'Raidian(卫戍协议)' => 'char_614_acsupo',
                '郁金香(卫戍协议)' => 'char_608_acpion',
                'Mechanist(卫戍协议)' => 'char_610_acfend',

                '预备干员-近卫(卫戍协议)' => 'char_601_cguard',
                '预备干员-重装(卫戍协议)' => 'char_602_cdfend',
                '预备干员-先锋(卫戍协议)' => 'char_600_cpione',
                '预备干员-术师(卫戍协议)' => 'char_604_ccast',
                '预备干员-医疗(卫戍协议)' => 'char_605_cmedic',
                '预备干员-辅助(卫戍协议)' => 'char_606_csuppo',
                '预备干员-特种(卫戍协议)' => 'char_607_cspec',
                '预备干员-狙击(卫戍协议)' => 'char_603_csnipe',
            ];

            $table->filter('tr')->each(function (Crawler $row) use (&$data, $characters, $override_keys) {
                $columns = $row->filter('td');

                if ($columns->count() >= 2) {
                    // Get operator name and release date
                    $name = trim($columns->eq(0)->text());
                    $character = $characters->firstWhere('name', $name);
                    $char_id = data_get($character, 'char_id') ?? $override_keys[$name] ?? null;

                    $release_date = trim($columns->eq(2)->text());
                    $release_date = Date::createFromFormat('Y年m月d日 H:i', $release_date)->toDateTimeString();

                    $data->put($char_id, [
                        'release_date' => $release_date,
                        'is_limited' => Str::of($columns->eq(4)->text())->startsWith('限定'),
                    ]);
                }
            });

            return $data;
        });
    }

    private function getSkillTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('skills_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'skill_table.json'));
            });
        }
    }

    private function getItemTable(): void
    {
        foreach (Locales::cases() as $locale) {
            Cache::remember('items_'.$locale->value, 3600, function () use ($locale) {
                return collect(File::gameData($locale, 'item_table.json'));
            });
        }
    }
}
