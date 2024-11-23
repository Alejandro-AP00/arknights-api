<?php

namespace App\Models;

use App\Data\Character\HandbookData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Handbook extends Model
{
    //    use HasTranslations;
    use WithData;

    protected string $dataClass = HandbookData::class;

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

    protected function casts() : array {
        return [
            'profile' => 'array',
            'basic_info' => 'array',
            'physical_exam' => 'array',
            'clinical_analysis' => 'array',
            'promotion_record' => 'array',
            'performance_review' => 'array',
            'class_conversion_record' => 'array',
            'archives' => 'array',
        ];
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
