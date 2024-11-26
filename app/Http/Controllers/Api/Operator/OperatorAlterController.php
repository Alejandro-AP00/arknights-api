<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorAlterController extends Controller
{
    public function index(Character $character)
    {
        $character->load(['alterCharacters', 'baseCharacter']);
        return ApiResponse::success(CharacterData::collect($character->alterCharacters));
    }
}
