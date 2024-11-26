<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorBaseController extends Controller
{
    public function show(Character $character)
    {
        $character->load(['alterCharacters', 'baseCharacter']);
        return ApiResponse::success($character->baseCharacter->getData());
    }
}
