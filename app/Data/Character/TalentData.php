<?php

namespace App\Data\Character;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class TalentData extends Data
{
    /**
     * @param  Collection<TalentCandidateData>  $candidates
     */
    public function __construct(
        public Collection $candidates,
    ) {}
}
