<?php

namespace App\Http\Controllers\Api\Range;

use App\Data\Character\CharacterData;
use App\Data\RangeData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Character;
use App\Models\Range;
use Illuminate\Http\Request;

class RangeController extends Controller
{
    public function index()
    {
        return ApiResponse::success(RangeData::collect(Range::all()));
    }

    public function show(Range $range)
    {
        return ApiResponse::success($range->getData());
    }
}
