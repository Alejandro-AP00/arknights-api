<?php

namespace App\Data\Character;

use App\Data\LocalizedFieldData;
use App\Enums\BaseBuffCategory;
use App\Enums\RoomType;
use App\Models\BaseSkill;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class RiicBaseSkillData extends Data
{
    public function __construct(
        public string $buffId,
        public LocalizedFieldData $name,
        public LocalizedFieldData $description,
        public string $skillIcon,
        public string $buffColor,
        public string $textColor,
        public BaseBuffCategory $buffCategory,
        public RoomType $roomType,
        public UnlockConditionData $unlockCondition
    ) {}

    public static function fromModel(BaseSkill $skill): self
    {
        return new self(
            $skill->buff_id,
            LocalizedFieldData::from($skill->name),
            LocalizedFieldData::from($skill->description),
            $skill->skill_icon,
            $skill->buff_color,
            $skill->text_color,
            $skill->buff_category,
            $skill->room_type,
            UnlockConditionData::from($skill->pivot->unlock_condition),
        );
    }
}
