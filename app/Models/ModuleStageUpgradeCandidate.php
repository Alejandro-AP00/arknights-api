<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleStageUpgradeCandidate extends Model
{
    public function moduleStageUpgrade(): BelongsTo
    {
        return $this->belongsTo(ModuleStageUpgrade::class);
    }
}
