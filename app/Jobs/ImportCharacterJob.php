<?php

namespace App\Jobs;

use App\Data\Character\CharacterData;
use App\Data\Character\ModuleData;
use App\Data\Character\ModuleStageData;
use App\Data\Character\ModuleStageUpgradeCandidateData;
use App\Data\Character\ModuleStageUpgradeData;
use App\Data\Character\RiicBaseSkillData;
use App\Data\Character\SkillData;
use App\Data\Character\SkillLevelData;
use App\Data\Character\SkinData;
use App\Data\Character\TalentCandidateData;
use App\Data\Character\UnlockMissionData;
use App\Data\Character\VoiceData;
use App\Enums\Profession;
use App\Models\BaseSkill;
use App\Models\Character;
use App\Models\Module;
use App\Models\ModuleStage;
use App\Models\ModuleStageUpgrade;
use App\Models\ModuleStageUpgradeCandidate;
use App\Models\ModuleUnlockMission;
use App\Models\Phase;
use App\Models\Range;
use App\Models\Skill;
use App\Models\SkillLevel;
use App\Models\Talent;
use App\Models\TalentCandidate;
use App\Models\TraitCandidate;
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
                $this->createHandbook(...),
                $this->createTraits(...),
                $this->createRiicSkill(...),
                $this->createSkills(...),
                $this->createModules(...),
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

        $operator = Character::updateOrCreate([
            'char_id' => $character_data->charId,
        ], $character->toArray());
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

    private function createTraits(CharacterData $character_data, Closure $next)
    {
        $trait_candidates = $character_data->traitCandidates;
        foreach ($trait_candidates as $trait_candidate_data) {
            $trait_candidate = collect($trait_candidate_data)->keyBy(fn ($item, $key) => Str::snake($key));
            $trait_candidate = new TraitCandidate($trait_candidate->toArray());
            $trait_candidate->character()->associate($this->characterModel);

            if ($trait_candidate_data->range) {
                $range = Range::firstWhere('range_id', $trait_candidate_data->range->rangeId);
                $trait_candidate->range_id = $range->id;
            }

            $trait_candidate->save();
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

    private function createHandbook(CharacterData $character_data, Closure $next)
    {
        if (! $this->isOperator()) {
            return $next($character_data);
        }

        if ($character_data->handbook) {
            $this->characterModel->handbook()->create(collect($character_data->handbook)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
        }

        return $next($character_data);
    }

    private function createRiicSkill(CharacterData $character_data, Closure $next)
    {
        if (! $this->isOperator()) {
            return $next($character_data);
        }

        $character_data->riccSkills->each(function (RiicBaseSkillData $skill_data) {
            $base_skill = BaseSkill::firstWhere('buff_id', $skill_data->buffId);
            $this->characterModel->riccSkills()->attach($base_skill, ['unlock_condition' => $skill_data->unlockCondition]);
        });

        return $next($character_data);
    }

    private function createSkills(CharacterData $character_data, Closure $next)
    {
        $character_data->skills?->each(function (SkillData $skill_data) {
            $skill = new Skill(collect($skill_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
            $skill->character()->associate($this->characterModel);
            $skill->save();

            $skill_data->levels?->each(function (SkillLevelData $level_data) use ($skill) {
                $level = new SkillLevel(collect($level_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());

                if ($level_data->range) {
                    $range = Range::firstWhere('range_id', $level_data->range->rangeId);
                    $level->range_id = $range->id;
                }

                $level->skill()->associate($skill);
                $level->save();
            });
        });

        return $next($character_data);
    }

    private function createModules(CharacterData $character_data, Closure $next)
    {
        // TODO: Refactor this
        $character_data->modules?->each(function (ModuleData $module_data) {
            $module = new Module(collect($module_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
            $module->character()->associate($this->characterModel);
            $module->save();

            $module_data->unlockMissions->each(function(UnlockMissionData $unlock_mission_data) use ($module) {
                $unlock_mission = new ModuleUnlockMission(collect($unlock_mission_data)->keyBy(fn ($item, $key) => Str::snake($key))->toArray());
                $unlock_mission->module()->associate($module);
                $unlock_mission->save();
            });

            $module_data->stages?->each(function (ModuleStageData $stage_data) use ($module) {
                $stage = collect($stage_data)->keyBy(fn ($item, $key) => Str::snake($key));
                $stage = new ModuleStage($stage->toArray());
                $stage->module()->associate($module);
                $stage->save();

                $stage_data->upgrades?->each(function (ModuleStageUpgradeData $upgrade_data) use ($stage) {
                    $upgrade = collect($upgrade_data)->keyBy(fn ($item, $key) => Str::snake($key));
                    $upgrade = new ModuleStageUpgrade($upgrade->toArray());
                    $upgrade->stage()->associate($stage);
                    $upgrade->save();

                    $upgrade_data->candidates?->each(function (ModuleStageUpgradeCandidateData $candidate_data) use ($upgrade) {
                        $candidate = collect($candidate_data)->keyBy(fn ($item, $key) => Str::snake($key));
                        $candidate = new ModuleStageUpgradeCandidate($candidate->toArray());
                        $candidate->upgrade()->associate($upgrade);

                        if ($candidate_data->range) {
                            $range = Range::firstWhere('range_id', $candidate_data->range->rangeId);
                            $candidate->range_id = $range->id;
                        }

                        $candidate->save();
                    });
                });
            });
        });

        return $next($character_data);
    }
}
