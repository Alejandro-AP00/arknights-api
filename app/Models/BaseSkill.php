<?php

namespace App\Models;

use App\Data\Character\RiicBaseSkillData;
use App\Enums\BaseBuffCategory;
use App\Enums\RoomType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class BaseSkill extends Model
{
    use WithData;
    //    use HasTranslations;

    protected string $dataClass = RiicBaseSkillData::class;

    protected $fillable = [
        'buff_id',
        'skill_icon',
        'name',
        'description',
        'buff_color',
        'text_color',
        'room_type',
        'buff_category',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'description' => 'array',
            'buff_category' => BaseBuffCategory::class,
            'room_type' => RoomType::class,
        ];
    }

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class)->withPivot('unlock_condition')->using(BaseSkillCharacter::class);
    }
}
