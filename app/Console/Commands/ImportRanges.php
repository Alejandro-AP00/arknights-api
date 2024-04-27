<?php

namespace App\Console\Commands;

use App\Models\Range;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportRanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-ranges';

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
        $range_table = json_decode(File::get(public_path('ArknightsGameData/zh_CN/gamedata/excel/range_table.json')), true);
        $ranges = collect($range_table);

        $this->withProgressBar($ranges, function ($range) {
            Range::updateOrCreate([
                'range_id' => $range['id'],
                'direction' => $range['direction'],
                'grids' => $range['grids'],
            ]);
        });

        return Command::SUCCESS;
    }
}
