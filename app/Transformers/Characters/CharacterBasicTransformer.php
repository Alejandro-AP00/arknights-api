<?php

namespace App\Transformers\Characters;

use Illuminate\Support\Collection;

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

        return $ranks->map(function ($phase, $index) {
            return (new CharacterPotentialRank($this->character, 'potential_ranks.'.$index))->transform();
        });
    }

    public function transformTalents(): Collection
    {
        $talents = collect($this->character->get('talents'));

        return $talents->map(function ($phase, $index) {
            return (new CharacterTalentTransformer($this->character, 'talents.'.$index.'.candidates'))->transform();
        });
    }

    public function transformReleaseOrder(): int
    {
        return 0;
    }
}
