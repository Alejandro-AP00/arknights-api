<?php

namespace App\Console\Commands;

use App\Transformers\CharacterTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class ImportCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-characters';

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
        Process::run('git submodule update --init --recursive --remote');

        $char_table = json_decode(File::get(public_path('ArknightsGameData/zh_CN/gamedata/excel/character_table.json')), true);
        $char_patch_table = json_decode(File::get(public_path('ArknightsGameData/zh_CN/gamedata/excel/char_patch_table.json')), true);

        $characters = collect($char_table)
            ->merge($char_patch_table['patchChars'])
            ->map(function ($operator, $charId) {
                return [...$operator, 'char_id' => $charId];
            })
            ->each(function ($character) {
                $character = collect($character);
                $character = (new CharacterTransformer($character))->transform();
                dd($character);
                // $operator = new Character();
                // $operator->fill($character->toArray());
                // $operator->save();
            });
    }
}
