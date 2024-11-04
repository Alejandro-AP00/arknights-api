<?php

namespace App\Transformers\Characters;

use App\Enums\Locales;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CharacterBasicTransformer extends BaseTransformer
{
    protected array $fields = [
        'char_id',
        'is_limited',
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
        'released_at',
        'potential_ranks',
        'talents',
        'voices',
        'skins',
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
        $phases = collect($this->subject->get('phases'));

        return $phases->map(function ($phase, $index) {
            return (new CharacterPhaseTransformer($this->subjectKey, sourceReferenceKey: 'phases.'.$index))->transform();
        });
    }

    public function transformFavorKeyFrames(): Collection
    {
        return collect($this->subject->get('favor_key_frames'))->map(function ($frame) {
            return ['level' => $frame['level'], ...$frame['data']];
        });
    }

    public function transformPotentialRanks(): Collection
    {
        $ranks = collect($this->subject->get('potential_ranks'));

        return $ranks->map(function ($rank, $index) {
            return (new CharacterPotentialRank($this->subjectKey, sourceReferenceKey: 'potential_ranks.'.$index))->transform();
        });
    }

    public function transformTalents(): Collection
    {
        $talents = collect($this->subject->get('talents'));

        return $talents->map(function ($talent, $talent_index) {
            return ['candidates' => collect($talent['candidates'])
                ->filter(fn ($candidate) => $candidate['isHideTalent'] === false)
                ->map(function ($candidate, $candidate_index) use ($talent_index) {
                    return (new CharacterTalentCandidateTransformer($this->subjectKey, sourceReferenceKey: 'talents.'.$talent_index.'.candidates.'.$candidate_index))->transform();
                })];
        });
    }

    public function transformVoices(): ?Collection
    {
        $voices = collect(data_get(Cache::get('voices_'.Locales::Chinese->value), $this->subject->get('char_id')));

        if ($voices->isNotEmpty()) {
            return collect($voices->get('dict'))->values();
        }

        return null;
    }

    public function transformSkins(): ?Collection
    {
        $skins = Cache::get('skins_'.Locales::Chinese->value)->filter(function ($skin) {
            return $skin['charId'] === $this->subject->get('char_id');
        });

        if ($skins->isNotEmpty()) {
            return $skins->map(function ($skin, $key) {
                return (new CharacterSkinTransformer($key, 'skins'))->transform();
            });
        }

        return null;
    }

    public function transformReleasedAt(): Carbon
    {
        return Carbon::parse(Cache::get('release_date')->get($this->subject->get('char_id'))['release_date']);
    }

    public function transformIsLimited(): bool
    {
        return Cache::get('release_date')->get($this->subject->get('char_id'))['is_limited'] ?? false;
    }
}
