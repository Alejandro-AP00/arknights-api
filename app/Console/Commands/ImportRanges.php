<?php

namespace App\Console\Commands;

use App\Enums\Locales;
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
    protected $signature = 'import:ranges';

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
        $ranges = collect(File::gameData(Locales::Chinese, 'range_table.json'));
        Range::truncate();

        $this->withProgressBar($ranges, function ($range) {
            Range::updateOrCreate([
                'id' => $range['id'],
                'direction' => $range['direction'],
                'grids' => $range['grids'],
            ]);
        });

        return Command::SUCCESS;
    }
}
