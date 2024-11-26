<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\TalentData;
use App\Data\Character\VoiceData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;

class OperatorVoiceController extends Controller
{
    public function index(Character $character)
    {
        $character = $character->load(['voices']);
        return ApiResponse::success(VoiceData::collect($character->voices));
    }
}
