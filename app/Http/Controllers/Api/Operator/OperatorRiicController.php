<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\RiicBaseSkillData;
use App\Data\Character\TalentData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;

class OperatorRiicController extends Controller
{
    public function index(Character $character)
    {
        $character = $character->load(['riccSkills']);
        return ApiResponse::success(RiicBaseSkillData::collect($character->riccSkills));
    }
}
