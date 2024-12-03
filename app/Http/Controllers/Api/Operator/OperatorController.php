<?php

namespace App\Http\Controllers\Api\Operator;

use App;
use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class OperatorController extends Controller
{
    public function index()
    {
        $characters = QueryBuilder::for(Character::class)
            ->allowedFilters([
                'name',
                'profession',
                'sub_profession',
                'nation',
                'position',
                'rarity',
                'is_limited',
            ])
            ->defaultSorts([
                '-rarity',
                'released_at',
            ])
            ->allowedSorts([
                'name',
                'profession',
                'sub_profession',
                'nation',
                'position',
                'rarity',
                'released_at',
            ])
            ->allowedIncludes([
                ...$this->getCharacterIncludes(),
                ...$this->getCharacterIncludes('alterCharacters'),
                ...$this->getCharacterIncludes('baseCharacter'),
                ...$this->getCharacterIncludes('summons'),
            ])
            ->operators()
            ->get();

        return ApiResponse::success(CharacterData::collect($characters));
    }

    public function show(Character $character)
    {
        $character = QueryBuilder::for(Character::class)
            ->allowedIncludes([
                ...$this->getCharacterIncludes(),
                ...$this->getCharacterIncludes('alterCharacters'),
                ...$this->getCharacterIncludes('baseCharacter'),
                ...$this->getCharacterIncludes('summons'),
            ])
            ->find($character->id);
        return ApiResponse::success($character->getData());
    }

    private function getCharacterIncludes($prefix = null) :array {
        $keys = [
            'phases',
            'potentialRanks',
            'traitCandidates',
            'handbook',
            'modules.stages.upgrades.candidates',
            'modules.unlockMissions',
            'riccSkills',
            'skills.levels',
            'skins',
            'talents',
            'voices',
            'alterCharacters',
            'baseCharacter',
        ];

        return collect($keys)->map(function ($key) use ($prefix) {
            return collect($prefix, $key)->whereNotNull()->join('.');
        })->all();
    }
}
