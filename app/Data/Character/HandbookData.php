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
        public null|string|LocalizedFieldData $profile,
        public null|array|LocalizedFieldData $basicInfo,
        public null|array|LocalizedFieldData $physicalExam,
        public null|string|LocalizedFieldData $clinicalAnalysis,
        public null|string|LocalizedFieldData $promotionRecord,
        public null|array|LocalizedFieldData $performanceReview,
        public null|array|LocalizedFieldData $classConversionRecord,
        public null|array|LocalizedFieldData $archives,
    ) {}
}
