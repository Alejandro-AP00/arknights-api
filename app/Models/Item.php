<?php

namespace App\Models;

use App\Data\ItemData;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Item extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = ItemData::class;

    protected $fillable = [
        'item_id',
        'name',
        'description',
        'usage',
        'rarity',
    ];

    public array $translatable = [
        'name',
        'description',
        'usage',
    ];
}
