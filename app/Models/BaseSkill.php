<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'buff_id',
        'skill_icon',
        'name',
        'description',
        'unlock_condition',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
