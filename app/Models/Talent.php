<?php

namespace App\Models;

use App\Data\Character\TalentData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Talent extends Model
{
    use WithData;

    protected string $dataClass = TalentData::class;

    protected $fillable = [
        'character_id',
    ];

    protected $with = ['candidates'];

    public function candidates(): HasMany
    {
        return $this->hasMany(TalentCandidate::class, 'talent_id');
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
