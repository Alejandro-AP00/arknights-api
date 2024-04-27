<?php

namespace App\Data;

use App\Enums\Position;
use App\Enums\Profession;
use App\Enums\Rarity;
use App\Enums\SubProfession;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class CharacterData extends Data
{
    /**
     * @param  Collection<CharacterPhaseData>  $phases
     * @param  Collection<KeyFrameData>|null  $favorKeyFrames
     * @param  Collection<PotentialRankData>|null  $potentialRanks
     * @param  Collection<TalentCandidateData>|null  $talents
     * @param  Collection<SkillData>|null  $skills
     * @param  Collection<TraitCandidateData>|null  $traitCandidates
     * @param  Collection<ModuleData>|null  $modules
     * @param  Collection<RiicBaseSkillData>|null  $riccSkills
     * @param  Collection<CharacterData>|null  $summons
     * @param  Collection<VoiceData>|null  $voices
     * @param  Collection<SkinData>|null  $skins
     */
    public function __construct(
        public string $charId,
        public string|array $name,
        public string $appellation,
        public ?Profession $profession,
        public ?SubProfession $subProfession,
        public string $potentialItemId,
        public bool $canUseGeneralPotentialItem,
        public string|array $description,
        public ?string $nation,
        public ?string $group,
        public ?string $team,
        public ?string $displayNumber,
        public Position $position,
        public Rarity $rarity,
        /** @var string[] */
        public array $tagList,

        public Collection $phases,
        public ?Collection $favorKeyFrames,
        public ?Collection $potentialRanks,
        public ?Collection $talents,
        public ?Collection $skills,
        public ?Collection $traitCandidates,
        public ?Collection $modules,
        public ?Collection $riccSkills,
        public ?Collection $summons,
        public ?Collection $voices,
        public ?Collection $skins,
        public ?HandbookData $handbook,

        public ?string $alterCharId,
        public ?string $baseOperatorCharId,
        public int $releaseOrder,
    ) {
    }
}
