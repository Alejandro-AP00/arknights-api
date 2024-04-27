<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'word_key',
        'voice_lang_type',
        'cv_name',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
