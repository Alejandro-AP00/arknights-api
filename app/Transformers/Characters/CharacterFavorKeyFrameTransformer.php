<?php

namespace App\Transformers\Characters;

class CharacterFavorKeyFrameTransformer extends BaseTransformer
{
    protected array $fields = [
        'level',
        'max_hp',
        'atk',
        'def',
        'magic_resistance',
        'cost',
        'block_cnt',
        'move_speed',
        'attack_speed',
        'base_attack_time',
        'respawn_time',
        'hp_recovery_per_sec',
        'sp_recovery_ser_sec',
        'max_deploy_count',
        'max_deck_stack_cnt',
        'taunt_level',
        'mass_level',
        'base_force_level',
        'stun_immune',
        'silence_immune',
        'sleep_immune',
        'frozen_immune',
        'levitate_immune',
    ];
}
