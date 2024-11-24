<?php

namespace App\Http\Controllers\Api;

use App\Data\Character\CharacterData;
use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CharacterData::collect(Character::operators()->get())->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return $character->getData();
    }
}
