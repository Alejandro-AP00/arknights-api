<?php

namespace App\Models;

use App\Data\Character\CharacterData;
use App\Data\Character\KeyFrameData;
use App\Enums\Position;
use App\Enums\Profession;
use App\Enums\Rarity;
use App\Enums\SubProfession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class Character extends Model
{
    use WithData;

    protected string $dataClass = CharacterData::class;

    protected $fillable = [
        'owner_id',
        'char_id',
        'alter_char_id',
        'base_operator_char_id',
        'released_at',
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
        'profession' => Profession::class,
        'sub_profession' => SubProfession::class,
        'rarity' => Rarity::class,
        'favor_key_frames' => DataCollection::class.':'.KeyFrameData::class,

        'tag_list' => 'array',
        'description' => 'array',
        'name' => 'array',
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

    public function potentials(): HasMany
    {
        return $this->hasMany(Potential::class);
    }

    public function traitCandidates(): HasMany
    {
        return $this->hasMany(TraitCandidate::class);
    }

    public function talents(): HasMany
    {
        return $this->hasMany(Talent::class);
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
