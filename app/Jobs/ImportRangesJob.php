<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Models\Range;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportRangesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        $ranges = \Cache::get('ranges_'.Locales::Chinese->value);

        foreach ($ranges as $range) {
            Range::updateOrCreate([
                'range_id' => $range['id'],
            ], [
                'direction' => $range['direction'],
                'grids' => $range['grids'],
            ]);
        }
    }

    public function handle(): void {}
}
