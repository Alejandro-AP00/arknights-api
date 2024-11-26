<?php

namespace App\Http\Controllers\Api\Operator;

use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApiResponse::success(CharacterData::collect(Character::operators()->get()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return ApiResponse::success($character->getData());
    }
}
