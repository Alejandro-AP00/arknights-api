<?php

namespace App\Models;

use App\Data\Character\DisplaySkinData;
use App\Data\Character\SkinData;
use App\Enums\SkinSource;
use App\Enums\TokenType;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Skin extends Model
{
    use HasTranslations, WithData;

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

    public array $translatable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            'display_skin' => DisplaySkinData::class,
            'obtain_sources' => AsEnumCollection::class.':'.SkinSource::class,
            'token_type' => TokenType::class,

            'name' => 'array',
        ];
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
