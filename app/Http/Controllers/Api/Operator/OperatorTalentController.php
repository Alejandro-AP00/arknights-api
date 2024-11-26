<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\TalentData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;

class OperatorTalentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Character $character)
    {
        $character = $character->load(['talents.candidates']);
        return ApiResponse::success(TalentData::collect($character->talents));
    }
}
