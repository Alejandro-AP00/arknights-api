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
        return ApiResponse::success($character->getData());
    }
}
