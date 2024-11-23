<?php

namespace App\Models;

use App\Data\RangeData;
use App\Data\RangeGridData;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class Range extends Model
{
    use WithData;

    protected string $dataClass = RangeData::class;

    protected $fillable = [
        'range_id',
        'direction',
        'grids',
    ];

    protected function casts() : array {
        return [
            'grids' => DataCollection::class.':'.RangeGridData::class,
        ];
    }
}
