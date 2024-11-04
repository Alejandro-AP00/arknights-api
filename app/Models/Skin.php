<?php

namespace App\Models;

use App\Data\Character\DisplaySkinData;
use App\Data\Character\SkinData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Skin extends Model
{
    use WithData;

    protected string $dataClass = SkinData::class;

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

        'name' => 'array',
    ];

    public array $translatable = [
        'name',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
