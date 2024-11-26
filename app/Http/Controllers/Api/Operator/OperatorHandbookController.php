<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Data\Character\ModuleData;
use App\Data\Character\SkillData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use App\Models\Module;
use App\Models\Skill;
use Illuminate\Http\Request;

class OperatorHandbookController extends Controller
{
    public function show(Character $character)
    {
        $character = $character->load(['handbook']);
        return ApiResponse::success($character->handbook->getData());
    }
}
