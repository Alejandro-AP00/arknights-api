<?php

namespace App\Jobs;

use App\Models\Character;
use Illuminate\Bus\PendingBatch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class ImportCharacterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private PendingBatch $batch;

    public function __construct(private $charId, private $character) {}

    public function handle(): void
    {
        $character = new Character;

        $character->char_id = $this->charId;
        //        $this->batch = Bus::batch([
        //
        //        ]);
    }
}
