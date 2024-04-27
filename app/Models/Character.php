<?php

namespace App\Models;

use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\CharacterData;
use App\Data\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\Character\KeyFrameData;
use App\Enums\Position;
use App\Enums\Rarity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;

class Character extends Model
{
    use WithData;

    protected $dataClass = CharacterData::class;

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

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    public function traitCandidates()
    {
        return $this->hasMany(TraitCandidate::class);
    }

    public function talentCandidates()
    {
        return $this->hasMany(TalentCandidate::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function riccSkills()
    {
        return $this->hasMany(BaseSkill::class);
    }

    public function voices()
    {
        return $this->hasMany(Voice::class);
    }

    public function skins()
    {
        return $this->hasMany(Skin::class);
    }

    public function summons()
    {
        return $this->hasMany(Character::class, 'owner_id');
    }

    public function handbook()
    {
        return $this->hasOne(Handbook::class);
    }
}
