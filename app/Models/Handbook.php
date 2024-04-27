<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Handbook extends Model
{
    protected $fillable = [
        'character_id',
        'profile',
        'basic_info',
        'physical_exam',
        'clinical_analysis',
        'promotion_record',
        'performance_review',
        'class_conversion_record',
        'archives',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
