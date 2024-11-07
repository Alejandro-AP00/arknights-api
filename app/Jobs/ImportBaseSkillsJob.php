<?php

namespace App\Jobs;

use App\Enums\Locales;
use App\Models\BaseSkill;
use App\Transformers\BaseSkillTransformer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportBaseSkillsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle(): void
    {

        $building_table = \Cache::get('building_'.Locales::Chinese->value);

        collect($building_table->get('buffs'))->each(function ($buff) {
            $transformed_base = (new BaseSkillTransformer($buff['buffId'], 'building', tableItem: 'buffs'))->transform();
            BaseSkill::updateOrCreate(['buff_id' => $buff['buffId']], $transformed_base);
        });
    }
}
