<?php

namespace App\Models;

use App\Data\ItemCostData;
use App\Data\KeyFrameData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = [
        'range_id',
        'character_prefab_key',
        'max_level',
        'evolve_cost',
        'attributes_key_frames',
    ];

    protected $casts = [
        'evolve_cost' => DataCollection::class.':'.ItemCostData::class,
        'attributes_key_frames' => DataCollection::class.':'.KeyFrameData::class,
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function range()
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
