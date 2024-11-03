<?php

namespace App\Jobs;

use App\Enums\Profession;
use App\Models\Character;
use App\Transformers\CharacterTransformer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ImportCharacterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private $character) {}

    public function handle(): void
    {
        $character = collect($this->character);
        if (in_array(Profession::tryFrom($character->get('profession')), [Profession::TOKEN, Profession::TRAP])) {
            return;
        }

        $character = (new CharacterTransformer($character['char_id']))->transform();
        $operator = new Character;
        $character = collect($character->all())->keyBy(fn ($item, $key) => Str::snake($key));
        $operator->fill($character->toArray());
        $operator->save();
    }
}
