<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Models\Character;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ImportSummonInformationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle(): void
    {
        $characters = Cache::get('characters_'.Locales::Chinese->value);

        $characters->each(function ($character) {
            $character_model = Character::firstWhere('char_id', $character['char_id']);

            // Attach summons that are specific to skills (Ling)
            foreach ($character['skills'] ?? [] as $skill) {
                if ($skill['overrideTokenKey'] ?? null) {
                    Character::firstWhere('char_id', $skill['overrideTokenKey'])->update(['owner_id' => $character_model->id, 'is_summon' => 1]);
                }
            }

            // Attach summons that are tied to the character directly (Kalt'sit, Beanstalk)
            if (! empty($character['displayTokenDict'] ?? [])) {
                foreach ($character['displayTokenDict'] as $token => $dict) {
                    Character::firstWhere('char_id', $token)->update(['owner_id' => $character_model->id, 'is_summon' => 1]);
                }
            }
        });
    }
}
