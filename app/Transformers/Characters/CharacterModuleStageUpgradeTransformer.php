<?php

namespace App\Transformers\Characters;

use App\Enums\ModuleStageUpgradeType;
use App\Transformers\BaseTransformer;
use Illuminate\Support\Collection;

class CharacterModuleStageUpgradeTransformer extends BaseTransformer
{
    protected array $fields = [
        'is_token',
        'candidates',
        'upgrade_type',
    ];

    public function transformCandidates(): Collection
    {
        if ($this->isTalentTarget()) {
            return collect(data_get($this->sourceReference, 'add_or_override_talent_data_bundle.candidates'))
                ->map(function ($candidate, $candidate_index) {
                    return (new CharacterModuleStageUpgradeCandidateTransformer($this->subjectKey, 'battle_equip', $this->sourceReferenceKey.'.addOrOverrideTalentDataBundle.candidates.'.$candidate_index))->transform();
                });
        }

        if ($this->isTraitTarget()) {
            return collect(data_get($this->sourceReference, 'override_trait_data_bundle.candidates'))
                ->map(function ($candidate, $candidate_index) {
                    return (new CharacterModuleStageUpgradeCandidateTransformer($this->subjectKey, 'battle_equip', $this->sourceReferenceKey.'.overrideTraitDataBundle.candidates.'.$candidate_index))->transform();
                });
        }
    }

    public function transformUpgradeType()
    {
        if ($this->isTalentTarget()) {
            return ModuleStageUpgradeType::TALENT_UPGRADE->value;
        }

        if ($this->isTraitTarget() && data_get($this->sourceReference, 'override_trait_data_bundle.candidates.0.additionalDescription')) {
            return ModuleStageUpgradeType::TRAIT_UPGRADE->value;
        }

        if ($this->isTraitTarget() && data_get($this->sourceReference, 'override_trait_data_bundle.candidates.0.overrideDescripton')) {
            return ModuleStageUpgradeType::TRAIT_UPGRADE->value;
        }
    }

    private function isTraitTarget(): bool
    {
        return in_array($this->sourceReference->get('target'), ['TRAIT', 'TRAIT_DATA_ONLY', 'DISPLAY']);
    }

    private function isTalentTarget(): bool
    {
        return in_array($this->sourceReference->get('target'), ['TALENT', 'TALENT_DATA_ONLY']);
    }
}
