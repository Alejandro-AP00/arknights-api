<?php

namespace App\Jobs;

use App\Data\Character\CharacterData;
use App\Data\Character\SkinData;
use App\Data\Character\TalentCandidateData;
use App\Data\Character\VoiceData;
use App\Enums\Profession;
use App\Models\Character;
use App\Models\Phase;
use App\Models\Range;
use App\Models\Talent;
use App\Models\TalentCandidate;
use App\Transformers\CharacterTransformer;
use Closure;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Str;

class ImportCharacterJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Character $characterModel;

    public function __construct(private $character) {}

    public function handle(): void
    {
        if (Profession::tryFrom($this->character['profession']) == Profession::TRAP) {
            return;
        }

        $character = collect($this->character);
        $character = (new CharacterTransformer($character['char_id']))->transform();

        Pipeline::send($character)
            ->through([
                $this->createCharacter(...),
                $this->createPhases(...),
                $this->createPotentials(...),
                $this->createTalents(...),
                $this->createVoices(...),
                $this->createSkins(...),
            ])
            ->thenReturn();
    }

    private function isOperator(): bool
    {
        return ! in_array(Profession::tryFrom($this->character['profession']), [Profession::TRAP, Profession::TOKEN]);
    }

    private function createCharacter(CharacterData $character_data, Closure $next)
    {
        $character = collect($character_data->all())->keyBy(fn ($item, $key) => Str::snake($key));

        $operator = new Character;
        $operator->fill($character->toArray());
        $operator->save();

        $this->characterModel = $operator;

        return $next($character_data);
    }

    private function createPhases(CharacterData $character_data, Closure $next)
    {
        $phases = $character_data->phases;

        foreach ($phases as $phase) {
            $range = Range::firstWhere('range_id', $phase->range->rangeId);
            $phase = collect($phase->all())->keyBy(fn ($item, $key) => Str::snake($key));

            $phase = new Phase($phase->toArray());
            $phase->character()->associate($this->characterModel);
            $phase->range()->associate($range);
            $phase->save();
        }

        return $next($character_data);
    }

    private function createPotentials(CharacterData $character_data, Closure $next)
    {
        $potentials = $character_data->potentialRanks;

        $this->characterModel->potentialRanks()->createMany($potentials->toArray());

        return $next($character_data);
    }

    private function createTalents(CharacterData $character_data, Closure $next)
    {
        $talents = $character_data->talents;

        foreach ($talents as $talent) {
            $candidates = $talent->candidates;

            $talent = new Talent;
            $talent->character()->associate($this->characterModel);
            $talent->save();

            $candidates->each(function (TalentCandidateData $candidate_data) use ($talent) {
                $candidate = collect($candidate_data)->keyBy(fn ($item, $key) => Str::snake($key));
                $candidate = new TalentCandidate($candidate->toArray());
                $candidate->talent()->associate($talent);

                if ($candidate_data->range) {
                    $range = Range::firstWhere('range_id', $candidate_data->range->rangeId);
                    $candidate->range_id = $range->id;
                }

                $candidate->save();
            });
        }

        return $next($character_data);
    }

    private function createVoices(CharacterData $character_data, Closure $next)
    {
        if (! $this->isOperator()) {
            return $next($character_data);
        }

        $character_data->voices?->each(function (VoiceData $voice_data) {
            $this->characterModel->voices()->create(collect($voice_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
        });

        return $next($character_data);
    }

    private function createSkins(CharacterData $character_data, Closure $next)
    {
        if (! $this->isOperator()) {
            return $next($character_data);
        }

        $character_data->skins?->each(function (SkinData $skin_data) {
            $this->characterModel->skins()->create(collect($skin_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
        });

        return $next($character_data);
    }
}