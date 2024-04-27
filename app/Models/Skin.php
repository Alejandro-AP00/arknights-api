<?php

namespace App\Models;

use App\Data\Character\DisplaySkinData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skin extends Model
{
    protected $fillable = [
        'character_id',
        'skin_id',
        'illust_id',
        'avatar_id',
        'portrait_id',
        'name',
        'display_skin',
        'type',
        'obtain_sources',
        'cost',
        'token_type',
    ];

    protected $casts = [
        'display_skin' => DisplaySkinData::class,
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}