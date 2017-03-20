<?php
/**
 * Log种类定义 2013-05-15 lizhien
 */
define("LOGTYPE_SYSTEM", 0);
define("LOGTYPE_VIEW", 1);
define("LOGTYPE_ERROR", 2);
define("LOGTYPE_CACHE", 3);
define("LOGTYPE_DB", 4);
define("LOGTYPE_SQLTRACE", 5);
define("LOGTYPE_REGISTER", 6);
define("LOGTYPE_PAYMENT", 7);
define("LOGTYPE_GACHA", 8);
define("LOGTYPE_BRAVE", 9);

define("LOGTYPE_SYNTHESIS", 10);
define("LOGTYPE_DATAMINE", 11);

define("LOGTYPE_MISSION", 12);
define("LOGTYPE_MONEY", 13);
define("LOGTYPE_FRIEND", 14);
define("LOGTYPE_USER", 15);
define("LOGTYPE_ITEM", 16);
define("LOGTYPE_TUTORIAL", 17);
define("LOGTYPE_UNIT", 18);
define("LOGTYPE_TRAINING", 19);
define("LOGTYPE_PRESENT", 20);
define("LOGTYPE_INVITE", 21);
define("LOGTYPE_COLLECTION", 22);
define("LOGTYPE_COLLECTIONITEM", 23);
define("LOGTYPE_TRADE", 24);
define("LOGTYPE_SKILL", 25);
define("LOGTYPE_LOGIN", 26);
define("LOGTYPE_EVENT", 27);
define("LOGTYPE_COMEBACK", 28);
define("LOGTYPE_TRANSMIGRATION", 29);
define("LOGTYPE_BATTLE", 30);
define("LOGTYPE_EVENT_MISSION", 31);
define("LOGTYPE_COMPGACHA", 32);
define("LOGTYPE_COMPGACHA_STATE", 33);
define("LOGTYPE_PLAYERVS", 34);
define("LOGTYPE_PLAYERVS_EVENT", 35);
define("LOGTYPE_INVITE_ID", 36);
define("LOGTYPE_SERIALCODE", 37);
define("LOGTYPE_CONQUEST_EVENT", 38);
define("LOGTYPE_RAIDBOSS_EVENT", 39);
define("LOGTYPE_TOWER_EVENT", 40);
define("LOGTYPE_STARFLOWER_EVENT", 41);
define("LOGTYPE_COLLABORATION", 42);
define("LOGTYPE_REWARD", 43);
define("LOGTYPE_ARENA_EVENT", 44);
define("LOGTYPE_LOGIN_BINGO", 45);
define("LOGTYPE_TOURNAMENT_EVENT", 46);
define("LOGTYPE_RECYCLE", 47);
define("LOGTYPE_MONSTER_WALK", 48);
define("LOGTYPE_SELL", 49);
define("LOGTYPE_TITLE", 50);
define("LOGTYPE_TOURNAMENT_RESULT", 51);
define("LOGTYPE_ENCRYPTED_TIME", 52);
define("LOGTYPE_MACHINE", 53);

define("LOGTYPE_DB_PERFORMANCE", 98);
define("LOGTYPE_PARAMCACHE", 99);
define("LOGTYPE_ACCESS", 100);
define("LOGTYPE_PHP_ERROR", 101);
define("LOGTYPE_ETC", 102);
define("LOGTYPE_CHEAT", 103);
define("LOGTYPE_DEBUG", 104);
define("LOGTYPE_TIMEOUT", 105);
define("LOGTYPE_MANUALSENDPRESENT", 106);

