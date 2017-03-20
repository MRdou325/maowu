<?php

// BBS.php
define("ONE_BLOCK", 20);

// Buy.php
define("FRIEND_DISCOVERER", 0);
define("FRIEND_CALLED", 1);
define("FRIEND_PARTICIPATION", 2);
define("FRIEND_DENIAL", 3);
define("FRIEND_END", 4);
define("FRIEND_FADEOUT", 5);

// Item.php
define("ITEM_RISE_NUM", 6);
define("ITEM_RISE_MONEY_BASIC", 10000);

// Collection.php
define("UNIT_INDEX", 10000);
define("MONSTER_INDEX", 20000);

// Friend.php
define("MEMCACHE_SELECT_E_FRIEND", false);
define("DATABASE_SELECT_E_FRIEND", true);
define("USER_SEARCH_LIMIT", 10);
define("USER_LIMIT", 10);

// Gacha.php
define("TYPE_FRIEND", "Friend");
define("TYPE_GOLD", "Gold");
define("TYPE_GOLD11", "Gold11");
define("TYPE_SILVER", "Silver");

// Login.php
define("TUTORIAL_COMPLETE", 7);

// Mission.php
define("MISSION_TEAM_LIMIT", 25);
define("BATTLE_STAGE", 200000);
define("LIMITED_TIME_EPSODE", 400001);
define("STAGE_NORMAL", 1);
define("STAGE_BATTLE", 2);
define("STAGE_EVENT_PVP", 3);
define("STAGE_EVENT_PVC", 4);
define("STAGE_EVENT_TOWER", 5);
define("STAGE_EVENT_LIMITED", 6);
define("STAGE_RAID_BOSS", 7);
define("STAGE_EVENT_ISLAND", 8);
define("STAGE_ERROR", 0);
define("MISSION_WAITTIME", 5);
define("MISSION_EVENT_MONEY", 1);
define("MISSION_EVENT_EXP", 2);
define("MISSION_EVENT_SOUL", 3);
define("MISSION_EVENT_TOPHUNTER", 4);

// Present.php
define("PRESENT_LIST_NUMS", 50);
define('PRESENT_COUNT_MAX', 1000);

// Synthesis.php
define("SYNTHESIS_SPECIAL_START", 19001);
define("SYNTHESIS_SPECIAL_END", 19100);
define("BREAK_RARE_LIMIT", 2);

// UnitList.php
define("CARD_LIST", 0);
define("CARD_UPGRADE_BASIC", 1);
define("CARD_UPGRADE_UNIT", 2);
define("CARD_SELL", 3);
define("CARD_BREAK_BASIC", 4);
define("CARD_RISE_BASIC", 5);
define("CARD_TEAM_LEADER", 6);
define("CARD_TEAM_UNIT", 7);
define("CARD_REFINE", 8);
define("CARD_TEAM_RAIDBOSS_UNIT", 9);

// Trade.php
define("TRADE_PHASE_REQUEST", 1);
define("TRADE_PHASE_REQUEST_WAIT", 2);
define("TRADE_PHASE_RESPONSE", 3);
define("TRADE_PHASE_RESPONSE_WAIT", 4);
define("TRADE_PHASE_PERMIT", 5);
define("TRADE_PHASE_END", 6);
define("TRADE_PHASE_CANCEL", 7);
define("TRADE_PHASE_TIMEOUT", 8);
define("TRADE_LOCK_LEVEL", 30);
define("TRADE_COUNT_LIMIT", 10);
define("TRADE_LIST_LIMIT", 50);
define("TRADE_VIP_LIMIT", 3);

// Tutorial.php
define("TUTORIAL_PHASE_REGIST", 1);
define("TUTORIAL_PHASE_LEADER", 2);
define("TUTORIAL_PHASE_COMPLETE", 3);
define("TUTORIAL_FRINED_REQUEST", 10);

// User.php
define("BRAVE_LIST_NUMS", 20);
define("REINFORCE_LIST_NUMS", 20);
define("BATTLE_LIST_NUMS", 20);

// Gift.php
define("GIFT_MAX_NUMS", 1);

// Event.php
define("EVENT_CEMETERY_NUMS", 10);
define("EVENT_CEMETERY_USER_MAX_NUMS", 30);
define("EVENT_CEMETERY_DEF_HP", 1500);
define("EVENT_ENEMY_LEVEL_MIN", 100);
define("EVENT_LOSE_NUM", 3);

// Legion.php
define("LEGION_TYPE_MISSION", 1);
define("LEGION_TYPE_GROUPBATTLE_SIGNUP", 2);
define("LEGION_TYPE_GROUPBATTLE_SNATCH", 3);
define("LEGION_TYPE_GROUPBATTLE", 4);
define("LEGION_WAR_RANK_TYPE_HISTORY", 1);
define("LEGION_WAR_RANK_TYPE_LASTRANK", 2);
define("LEGION_WAR_RANK_TYPE_KING", 3);
define("LEGION_WAR_RANK_TYPE_GOD", 4);
define("LEGION_WAR_RANK_TYPE_LASTRANK_THREE", 5);

/**
 * * Friend.php **
 */
define('FRIEND_NO', 0);
define('FRIEND_ONESIDE', 1);
define('FRIEND_PAIR', 2);
define('FRIEND_BLACK', 9);
define('FRIEND_TYPE_LIST', 1);
define('FRIEND_TYPE_REQUEST', 2);
define('FRIEND_TYPE_PENDING', 3);
define('FRIEND_TYPE_DREAK', 4);
define('MEMCACHE_SELECT_FRIEND', false);
define('DATABASE_SELECT_FRIEND', true);

/**
 * * Mission.php **
 */
