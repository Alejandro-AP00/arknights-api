<?php

namespace App\Models;

use App\Data\Character\InterpolatedValueData;
use App\Data\Character\TalentCandidateData;
use App\Data\Character\UnlockConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\WithData;
use Spatie\Translatable\HasTranslations;

class TalentCandidate extends Model
{
    use HasTranslations, WithData;

    protected string $dataClass = TalentCandidateData::class;

    protected $fillable = [
        'talent_id',
        'range_id',
        'required_potential_rank',
        'unlock_condition',
        'name',
        'description',
        'blackboard',
    ];

    protected function casts(): array
    {
        return [
            'unlock_condition' => UnlockConditionData::class,
            'blackboard' => DataCollection::class.':'.InterpolatedValueData::class,
        ];
    }

    public array $translatable = [
        'name',
        'description',
    ];

    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(Range::class, 'range_id');
    }
}
