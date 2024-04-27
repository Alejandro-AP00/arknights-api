<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'skill_id',
        'icon_id',
        'unlock_condition',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function levels()
    {
        return $this->hasMany(SkillLevel::class);
    }
}
