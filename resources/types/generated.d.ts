export type BaseBuffCategory = "FUNCTION" | "OUTPUT" | "RECOVERY";
export type CharacterData = {
    charId: string;
    isLimited: boolean;
    name: LocalizedFieldData | string;
    appellation: string;
    profession: Profession | null;
    subProfession: SubProfession | null;
    potentialItemId: string | null;
    canUseGeneralPotentialItem: boolean;
    description: LocalizedFieldData | string | null;
    nation: string | null;
    group: string | null;
    team: string | null;
    displayNumber: string | null;
    position: Position;
    rarity: Rarity;
    tagList: LocalizedFieldData | Array<any> | null;
    phases: Array<CharacterPhaseData> | null;
    favorKeyFrames: Array<KeyFrameData> | null;
    potentialRanks: Array<PotentialRankData> | null;
    talents: Array<TalentData> | null;
    skills: Array<SkillData> | null;
    traitCandidates: Array<TraitCandidateData> | null;
    modules: Array<ModuleData> | null;
    riccSkills: Array<RiicBaseSkillData> | null;
    summons: Array<CharacterData> | null;
    voices: Array<VoiceData> | null;
    skins: Array<SkinData> | null;
    handbook: HandbookData | null;
    alterCharacters: Array<CharacterData> | null;
    baseCharacter: CharacterData | null;
    releasedAt: string | null;
};
export type CharacterPhaseData = {
    characterPrefabKey: string;
    maxLevel: number;
    range: RangeData;
    evolveCost: Array<ItemCostData> | null;
    attributesKeyFrames: Array<KeyFrameData>;
};
export type DisplaySkinData = {
    modelName: string | null;
    drawerList: Array<string> | null;
};
export type HandbookData = {
    profile: LocalizedFieldData | null;
    basicInfo: LocalizedFieldData | null;
    physicalExam: LocalizedFieldData | null;
    clinicalAnalysis: LocalizedFieldData | null;
    promotionRecord: LocalizedFieldData | null;
    performanceReview: LocalizedFieldData | null;
    classConversionRecord: LocalizedFieldData | null;
    archives: LocalizedFieldData | null;
};
export type InterpolatedValueData = {
    key: string;
    value: number;
};
export type ItemCostData = {
    itemId: string;
    count: number;
    type: string | null;
};
export type KeyFrameData = {
    level: number;
    maxHp: number;
    atk: number;
    def: number;
    magicResistance: number;
    cost: number;
    blockCnt: number;
    moveSpeed: number;
    attackSpeed: number;
    baseAttackTime: number;
    respawnTime: number;
    hpRecoveryPerSec: number;
    spRecoveryPerSec: number;
    maxDeployCount: number;
    maxDeckStackCnt: number;
    tauntLevel: number;
    massLevel: number;
    baseForceLevel: number;
    stunImmune: boolean;
    silenceImmune: boolean;
    sleepImmune: boolean;
    frozenImmune: boolean;
    levitateImmune: boolean;
    disarmedCombatImmune: boolean;
};
export type Locales = "en_US" | "ko_KR" | "zh_CN" | "ja_JP";
export type LocalizedFieldData = {
    en_US: Array<any> | string;
    ko_KR: Array<any> | string;
    zh_CN: Array<any> | string;
    ja_JP: Array<any> | string;
};
export type ModuleData = {
    moduleId: string;
    name: LocalizedFieldData;
    description: LocalizedFieldData;
    iconId: string;
    typeIcon: string;
    typeName1: string;
    typeName2: string | null;
    shiningColor: string;
    type: string;
    order_by: number;
    unlockCondition: UnlockConditionData;
    unlockMissions: Array<UnlockMissionData> | null;
    stages: Array<ModuleStageData> | null;
};
export type ModuleStageData = {
    stage: number;
    itemCost: Array<ItemCostData>;
    upgrades: Array<ModuleStageUpgradeData> | null;
    attributeBlackboard: Array<InterpolatedValueData> | null;
    tokenAttributeBlackboard: { [key: string]: Array<InterpolatedValueData> };
};
export type ModuleStageUpgradeCandidateData = {
    description: LocalizedFieldData | null;
    range: RangeData | null;
    blackboard: Array<InterpolatedValueData>;
    requiredPotentialRank: number;
    unlockCondition: UnlockConditionData;
};
export type ModuleStageUpgradeData = {
    isToken: boolean | null;
    upgradeType: ModuleStageUpgradeType;
    candidates: Array<ModuleStageUpgradeCandidateData> | null;
};
export type ModuleStageUpgradeType =
    | "TRAIT_UPGRADE"
    | "TRAIT_OVERRIDE"
    | "TALENT_UPGRADE";
export type Position = "ALL" | "MELEE" | "NONE" | "RANGED";
export type PotentialRankData = {
    type: string | null;
    description: LocalizedFieldData;
    buff: Array<any> | null;
};
export type Profession =
    | "CASTER"
    | "TANK"
    | "WARRIOR"
    | "MEDIC"
    | "SNIPER"
    | "SPECIAL"
    | "SUPPORT"
    | "PIONEER"
    | "TOKEN"
    | "TRAP";
