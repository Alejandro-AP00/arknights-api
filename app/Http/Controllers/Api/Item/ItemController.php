<?php

namespace App\Http\Controllers\Api\Item;

use App\Data\ItemData;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Item;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = QueryBuilder::for(Item::class)
            ->allowedFilters([
                'item_id',
                'name',
                'description',
                'usage',
                'rarity',
            ])
            ->defaultSorts([
                '-rarity',
            ])
            ->allowedSorts([
                'name',
                'rarity',
            ]);

        return ApiResponse::success(ItemData::collect($items));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return ApiResponse::success($item->getData());
    }
}
