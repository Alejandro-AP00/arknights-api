<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\SkinData;
use App\Data\Character\TalentData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;

class OperatorSkinController extends Controller
{
    public function index(Character $character)
    {
        $character = $character->load(['skins']);
        return ApiResponse::success(SkinData::collect($character->skins));
    }
}
