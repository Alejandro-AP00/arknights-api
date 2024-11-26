<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Data\Character\SkillData;
use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Skill;
use Illuminate\Http\Request;

class OperatorSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Character $character)
    {
        $character = $character->load(['skills.levels.range']);
        return SkillData::collect($character->skills)->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character, Skill $skill)
    {
        $skill = $skill->load(['levels.range']);
        return $skill->getData();
    }
}