define('START_STAGE', 1);
define('PVC_STAGE_MISSION', 210000);
define('PVP_STAGE_MISSION', 220000);
define('TEST_STAGE', 300000);
define('TOWER_STAGE', 300001);
define('LIMITED_TIME_STAGE', 400001);
define('RAID_BOSS_STAGE', 500001);
define('ISLAND_STAGE', 600001);
define('END_STAGE_NUM', 100000);

/**
 * * Present.php **
 */
define('PRESENT_NO', 0);
define('PRESENT_OVERFLOW', 1);
define('PRESENT_APOLOGIZE', 2);
define('PRESENT_BATTLE', 3);
define('PRESENT_MISSION', 4);
define('PRESENT_SPECIAL', 5);
define('PRESENT_TUTORIAL', 6);
define('PRESENT_LOGINBONUS', 7);
define('PRESENT_GACHABONUS', 8);
define('PRESENT_TRADE', 9);
define('PRESENT_TRADECANCEL', 10);
define('PRESENT_PIECE', 11);
define('PRESENT_OVERFLOW_ITEM', 12);
define('PRESENT_GOLDBOX_ITEM', 13);
define('PRESENT_PRESTIGEBOX_ITEM', 14);
define('PRESENT_PRESTIGE_RANK', 15);
define('PRESENT_PRESTIGE_EXCHANGE', 16);
define('PRESENT_PRESTIGE_EVENT', 17);
define('PRESENT_EVENT', 18);
define('PRESENT_PRESTIGE_GOLDEN_APPLE', 19);
define('PRESENT_PRESTIGE_SLIVER_APPLE', 20);
define('PRESENT_RAIDBOSS_RANKING', 21);
define('PRESENT_RAIDBOSS_BONUS', 22);
define('PRESENT_RAIDBOSS_ACHIEVEMENT', 23);
define('PRESENT_WAR', 24);
define('PRESENT_TYPE_ALL', 0);
define('PRESENT_TYPE_CARD', 1);
define('PRESENT_TYPE_PIECE', 2);
define('PRESENT_TYPE_EQUIP', 3);
define('PRESENT_TYPE_ITEM', 4);
define('PRESENT_TYPE_VIGOR', 5);
define('PRESENT_GIFT', 26);
define('PRESENT_PAY', 27);
define('PRESENT_EQUIPBOX', 28);
define('PRESENT_GACHA11', 29);
define('PRESENT_BATTLE_PVP', 30);
define('PRESENT_BATTLE_TEAM5V5', 31);
define('PRESENT_BRAVE', 32);
define('PRESENT_MINING', 33);
define('PRESENT_WORLDBOSS', 34);
define('PRESENT_MONTHCARD', 35);
define('PRESENT_FUND', 36);
define('PRESENT_EVENT_CEMETERY', 37);
define('PRESENT_LEGION_MISSION', 38);
define('PRESENT_EVENT_FIGHT', 39);
define('PRESENT_EVENT_TAOBAO', 40);
define('PRESENT_TIAOPIAO', 41);
define('PRESENT_MAINTAIN', 42);
define('PRESENT_SEND_DESK', 43);
define('PRESENT_LEGION_AWARD', 45);
define('PRESENT_PAY_REHARGE', 46);
define('PRESENT_CRUSADE', 47);

/**
 * * Cache.php **
 */
define("ENABLE_CACHE", true);

/**
 * * Ranking.php **
 */
define("RANKING_LIST_LIMIT", 20);
define("RANKING_SCORE_YEAR", 1);
define("RANKING_SCORE_MONTH", 2);
define("RANKING_SCORE_WEEK", 3);
define("RANKING_FROM_SYSTEM", 0);
define("RANKING_FROM_MISSION", 1);
define("RANKING_FROM_BATTLE", 2);
define("RANKING_FROM_REWARD", 100);

/**
 * * Battle.php **
 */
define("BATTLE_RESULT_WIN", 1);
define("BATTLE_RESULT_LOSE", 2);
define("BATTLE_TYPE_PVP", 1);
define("BATTLE_TYPE_FIGHT", 2);
define("BATTLE_TYPE_FRIEND", 3);
define("BATTLE_TYPE_PIECE", 4);
define("BATTLE_TYPE_CEMETERY", 5);
define("BATTLE_TYPE_TEAM_5V5", 6);
define("BATTLE_TYPE_CHAT", 7);
define("BATTLE_STATUS_NEW", 0);
define("BATTLE_STATUS_OLD", 1);
define("BATTLE_GM_ID", 100000);

/**
 * * Item.php **
 */
define("ITEM_NORMAL", 1);
define("ITEM_PIECE", 2);
define("ITEM_BOX", 3);
define("ITEM_UPGRADE", 4);
define("ITEM_EVENT", 5);
define("ITEM_EQUIP", 6);
define("ITEM_EQUIP_BASE_LIMIT", 50);

/**
 * * UnitList.php **
 */
define("MAX_UNIT_LIMIT", 50);
define("MAX_UNIT_LIMIT1", 200);
define("TEAM_LIMIT", 25);

/**
 * * Register.php **
 */
define("CHANGE_NAME_COST", 100);

/**
 * * Gacha.php **
 */
define("GACHA_GIVING_MAX_NUM", 100);
define("GACHA_LOG_NUM", 10);
define("GACHA_REWARD11", 25);

/**
 * * Bingo.php **
 */
define("OPEN_BOX_NUM", 10);

/**
 * * RaidBoss.php **
 */
define("RAID_BOSS_COST", 200);
define("RAID_BOSS_RANK_LIMIT", 200);
define("RAID_BOSS_REWARD_LIMIT", 12);

?>
