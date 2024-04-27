<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'type',
        'description',
        'buff',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
