<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'module_id',
        'icon_id',
        'name',
        'description',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function moduleStages()
    {
        return $this->hasMany(ModuleStage::class);
    }
}
