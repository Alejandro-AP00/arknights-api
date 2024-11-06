<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class HandbookData extends Data
{
    public function __construct(
        public ?LocalizedFieldData $profile,
        public ?LocalizedFieldData $basicInfo,
        public ?LocalizedFieldData $physicalExam,
        public ?LocalizedFieldData $clinicalAnalysis,
        public ?LocalizedFieldData $promotionRecord,
        public ?LocalizedFieldData $performanceReview,
        public ?LocalizedFieldData $classConversionRecord,
        public ?LocalizedFieldData $archives,
    ) {}
}
