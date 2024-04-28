<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

class HandbookData extends Data
{
    public function __construct(
        public LocalizedFieldData $profile,
        public LocalizedFieldData $basicInfo,
        public LocalizedFieldData $physicalExam,
        #[Optional]
        public LocalizedFieldData $clinicalAnalysis,
        #[Optional]
        public LocalizedFieldData $promotionRecord,
        #[Optional]
        public LocalizedFieldData $performanceReview,
        public LocalizedFieldData $classConversionRecord,
        public LocalizedFieldData $archives,
    ) {
    }
}
