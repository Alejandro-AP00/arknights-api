<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorSummonController extends Controller
{
    public function index(Character $character)
    {
        $character->load(['summons']);
        return ApiResponse::success(CharacterData::collect($character->summons));
    }

    public function show(Character $character, Character $summon)
    {
        $summon = $summon->load([
            'phases.range',
            'potentialRanks',
            'traitCandidates',
            'handbook',
            'modules.stages.upgrades.candidates.range',
            'modules.unlockMissions',
            'riccSkills',
            'skills.levels.range',
            'skins',
            'talents.candidates',
            'voices',
            'alterCharacters',
            'baseCharacter'
        ]);
        return ApiResponse::success($summon->getData());
    }
}
