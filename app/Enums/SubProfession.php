<?php

namespace App\Enums;

enum SubProfession: string
{
    case Pioneer = 'pioneer';
    case Charger = 'charger';
    case Tactician = 'tactician';
    case StandardBearer = 'bearer';
    case Agent = 'agent';
    // Guard
    case Centurion = 'centurion';
    case Fighter = 'fighter';
    case ArtsFighter = 'artsfghter';
    case Instructor = 'instructor';
    case Lord = 'lord';
    case Swordmaster = 'sword';
    case Musha = 'musha';
    case Dreadnought = 'fearless';
    case Reaper = 'reaper';
    case Liberator = 'librator';
    case Crusher = 'crusher';
    // Defender
    case Protector = 'protector';
    case Guardian = 'guardian';
    case Juggernaut = 'unyield';
    case ArtsProtector = 'artsprotector';
    case Duelist = 'duelist';
    case Fortress = 'fortress';
    case Sentinel = 'shotprotector';
    // Sniper
    case Marksman = 'fastshot';
    case Heavyshooter = 'closerange';
    case Artilleryman = 'aoesniper';
    case Deadeye = 'longrange';
    case Spreadshooter = 'reaperrange';
    case Besieger = 'siegesniper';
    case Flinger = 'bombarder';
    case Hunter = 'hunter';
    case Loopshooter = 'loopshooter';
    // Caster
    case CoreCaster = 'corecaster';
    case SplashCaster = 'splashcaster';
    case MechAccordCaster = 'funnel';
    case PhalanxCaster = 'phalanx';
    case MysticCaster = 'mystic';
    case ChainCaster = 'chain';
    case BlastCaster = 'blastcaster';
    case PrimalCaster = 'primcaster';
    // Medic
    case Medic = 'physician';
    case MultiTargetMedic = 'ringhealer';
    case Therapist = 'healer';
    case WanderingMedic = 'wandermedic';
    case IncantationMedic = 'incantationmedic';
    case ChainMedic = 'chainhealer';
    // Supporter
    case DecelBinder = 'slower';
    case Hexer = 'underminer';
    case Bard = 'bard';
    case Abjurer = 'blessing';
    case Summoner = 'summoner';
    case Artificer = 'craftsman';
    case Ritualist = 'ritualist';
    // Specialist
    case Executor = 'executor';
    case PushStroker = 'pusher';
    case Ambusher = 'stalker';
    case Hookmaster = 'hookmaster';
    case Geek = 'geek';
    case Merchant = 'merchant';
    case Trapmaster = 'traper';
    case Dollkeeper = 'dollkeeper';
    // Other
    case OperatorAttachedUnit = 'notchar1';
    case NoClassTrap = 'notchar2';
    case None1 = 'none1';
    case None2 = 'none2';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
