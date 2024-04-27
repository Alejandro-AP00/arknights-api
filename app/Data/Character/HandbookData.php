<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\Optional;

class HandbookData extends Data
{
    public function __construct(
        public string|array $profile,
        /** @var array{'title': string, "value": string} */
        public array $basicInfo,
        /** @var array{'title': string, "value": string} */
        public ?array $physicalExam,
        #[Optional]
        public string|array $clinicalAnalysis,
        #[Optional]
        public string|array $promotionRecord,
        #[Optional]
        public string|array $peformanceReview,
        /** @var array{'title': string, "value": string} */
        public ?array $classConversionRecord,
        /** @var string[] */
        public array $archives,
    ) {
    }
}
