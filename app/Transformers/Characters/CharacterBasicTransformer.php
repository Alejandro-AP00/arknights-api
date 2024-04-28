<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class CharacterBasicTransformer extends BaseTransformer
{
    protected array $fields = [
        'char_id',
        'name',
        'appellation',
        'profession',
        'sub_profession_id',
        'potential_item_id',
        'can_use_general_potential_item',
        'description',
        'nation_id',
        'group_id',
        'team_id',
        'display_number',
        'position',
        'rarity',
        'tag_list',
        'phases',
        'favor_key_frames',
        'release_order',
        'potential_ranks',
        'talents',
        'voices',
    ];

    protected array $rename_keys = [
        'nation_id' => 'nation',
        'group_id' => 'group',
        'team_id' => 'team',
        'sub_profession_id' => 'sub_profession',
    ];

    protected array $localize = [
        'name',
        'description',
        'tag_list',
    ];

    public function transformPhases(): Collection
    {
        $phases = collect($this->character->get('phases'));

        return $phases->map(function ($phase, $index) {
            return (new CharacterPhaseTransformer($this->character, 'phases.'.$index))->transform();
        });
    }

    public function transformFavorKeyFrames(): Collection
    {
        return collect($this->character->get('favor_key_frames'))->map(function ($frame) {
            return ['level' => $frame['level'], ...$frame['data']];
        });
    }

    public function transformPotentialRanks(): Collection
    {
        $ranks = collect($this->character->get('potential_ranks'));

        return $ranks->map(function ($rank, $index) {
            return (new CharacterPotentialRank($this->character, 'potential_ranks.'.$index))->transform();
        });
    }

    public function transformTalents(): Collection
    {
        $talents = collect($this->character->get('talents'));

        return $talents->map(function ($talent, $talent_index) {
            return ['candidates' => collect($talent['candidates'])->map(function ($candidate, $candidate_index) use ($talent_index) {
                return (new CharacterTalentCandidateTransformer($this->character, 'talents.'.$talent_index.'.candidates.'.$candidate_index))->transform();
            })];
        });
    }

    public function transformVoices(): Collection
    {
        $voices = collect(File::gameData(Locales::Chinese, 'charword_table.json')['voiceLangDict'][$this->character->get('char_id')]);

        return collect($voices->get('dict'))->values();
    }

    public function transformReleaseOrder(): int
    {
        return 0;
    }
}
