<?php

namespace App\Transformers\Characters;

use App\Transformers\BaseTransformer;
use Illuminate\Support\Collection;

class CharacterModuleStageTransformer extends BaseTransformer
{
    protected array $fields = [
        'equip_level',
        'attribute_blackboard',
        'token_attribute_blackboard',
        'upgrades',
    ];

    protected array $rename_keys = [
        'equip_level' => 'stage',
    ];

    public function transformUpgrades(): ?Collection
    {
        return collect($this->sourceReference->get('parts'))->map(function ($part, $index) {
            return (new CharacterModuleStageUpgradeTransformer($this->subjectKey, 'battle_equip', $this->sourceReferenceKey.'.parts.'.$index))->transform();
        });
    }
}
