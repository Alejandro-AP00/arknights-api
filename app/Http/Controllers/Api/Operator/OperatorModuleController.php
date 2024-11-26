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

class OperatorModuleController extends Controller
{
    public function index(Character $character)
    {
        $character = $character->load(['modules.stages.upgrades.candidates.range', 'modules.unlockMissions']);

        return ApiResponse::success(ModuleData::collect($character->modules));
    }

    public function show(Character $character, Module $module)
    {
        $module = $module->load(['stages.upgrades.candidates.range', 'unlockMissions']);
        return ApiResponse::success($module->getData());
    }
}