export type RangeData = {
    rangeId: string;
    direction: number;
    grids: Array<RangeGridData>;
};
export type RangeGridData = {
    row: number;
    col: number;
};
export type Rarity =
    | "TIER_1"
    | "TIER_2"
    | "TIER_3"
    | "TIER_4"
    | "TIER_5"
    | "TIER_6";
export type RiicBaseSkillData = {
    buffId: string;
    name: LocalizedFieldData;
    description: LocalizedFieldData;
    skillIcon: string;
    buffColor: string;
    textColor: string;
    buffCategory: BaseBuffCategory;
    roomType: RoomType;
    unlockCondition: UnlockConditionData;
};
export type RoomType =
    | "CONTROL"
    | "CORRIDOR"
    | "DORMITORY"
    | "ELEVATOR"
    | "FUNCTIONAL"
    | "HIRE"
    | "MANUFACTURE"
    | "MEETING"
    | "NONE"
    | "POWER"
    | "TRADING"
    | "TRAINING"
    | "WORKSHOP";
export type SkillData = {
    skillId: string | null;
    iconId: string | null;
    unlockCondition: UnlockConditionData;
    levels: Array<SkillLevelData>;
};
export type SkillLevelData = {
    name: LocalizedFieldData;
    description: LocalizedFieldData | null;
    range: RangeData | null;
    skillType: string;
    durationType: string;
    spData: Array<any>;
    duration: number;
    blackboard: Array<InterpolatedValueData>;
    lvlUpCost: SkillLevelUpCostData | null;
};
export type SkillLevelUpCostData = {
    itemCost: Array<ItemCostData> | null;
    unlockCond: UnlockConditionData;
};
export type SkinData = {
    name: LocalizedFieldData;
    skinId: string;
    illustId: string | null;
    avatarId: string;
    portraitId: string | null;
    displaySkin: DisplaySkinData;
    type: string;
    obtainSources: any | null;
    cost: number | null;
    tokenType: TokenType | null;
};
export type SkinSource =
    | "ContingencyContractStore"
    | "OutfitStore"
    | "RedemptionCode"
    | "IntegratedStrategies"
    | "Event"
    | "RealWorldPromotion"
    | "Unknown";
export type SubProfession =
    | "pioneer"
    | "charger"
    | "tactician"
    | "bearer"
    | "agent"
    | "hammer"
    | "centurion"
    | "fighter"
    | "artsfghter"
    | "instructor"
    | "lord"
    | "sword"
    | "musha"
    | "fearless"
    | "reaper"
    | "librator"
    | "crusher"
    | "protector"
    | "guardian"
    | "unyield"
    | "primprotector"
    | "artsprotector"
    | "duelist"
    | "fortress"
    | "shotprotector"
    | "fastshot"
    | "closerange"
    | "aoesniper"
    | "longrange"
    | "reaperrange"
    | "siegesniper"
    | "bombarder"
    | "hunter"
    | "loopshooter"
    | "corecaster"
    | "splashcaster"
    | "funnel"
    | "phalanx"
    | "mystic"
    | "chain"
    | "blastcaster"
    | "primcaster"
    | "physician"
    | "ringhealer"
    | "healer"
    | "wandermedic"
    | "incantationmedic"
    | "chainhealer"
    | "slower"
    | "underminer"
    | "bard"
    | "blessing"
    | "summoner"
    | "craftsman"
    | "ritualist"
    | "executor"
    | "pusher"
    | "stalker"
    | "hookmaster"
    | "geek"
    | "merchant"
    | "traper"
    | "dollkeeper"
    | "skywalker"
    | "alchemist"
    | "notchar1"
    | "notchar2"
    | "none1"
    | "none2";
export type TalentCandidateData = {
    requiredPotentialRank: number;
    unlockCondition: UnlockConditionData;
    name: LocalizedFieldData;
    description: LocalizedFieldData;
    range: RangeData | null;
    blackboard: Array<InterpolatedValueData>;
};
export type TalentData = {
    candidates: Array<TalentCandidateData>;
};
export type TokenType =
    | "OriginiumPrime"
    | "ContingencyContractToken"
    | "Unknown";
export type TraitCandidateData = {
    overrideDescription: LocalizedFieldData | null;
    range: RangeData | null;
    requiredPotentialRank: number;
    unlockCondition: UnlockConditionData;
    blackboard: Array<InterpolatedValueData>;
};
export type UnlockConditionData = {
    phase: string | number;
    level: number;
    trust: Array<any> | number | null;
};
export type UnlockMissionData = {
    description: LocalizedFieldData;
    missionId: string;
    jumpStageId: string | null;
};
export type VoiceData = {
    wordkey: string;
    voiceLangType: string;
    cvName: Array<string>;
};
