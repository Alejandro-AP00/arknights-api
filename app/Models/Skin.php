<?php

namespace App\Models;

use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\DisplaySkinData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory;

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

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
