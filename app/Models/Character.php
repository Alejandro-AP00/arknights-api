<?php

namespace App\Models;

use App\Data\Character\CharacterData;
use App\Data\Character\KeyFrameData;
use App\Enums\Position;
use App\Enums\Rarity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Character extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = CharacterData::class;

    protected $fillable = [
        'char_id',
        'alter_char_id',
        'base_operator_char_id',
        'release_order',
        'name',
        'appellation',
        'profession',
        'sub_profession',
        'potential_item_id',
        'can_use_general_potential_item',
        'description',
        'nation',
        'group',
        'team',
        'display_number',
        'position',
        'rarity',
        'tag_list',
        'favor_key_frames',
    ];

    protected $casts = [
        'position' => Position::class,
        'rarity' => Rarity::class,
        'favor_key_frames' => DataCollection::class.':'.KeyFrameData::class,
    ];

    public array $translatable = [
        'name',
        'description',
        'tag_list',
    ];

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class);
    }

    public function traitCandidates(): HasMany
    {
        return $this->hasMany(TraitCandidate::class);
    }

    public function talentCandidates(): HasMany
    {
        return $this->hasMany(TalentCandidate::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function riccSkills(): HasMany
    {
        return $this->hasMany(BaseSkill::class);
    }

    public function voices(): HasMany
    {
        return $this->hasMany(Voice::class);
    }

    public function skins(): HasMany
    {
        return $this->hasMany(Skin::class);
    }

    public function summons(): HasMany
    {
        return $this->hasMany(Character::class, 'owner_id');
    }

    public function handbook(): HasOne
    {
        return $this->hasOne(Handbook::class);
    }
}
