<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
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
     * @param  Collection<KeyFrameData>  $favorKeyFrames
     * @param  Collection<PotentialRankData>  $potentialRanks
     * @param  Collection<TalentData>  $talents
     * @param  Collection<VoiceData>  $voices
     * @param  Collection<SkinData>  $skins
     */
    public function __construct(
        public string $charId,
        public LocalizedFieldData $name,
        public string $appellation,
        public ?Profession $profession,
        public ?SubProfession $subProfession,
        public ?string $potentialItemId,
        public bool $canUseGeneralPotentialItem,
        public LocalizedFieldData $description,
        public ?string $nation,
        public ?string $group,
        public ?string $team,
        public ?string $displayNumber,
        public Position $position,
        public Rarity $rarity,
        public LocalizedFieldData $tagList,

        public Collection $phases,
        public ?Collection $favorKeyFrames,
        public ?Collection $potentialRanks,
        public ?Collection $talents,
        //                public ?Collection $skills,
        //                public ?Collection $traitCandidates,
        //        public ?Collection $modules,
        //        public ?Collection $riccSkills,
        //        public ?Collection $summons,
        public ?Collection $voices,
        public ?Collection $skins,
        public ?HandbookData $handbook,

        public ?string $alterCharId,
        public ?string $baseOperatorCharId,
        public int $releaseOrder,
    ) {
    }
}