$LogSetting = array(
	LOGTYPE_SYSTEM => array(
		"Name" => "system", 
		"Header" => "" 
	), 
	LOGTYPE_VIEW => array(
		"Name" => "view", 
		"Header" => "" 
	), 
	LOGTYPE_ERROR => array(
		"Name" => "error", 
		"Header" => "ErrorMessage" 
	), 
	LOGTYPE_CACHE => array(
		"Name" => "cache", 
		"Header" => "" 
	), 
	LOGTYPE_DB => array(
		"Name" => "db_error", 
		"Header" => "ErrorMessage"
	), 
	LOGTYPE_SQLTRACE => array(
		"Name" => "sql_trace", 
		"Header" => "" 
	), 
	LOGTYPE_REGISTER => array(
		"Name" => "register", 
		"Header" => "Name, Verified" 
	), 
	LOGTYPE_PAYMENT => array(
		"Name" => "payment", 
		"Header" => "ItemID, Amount, TransactionID, Price, ApiTarget, ErrorMessage" 
	), 
	LOGTYPE_GACHA => array(
		"Name" => "gacha", 
		"Header" => "GachaType, Amount, UnitID, BeforeBrave, AfterBrave, ErrorMessage, ItemId, Price" 
	), 
	LOGTYPE_BRAVE => array(
		"Name" => "brave", 
		"Header" => "Target, AddBrave" 
	), 
	
	LOGTYPE_SYNTHESIS => array(
		"Name" => "synthesis", 
		"Header" => "BaseUniqueID, BaseUnitID, BaseRare, MaterialCount, MaterialIndex, MaterialUniqueID, MaterialUnitID, MaterialRare, MaterialLevel, MaterialExp, BeforeLevel, BeforeExp, Level, Exp, SynthesisExp, AddExp, LevelUp, Cost, Money, ErrorMessage" 
	), 
	LOGTYPE_DATAMINE => array(
		"Name" => "datamine", 
		"Header" => "" 
	), 
	
	LOGTYPE_MISSION => array(
		"Name" => "quest", 
		"Header" => "Mission, HealItem, Result, NewMission1, NewMission2, NewMission3, NewMission4, NewMission5, NewMission6, NewMission7, NewMission8, NewMission9, NewMission10, Friend1, Friend2, Friend3, Friend4, Friend5, Friend6, Friend7, Friend8, Friend9, Friend10, ErrorMessage" 
	), 
	LOGTYPE_MONEY => array(
		"Name" => "money", 
		"Header" => "" 
	), 
	LOGTYPE_FRIEND => array(
		"Name" => "friend", 
		"Header" => "" 
	), 
	LOGTYPE_USER => array(
		"Name" => "user", 
		"Header" => "" 
	), 
	LOGTYPE_ITEM => array(
		"Name" => "item", 
		"Header" => "UserAction, ItemID, Count, BeforeAmount, Amount, Route, PresentType, ErrorMessage" 
	), 
	LOGTYPE_TUTORIAL => array(
		"Name" => "tutorial", 
		"Header" => "Phase, Name, Leader, Units" 
	), 
	LOGTYPE_UNIT => array(
		"Name" => "unit", 
		"Header" => "Target, UserAction, UnitDesc, UniqueID, UnitID, Level, LevelMax, Exp, BeforeLevel, BeforeLevelMax, BeforeExp, Rare, UniqueID, ErrorMessage" 
	), 
	LOGTYPE_TRAINING => array(
		"Name" => "training", 
		"Header" => "Mission, MissionSub, WithGo, Move, MoveMax, Event, Boss, Result, ErrorMessage" 
	), 
	LOGTYPE_PRESENT => array(
		"Name" => "present", 
		"Header" => "ID, Item, Type, Index, Sender, TypeString, Rank" 
	), 
	LOGTYPE_INVITE => array(
		"Name" => "invite", 
		"Header" => "" 
	), 
	LOGTYPE_COLLECTION => array(
		"Name" => "collection", 
		"Header" => "" 
	), 
	LOGTYPE_COLLECTIONITEM => array(
		"Name" => "collectionitem", 
		"Header" => "BattleTarget, Series, Type, Complete, BattleCount, BattleOk" 
	), 
	LOGTYPE_TRADE => array(
		"Name" => "trade", 
		"Header" => "TargetId, Items, GroupId, Item1Id, Item1Amount, Item1Level, Item1Exp, Item1Signature, Item2Id, Item2Amount, Item2Level, Item2Exp, Item2Signature, Item3Id, Item3Amount, Item3Level, Item3Exp, Item3Signature, Item4Id, Item4Amount, Item4Level, Item4Exp, Item4Signature, Item5Id, Item5Amount, Item5Level, Item5Exp, Item5Signature, ErrorMessage" 
	), 
	LOGTYPE_SKILL => array(
		"Name" => "skill", 
		"Header" => "Type, Level, NeedMoney, Money, NeedBond, Bond, Condition1, Condition2, Condition3, SkillValue, ErrorMessage" 
	), 
	LOGTYPE_LOGIN => array(
		"Name" => "login", 
		"Header" => "Name" 
	), 
	LOGTYPE_EVENT => array(
		"Name" => "event", 
		"Header" => "Type" 
	), 
	LOGTYPE_COMEBACK => array(
		"Name" => "comeback", 
		"Header" => "Target, Part, Status" 
	), 
	LOGTYPE_TRANSMIGRATION => array(
		"Name" => "transmigration", 
		"Header" => "UniqueID, MonsterID, MonsterSignature, UnitID, UnitSignature, HighStone, LowStone, Percent, Cost, Status" 
	), 
	LOGTYPE_BATTLE => array(
		"Name" => "battle", 
		"Header" => "Mission, HealItem, Result, NewMission1, NewMission2, NewMission3, NewMission4, NewMission5, NewMission6, NewMission7, NewMission8, NewMission9, NewMission10, Friend1, Friend2, Friend3, Friend4, Friend5, Friend6, Friend7, Friend8, Friend9, Friend10, ErrorMessage" 
	), 
	LOGTYPE_EVENT_MISSION => array(
		"Name" => "event_quest", 
		"Header" => "Mission, HealItem, Result, NewMission1, NewMission2, NewMission3, NewMission4, NewMission5, NewMission6, NewMission7, NewMission8, NewMission9, NewMission10, Friend1, Friend2, Friend3, Friend4, Friend5, Friend6, Friend7, Friend8, Friend9, Friend10, ErrorMessage" 
	), 
	LOGTYPE_COMPGACHA => array(
		"Name" => "compgacha", 
		"Header" => "Command, Series, UnitID, ItemID, PrivilegeUnitID" 
	), 
	LOGTYPE_COMPGACHA_STATE => array(
		"Name" => "compgacha_state", 
		"Header" => "Series, Complete, CompUnit..." 
	), 
	LOGTYPE_PLAYERVS => array(
		"Name" => "playervs", 
		"Header" => "Target, TargetSeries, TargetType, Reserved, BattleCount, IsPvLimit" 
	), 
	LOGTYPE_PLAYERVS_EVENT => array(
		"Name" => "playervs_event", 
		"Header" => "Command, PresetId, Target, Point, WinCount, Money, Exp, Present, RewardPoint, ItemId, Amount, Area_ID, Mission" 
	), 
	LOGTYPE_INVITE_ID => array(
		"Name" => "invite_id", 
		"Header" => "Input" 
	), 
	LOGTYPE_SERIALCODE => array(
		"Name" => "serialcode", 
		"Header" => "Type, Status, Present, SerialCode, TableIndex" 
	), 
	LOGTYPE_CONQUEST_EVENT => array(
		"Name" => "conquest", 
		"Header" => "Command, Panel, RewardPoint, RewardItem, RewardAmount, PrivatePoint, GlobalPoint, GetPoint, RoundNumberIdentifier" 
	), 
	LOGTYPE_RAIDBOSS_EVENT => array(
		"Name" => "raidboss", 
		"Header" => "Comment, BeforePoint, AfterPoint, ItemID, BeforeItem, AfterItem, Result, FriendID, BossID, Time" 
	), 
	LOGTYPE_TOWER_EVENT => array(
		"Name" => "tower", 
		"Header" => "Command, Floor, RewardItem, Amount" 
	), 
	LOGTYPE_STARFLOWER_EVENT => array(
		"Name" => "star_flower", 
		"Header" => "Command, RewardItem, RewardAmount, AddPoint, BeforePoint, AfterPoint, GirlIndex, TotalPoint" 
	), 
	LOGTYPE_COLLABORATION => array(
		"Name" => "collaboration", 
		"Header" => "Comment, AppId, FromId, Term, Status, Val1" 
	), 
	LOGTYPE_REWARD => array(
		"Name" => "reward", 
		"Header" => "RewardID, ItemId, Amount, Level, Exp" 
	), 
	LOGTYPE_ARENA_EVENT => array(
		"Name" => "arena", 
		"Header" => "Command" 
	), 
	LOGTYPE_TOURNAMENT_EVENT => array(
		"Name" => "tournament", 
		"Header" => "Kind, Result, TargetID, BeforePoint, AfterPoint, Win, TimeStamp, UserExp, UnitExp, GetLuna" 
	), 
	LOGTYPE_TOURNAMENT_RESULT => array(
		"Name" => "tournament_result", 
		"Header" => "Target, NPC, Unit1, Unit2, Unit3, Unit4, Unit5, Unit6, Unit7, EUnit1, EUnit2, EUnit3, EUnit4, EUnit5, EUnit6, EUnit7" 
	), 
	LOGTYPE_ENCRYPTED_TIME => array(
		"Name" => "encrypted", 
		"Header" => "Comment, Time" 
	), 
	LOGTYPE_LOGIN_BINGO => array(
		"Name" => "login_bingo", 
		"Header" => "Type, Offset, ItemId, ItemAmount, BingoCount, CompleteCount, PushCount" 
	), 
	LOGTYPE_RECYCLE => array(
		"Name" => "recycle", 
		"Header" => "UserAction, RecycleType, GetItemID, GetItemAmount, RecyclePoint, BeforeRecyclePoint" 
	), 
	LOGTYPE_MONSTER_WALK => array(
		"Name" => "monster_walk", 
		"Header" => "UniqueId, StartTime, EndTime, UseBoost, Result, Border1, Border2, Border3, HealTime, Exp, ErrorMessage" 
	), 
	LOGTYPE_SELL => array(
		"Name" => "sell", 
		"Header" => "Price, BeforeMoney, Money" 
	), 
	LOGTYPE_TITLE => array(
		"Name" => "title", 
		"Header" => "UserAction, TitleID, Title, ItemId, Price, BeforeAmount, Amount, EventID, EventSubID" 
	), 
	LOGTYPE_MACHINE => array(
		"Name" => "machine", 
		"Header" => "MachineName, Hardware, OS, OSVersion, ScreenWidth, ScreenHeight, MemorySize, ScreenUnits, ScreenPixelUnits, ClientVersion" 
	), 
	
	LOGTYPE_DB_PERFORMANCE => array(
		"Name" => "db_performance", 
		"Header" => "AccessTime, DBRate, DBDesc, Query, Trace" 
	), 
	LOGTYPE_PARAMCACHE => array(
		"Name" => "paramcache", 
		"Header" => "Identifier, Table, Query" 
	), 
	LOGTYPE_ACCESS => array(
		"Name" => "access", 
		"Header" => "AccessTime, Request/Response" 
	), 
	LOGTYPE_PHP_ERROR => array(
		"Name" => "php_error", 
		"Header" => "" 
	), 
	LOGTYPE_ETC => array(
		"Name" => "etc", 
		"Header" => "" 
	), 
	LOGTYPE_CHEAT => array(
		"Name" => "cheat", 
		"Header" => "Message1, Message2" 
	), 
	LOGTYPE_DEBUG => array(
		"Name" => "debug", 
		"Header" => "Other" 
	), 
	LOGTYPE_TIMEOUT => array(
		"Name" => "timeout", 
		"Header" => "Other" 
	), 
	LOGTYPE_MANUALSENDPRESENT => array(
		"Name" => "manualSendPresent", 
		"Header" => "Other"
	) 
);

?>
