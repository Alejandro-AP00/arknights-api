<?php

namespace App\Console\Commands;

use App\Enums\Locales;
use App\Models\Character;
use App\Transformers\CharacterTransformer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class ImportCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:import';

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

        $char_table = File::gameData(Locales::Chinese, 'character_table.json');
        $char_patch_table = File::gameData(Locales::Chinese, 'char_patch_table.json');

        Character::truncate();

        $characters = collect($char_table)
            ->merge($char_patch_table['patchChars'])
            ->map(function ($operator, $charId) {
                return [...$operator, 'char_id' => $charId];
            });

        $characters = $characters->where('char_id', 'char_1028_texas2');

        $this->withProgressBar($characters, function ($character) {
            $character = collect($character);
            dump($character['char_id']);
            $character = (new CharacterTransformer($character))->transform();
            dd($character);
            $operator = new Character();

            $character = collect($character->all())->keyBy(fn ($item, $key) => Str::snake($key));
            $operator->fill($character->toArray());
            $operator->save();
        });
    }
}
