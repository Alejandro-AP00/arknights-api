<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Data\Character\SkillData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use App\Models\Skill;
use Illuminate\Http\Request;

class OperatorSkillController extends Controller
{
    public function index(Character $character)
    {
        $character = $character->load(['skills.levels.range']);
        return ApiResponse::success(SkillData::collect($character->skills));
    }

    public function show(Character $character, Skill $skill)
    {
        $skill = $skill->load(['levels.range']);
        return ApiResponse::success($skill->getData());
    }
}
