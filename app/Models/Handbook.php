<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Handbook extends Model
{
    use HasTranslations;

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

    public array $translatable = [
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
