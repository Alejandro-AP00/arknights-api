<?php

namespace App\Data\Character;

use Spatie\LaravelData\Data;

class KeyFrameData extends Data
{
    public function __construct(
        public int $level,
        public int $maxHp,
        public int $atk,
        public int $def,
        public int $magicResistance,
        public int $cost,
        public int $blockCnt,
        public int $moveSpeed,
        public int $attackSpeed,
        public int $baseAttackTime,
        public int $respawnTime,
        public int $hpRecoveryPerSec,
        public int $spRecoveryPerSec,
        public int $maxDeployCount,
        public int $maxDeckStackCnt,
        public int $tauntLevel,
        public int $massLevel,
        public int $baseForceLevel,
        public bool $stunImmune,
        public bool $silenceImmune,
        public bool $sleepImmune,
        public bool $frozenImmune,
        public bool $levitateImmune,
    ) {
    }
}
