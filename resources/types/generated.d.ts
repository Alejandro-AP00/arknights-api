export type CharacterData = {
    charId: string;
    name: LocalizedFieldData;
    appellation: string;
    profession: Profession | null;
    subProfession: SubProfession | null;
    potentialItemId: string | null;
    canUseGeneralPotentialItem: boolean;
    description: LocalizedFieldData;
    nation: string | null;
    group: string | null;
    team: string | null;
    displayNumber: string | null;
    position: Position;
    rarity: Rarity;
    tagList: LocalizedFieldData;
    phases: Array<CharacterPhaseData>;
    favorKeyFrames: Array<KeyFrameData>;
    potentialRanks: Array<PotentialRankData>;
    handbook: HandbookData | null;
    alterCharId: string | null;
    baseOperatorCharId: string | null;
    releaseOrder: number;
};
export type CharacterPhaseData = {
    characterPrefabKey: string;
    maxLevel: number;
    range: RangeData;
    evolveCost: any | Array<any> | null;
    attributesKeyFrames: Array<KeyFrameData>;
};
export type DisplaySkinData = {
    modelName: string | null;
    drawerList: Array<string> | null;
};
export type HandbookData = {
    profile: LocalizedFieldData;
    basicInfo: LocalizedFieldData;
    physicalExam: LocalizedFieldData;
    clinicalAnalysis?: LocalizedFieldData;
    promotionRecord?: LocalizedFieldData;
    performanceReview?: LocalizedFieldData;
    classConversionRecord: LocalizedFieldData;
    archives: LocalizedFieldData;
};
export type InterpolatedValueData = {
    key: string;
    value: number;
};
export type ItemCostData = {
    itemId: string;
    count: number;
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
    moduleStage: Array<ModuleStageData>;
};
export type ModuleStageData = {
    itemCost: Array<ItemCostData>;
    unlockCondition: UnlockConditionData;
    traitEffectType: LocalizedFieldData;
    talentEffect: LocalizedFieldData;
    talentIndex: string | null;
    displayRange: boolean;
    range: RangeData | null;
    attributesBlackboard: Array<InterpolatedValueData>;
    requiredPotentialRank: number;
    tokenAttributesBlackboard: Array<InterpolatedValueData>;
};
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
    unlockCondition: UnlockConditionData;
};
export type SkillData = {
    skillId: string | null;
    iconId: string | null;
    unlockCondition: UnlockConditionData;
    levels: Array<SkillLevelData>;
};
export type SkillLevelData = {
    name: Array<any> | string;
    description: Array<any> | string;
    range: any;
    skillType: string;
    durationType: string;
    spData: Array<any>;
    duration: number;
    blackboard: Array<InterpolatedValueData>;
    lvlUpCost: SkillLevelUpCostData;
};
export type SkillLevelUpCostData = {
    itemCost: Array<ItemCostData> | null;
    unlockCond: UnlockConditionData;
};
export type SkinData = {
    name: LocalizedFieldData;
    skinId: string;
    illustId: string;
    avatarId: string;
    portraitId: string;
    displaySkin: DisplaySkinData;
    type: string;
    obtainSources: Array<any> | null;
    cost: number | null;
    tokenType: string | null;
};
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
    | "notchar1"
    | "notchar2"
    | "none1"
    | "none2";
export type TalentCandidateData = {
    requiredPotentialRank: number;
    unlockCondition: UnlockConditionData;
    name: LocalizedFieldData;
    description: LocalizedFieldData;
    range: RangeData;
    blackboard: Array<InterpolatedValueData>;
};
export type TraitCandidateData = {
    overrideDescription: Array<any> | string;
    range: RangeData;
    requiredPotentialRank: number;
    unlockCondition: UnlockConditionData;
    blackboard: Array<InterpolatedValueData>;
};
export type UnlockConditionData = {
    phase: string | number;
    level: number;
};
export type VoiceData = {
    wordkey: string;
    voiceLangType: string;
    cvName: Array<string>;
};
