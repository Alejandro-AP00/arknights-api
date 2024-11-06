<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Enums\SkinSource;
use App\Enums\TokenType;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeSkinsDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const BASE_URL = 'https://prts.wiki';

    public function handle()
    {
        Cache::remember('skin_cost_data', 3600, function () {
            $allSkinEntries = $this->scrapeSkinsData();

            return collect($this->correlateSkinNamesWithIds($allSkinEntries));
        });
    }

    private function scrapeSkinsData(): Collection
    {
        $main_url = self::BASE_URL.'/w/%E6%97%B6%E8%A3%85%E5%9B%9E%E5%BB%8A';
        $client = new Client;
        $response = $client->get($main_url);
        $crawler = new Crawler($response->getBody()->getContents());

        // Get all brand links
        $brand_links = $crawler->filter('.brandbtncontroler a')->each(function (Crawler $node) {
            return self::BASE_URL.$node->attr('href');
        });

        return collect($brand_links)->flatMap(function ($brand_link) use ($client) {
            $response = $client->get($brand_link);
            $crawler = new Crawler($response->getBody()->getContents());

            info('Brand link: '.$brand_link);

            return $crawler->filter('h2 + .wikitable')->each(function (Crawler $table) {
                // Extract and clean the Chinese skin name
                $skin_name_node = $table->filter('th')->first();
                $skin_name_node->filter('span')->each(function ($span) {
                    $span->getNode(0)->parentNode->removeChild($span->getNode(0));
                });
                $cn_skin_name = trim($skin_name_node->text());
                info('Skin Name: '.$cn_skin_name);

                // Extract obtain sources as Enums
                $obtain_sources = $this->parseObtainSources($table);

                // Determine cost and token type
                [$cost, $tokenType] = $this->getCostAndTokenType($table, $obtain_sources);

                return [
                    'cnSkinName' => $cn_skin_name,
                    'obtain_sources' => $obtain_sources->unique()->all(),
                    'cost' => $cost,
                    'token_type' => $tokenType,
                ];
            });
        });
    }

    private function parseObtainSources(Crawler $table): Collection
    {
        $obtain_sources = new Collection;
        $obtain_source_text = $table->filter('th:contains("获得途径") + td')->text('');

        foreach (explode('/', trim($obtain_source_text)) as $source) {
            $source = trim($source);
            $skin_source = match ($source) {
                '机密圣所', '危机合约' => SkinSource::ContingencyContractStore,
                '采购中心' => SkinSource::OutfitStore,
                '兑换码', '特典兑换' => SkinSource::RedemptionCode,
                '集成战略' => SkinSource::IntegratedStrategies,
                '活动获得' => SkinSource::Event,
                '线下礼包' => SkinSource::RealWorldPromotion,
                default => SkinSource::Unknown,
            };

            if ($skin_source === SkinSource::Unknown) {
                info('Skin source "'.$source.'" not found');
                info($obtain_source_text);
            }

            $obtain_sources->add($skin_source);
        }

        return $obtain_sources;
    }

    private function getCostAndTokenType(Crawler $table, Collection $obtain_sources): array
    {
        $cost = null;
        $token_type = TokenType::Unknown;

        $cost_node = $table->filter('th:contains("获取时限") img[alt^="图标 源石"], th:contains("复刻时限") img[alt^="图标 源石"]')->last();
        if ($obtain_sources->contains(SkinSource::OutfitStore) && $cost_node->count()) {
            $token_type = TokenType::OriginiumPrime;
            $cost_string = trim($cost_node->closest('th')?->filter('div')?->text(''));
            $cost = $this->parseCost($cost_string);
            info('Outfit Store: '.$cost);
        }

        $cc_cost_node = $table->filter('th:contains("获取时限") img[alt^="图标 合约赏金"], th:contains("复刻时限") img[alt^="图标 合约赏金"]')->last();
        if ($cc_cost_node->count()) {
            $obtain_sources->add(SkinSource::ContingencyContractStore);
            $token_type = TokenType::ContingencyContractToken;
            $cost = (int) trim($cc_cost_node->closest('th')->filter('div')->text(''));
            info('Contingency Contract: '.$cost);
        }

        return [$cost, $token_type];
    }

    private function parseCost(string $raw_cost_string): ?int
    {
        if (preg_match('/\d+\s*→\s*(\d+)/', $raw_cost_string, $matches)) {
            return (int) $matches[1];
        }

        return (int) $raw_cost_string ?: null;
    }

    private function correlateSkinNamesWithIds(Collection $all_skin_entries): array
    {
        // Fetch Chinese locale skins data from cache
        $skins = Cache::get('skins_'.Locales::Chinese->value);

        // Map skin names to skin IDs
        $skin_id_map = $skins->filter(function ($skin) {
            return ! empty(data_get($skin, 'displaySkin.skinName'));
        })->mapWithKeys(function ($skin, $skin_id) {
            return [trim(data_get($skin, 'displaySkin.skinName')) => $skin_id];
        });

        $result = [];
        foreach ($all_skin_entries as $entry) {
            $skin_id = $skin_id_map->get($entry['cnSkinName']);
            if (! $skin_id) {
                throw new \Exception("Couldn't find skin ID for: {$entry['cnSkinName']}");
            }
            $result[$skin_id] = $entry;
        }

        return $result;
    }
}
