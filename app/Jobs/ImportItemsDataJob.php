<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Models\Item;
use App\Transformers\ItemTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ImportItemsDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Cache::get('items_'.Locales::Chinese->value)
            ->filter(function($item){
                $item_id = $item['itemId'];
                return
                    ($item_id === '4001' ||
                        ($item['classifyType'] === 'MATERIAL'
                            && !Str::startsWith($item_id, 'tier')
                            && !Str::startsWith($item_id, 'voucher_full_')
                ));
            })
            ->map(function($item) {
                $item_data = (new ItemTransformer($item['itemId'], 'items', tableItem: 'items'))->transform();

                $item = new Item($item_data);
                $item->save();
            });
    }
}
