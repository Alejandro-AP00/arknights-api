<?php

namespace App\Models;

use App\Data\RangeGridData;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class Range extends Model
{
    protected $fillable = [
        'range_id',
        'direction',
        'grids',
    ];

    protected $casts = [
        'grids' => DataCollection::class.':'.RangeGridData::class,
    ];
}
