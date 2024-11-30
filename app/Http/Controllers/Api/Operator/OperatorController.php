<?php

namespace App\Http\Controllers\Api\Operator;

use App;
use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return ApiResponse::success(CharacterData::collect(Character::with(['phases.range', 'potentialRanks', 'traitCandidates'])->operators()->get()));
    }

    public function show(Character $character)
    {
        $character = $character->load(['phases.range', 'potentialRanks', 'traitCandidates']);
        return ApiResponse::success($character->getData());
    }

    public function all(Character $character)
    {
        $character->load([
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
        return ApiResponse::success($character->getData());
    }
}
