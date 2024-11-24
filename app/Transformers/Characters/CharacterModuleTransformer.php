<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;
use Illuminate\Support\Collection;

class CharacterModuleTransformer extends BaseTransformer
{
    protected array $fields = [
        'uni_equip_id',
        'uni_equip_name',
        'uni_equip_desc',
        'uni_equip_icon',
        'type_icon',
        'type_name1',
        'type_name2',
        'equip_shining_color',
        'type',
        'char_equip_order',
        'unlock_condition',
        'unlock_missions',
        'stages',
    ];

    protected array $localize = [
        'uni_equip_name',
        'uni_equip_desc',
    ];

    protected array $rename_keys = [
        'uni_equip_id' => 'module_id',
        'uni_equip_name' => 'name',
        'uni_equip_desc' => 'description',
        'uni_equip_icon' => 'icon_id',
        'equip_shining_color' => 'shining_color',
        'char_equip_order' => 'order_by',
    ];

    public function transformUnlockCondition(): array
    {
        return [
            'phase' => $this->sourceReference->get('unlock_evolve_phase'),
            'level' => $this->sourceReference->get('unlock_level'),
            'trust' => $this->sourceReference->get('unlock_favors'),
        ];
    }

    public function transformUnlockMissions(): ?Collection
    {
        return collect($this->sourceReference->get('mission_list'))->map(function ($mission) {
            return (new CharacterModuleMissionTransformer($mission, 'uniequip', tableItem: 'missionList'))->transform();
        });
    }

    public function transformStages(): ?Collection
    {
        return collect($this->sourceReference->get('item_cost'))->map(function ($cost, $stage) {
            $stage_index = ((int) $stage) - 1;

            return collect((new CharacterModuleStageTransformer($this->sourceReference->get('uni_equip_id'), 'battle_equip', 'phases.'.$stage_index))->transform())
                ->prepend(
                    $cost, 'item_cost'
                );
        });
    }
}
