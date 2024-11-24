<?php

namespace App\Models;

use App\Data\Character\HandbookData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class Handbook extends Model
{
    use HasTranslations, WithData;

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

    protected function profile(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function basicInfo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function physicalExam(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function clinicalAnalysis(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function promotionRecord(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function performanceReview(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function classConversionRecord(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }

    protected function archives(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => empty($value) ? null : $value,
        );
    }


    protected function casts(): array
    {
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
