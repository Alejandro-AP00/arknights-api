<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Talent extends Model
{
    protected $with = ['candidates'];

    public function candidates(): HasMany
    {
        return $this->hasMany(TalentCandidate::class, 'talent_id');
    }
}
