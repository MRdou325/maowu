<?php

/**
 * lizhien 20130615 LogDB
 */
namespace LogDB;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (PROJECT_PATH . "/framework/DBManager.php");
require_once (PROJECT_PATH . "/framework/Utility.php");

define("LOGDB_ENABLE_SHARD1", false);
define("LOGDB_SHARD1_BASE", 1);
define("LOGDB_SHARD1_COUNT_MAX", 2);
define("LOGDB_ENABLE_SHARD2", false);
define("LOGDB_SHARD2_BASE", 2);
define("LOGDB_SHARD2_COUNT_MAX", 2);

define("LOGDB_TRACE", 1);
define("LOGDB_DEBUG", 2);
define("LOGDB_PAYMENT", 3);
define("LOGDB_INFO", 4);
define("LOGDB_WARNING", 5);
define("LOGDB_ERROR", 6);

define("LOGDB_ENABLE_ERROR", false);
define("LOGDB_ENABLE_ACCESS", false);
define("LOGDB_ENABLE_REGISTER", false);
define("LOGDB_ENABLE_PAYMENT", true);
define("LOGDB_ENABLE_GACHA", true);
define("LOGDB_ENABLE_BRAVE", false);
define("LOGDB_ENABLE_SYNTHESIS", false);
define("LOGDB_ENABLE_QUEST", false);
define("LOGDB_ENABLE_BATTLE", true);
define("LOGDB_ENABLE_EVENTQUEST", false);
define("LOGDB_ENABLE_HANDSHAKE", true);
define("LOGDB_ENABLE_ITEM", true);
define("LOGDB_ENABLE_PRESENT", true);
define("LOGDB_ENABLE_TUTORIAL", false);
define("LOGDB_ENABLE_UNIT", false);
define("LOGDB_ENABLE_EXTUNIT", true);
define("LOGDB_ENABLE_TRAINING", false);
define("LOGDB_ENABLE_INVITE", false);
define("LOGDB_ENABLE_COLLECTIONITEM", false);
define("LOGDB_ENABLE_TRADE", true);
define("LOGDB_ENABLE_SKILL", false);
define("LOGDB_ENABLE_LOGIN", true);
define("LOGDB_ENABLE_LOGIN_BINGO", true);
define("LOGDB_ENABLE_COMEBACK", false);
define("LOGDB_ENABLE_TRANSMIGRATION", false);
define("LOGDB_ENABLE_COMPGACHA", false);
define("LOGDB_ENABLE_COMPGACHASTATE", false);
define("LOGDB_ENABLE_PLAYERVS", false);
define("LOGDB_ENABLE_PLAYERVSEVENT", true);
define("LOGDB_ENABLE_INVITEID", false);
define("LOGDB_ENABLE_SERIALCODE", false);
define("LOGDB_ENABLE_CONQUEST", true);
define("LOGDB_ENABLE_RAIDBOSS", true);
define("LOGDB_ENABLE_TOWER", true);
define("LOGDB_ENABLE_STARFLOWER", true);
define("LOGDB_ENABLE_COLLABORATION", true);
define("LOGDB_ENABLE_REWARD", false);
define("LOGDB_ENABLE_MONEY", true);

define("LOGDB_ENABLE_TOURNAMENT", true);
define("LOGDB_ENABLE_RECYCLE", false);
define("LOGDB_ENABLE_MONSTER_WALK", false);
define("LOGDB_ENABLE_SELL", false);
define("LOGDB_ENABLE_TITLE", false);
define("LOGDB_ENABLE_MACHINE", false);

define("LOGDB_ENABLE_PARAMCACHE", false);
define("LOGDB_ENABLE_TEXTLOG", false);
define("LOGDB_ENABLE_CHEAT", false);
define("LOGDB_TEXTLOG_SANDBOX_ONLY", false);
define("LOGDB_TEXTLOG_ADMIN_ONLY", false);

function Error($type, $file, $line, $sub_category, $message)
{
	if(!LOGDB_ENABLE_ERROR)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO error (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Message) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $message);
}

function Access($type, $file, $line, $sub_category, $access_time, $data)
{
	if(!LOGDB_ENABLE_ACCESS)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	// if(APIMODE !== APIMODE_SANDBOX)
	{
		if(!LOG_OUTPUT_DB_ACCESS_DATA_ENABLE)
		{
			$data = "";
		}
		if(LOG_OUTPUT_DB_ACCESS_DATA_REQUEST_ONLY && ($sub_category != "Request"))
		{
			$data = "";
		}
	}
	$date = date("d");
	$table = "access" . $date;
	$data = urldecode($data);
	$query = sprintf("INSERT INTO %s (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, AccessTime, Data) VALUES (NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', %s, '%s')", $table, $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $access_time, $data);
	\DB\QueryWithStrage($common["server2"], $query);
}

function Register($type, $file, $line, $sub_category, $name, $verified)
{
	if(!LOGDB_ENABLE_REGISTER)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO register (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Name, Verified) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $name, $verified);
}

function Payment($type, $file, $line, $sub_category, $item_id, $amount, $transaction_id, $price, $api_target, $error_message)
{
	if(!LOGDB_ENABLE_PAYMENT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO payment (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, ItemID, Amount, TransactionID, Price, ApiTarget, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $item_id, $amount, $transaction_id, $price, $api_target, $error_message);
}

function Gacha($type, $file, $line, $sub_category, $gacha_type, $amount, $unit_data, $before_brave, $after_brave, $error_message, $item_id = 0, $price = 0)
{
	if(!LOGDB_ENABLE_GACHA)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$count = count($unit_data);
	$query = "";
	if($count > 0)
	{
		$index = 1;
		foreach($unit_data as $data)
		{
			$unit_id = $data["UnitId"];
			$rare = $data["Rare"];
			$signature = 0;
			$target = $data["Target"];
			if($target == "Box")
			{
				$signature = 0;
			}
			$linedata = sprintf("(NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', '%s', %s, %s, %s, %s, %s, '%s', %s, %s, '%s', %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $gacha_type, $amount, $index, $unit_id, $rare, $signature, $target, $before_brave, $after_brave, $error_message, $item_id, $price);
			if($index > 1)
			{
				$query .= ",";
			}
			$query .= $linedata;
			$index++;
		}
	}
	else
	{
		$query = sprintf("(NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', '%s', %s, %s, %s, %s, %s, '%s', %s, %s, '%s', %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $gacha_type, $amount, 1, 0, 0, 0, "", $before_brave, $after_brave, $error_message, $item_id, $price);
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO gacha (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, GachaType, Amount, UnitIndex, UnitID, Rare, Signature, Target, BeforeBrave, AfterBrave, ErrorMessage, ItemId, Price) VALUES $query");
}

function Brave($type, $file, $line, $sub_category, $target, $add_brave)
{
	if(!LOGDB_ENABLE_BRAVE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO brave (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Target, AddBrave) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target, $add_brave);
}

function Synthesis($type, $file, $line, $sub_category, $base_unique_id, $base_unit_id, $base_rare, $material_unit, $before_level, $before_exp, $level, $exp, $synthesis_exp, $add_exp, $level_up, $cost, $money, $error_message)
{
	if(!LOGDB_ENABLE_SYNTHESIS)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$count = count($material_unit);
	$query = "";
	if($count > 0)
	{
		$index = 1;
		foreach($material_unit as $data)
		{
			$material_unique_id = $data["UniqueID"];
			$material_unit_id = $data["UnitID"];
			$material_rare = $data["Rare"];
			$material_level = $data["Level"];
			$material_exp = $data["Exp"];
			$linedata = sprintf("(NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '%s')", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $base_unique_id, $base_unit_id, $base_rare, $count, $index, $material_unique_id, $material_unit_id, $material_rare, $material_level, $material_exp, $before_level, $before_exp, $level, $exp, $synthesis_exp, $add_exp, $level_up, $cost, $money, $error_message);
			if($index > 1)
			{
				$query .= ",";
			}
			$query .= $linedata;
			$index++;
		}
	}
	else
	{
		$query = sprintf("(NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '%s')", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $base_unique_id, $base_unit_id, $base_rare, 0, 0, 0, 0, 0, 0, 0, $before_level, $before_exp, $level, $exp, $synthesis_exp, $add_exp, $level_up, $cost, $money, $error_message);
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO synthesis (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, BaseUniqueID, BaseUnitID, BaseRare, MaterialCount, MaterialIndex, MaterialUniqueID, MaterialUnitID, MaterialRare, MaterialLevel, MaterialExp, BeforeLevel, BeforeExp, Level, Exp, SynthesisExp, AddExp, LevelUp, Cost, Money, ErrorMessage) VALUES $query");
}

function Quest($type, $file, $line, $sub_category, $stage, $heal_item, $result, $new_stages, $friends, $error_message)
{
	if(!LOGDB_ENABLE_QUEST)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	if(is_null($new_stages))
	{
		$new_stages = array();
	}
	if(is_null($friends))
	{
		$friends = array();
	}
	for($i = 0; $i < 10; $i++)
	{
		if(array_key_exists($i, $new_stages) == false)
		{
			$new_stages[$i] = 0;
		}
		if(array_key_exists($i, $friends) == false)
		{
			$friends[$i] = 0;
		}
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO quest (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Stage, HealItem, Result, NewStage1, NewStage2, NewStage3, NewStage4, NewStage5, NewStage6, NewStage7, NewStage8, NewStage9, NewStage10, Friend1, Friend2, Friend3, Friend4, Friend5, Friend6, Friend7, Friend8, Friend9, Friend10, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $stage, $heal_item, $result, $new_stages[0], $new_stages[1], $new_stages[2], $new_stages[3], $new_stages[4], $new_stages[5], $new_stages[6], $new_stages[7], $new_stages[8], $new_stages[9], $friends[0], $friends[1], $friends[2], $friends[3], $friends[4], $friends[5], $friends[6], $friends[7], $friends[8], $friends[9], $error_message);
}

function Battle($type, $file, $line, $sub_category, $battletype = 0, $target = 0, $score = 0, $money = 0, $brave = 0, $result = 0, $error_message = null)
{
	if(!LOGDB_ENABLE_BATTLE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO battle (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, BattleType, Target, Score, Money, Brave, Result, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $battletype, $target, $score, $money, $brave, $result, $error_message);
}

function EventQuest($type, $file, $line, $sub_category, $stage, $heal_item, $result, $new_stages, $friends, $error_message)
{
	if(!LOGDB_ENABLE_EVENTQUEST)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	if(is_null($new_stages))
	{
		$new_stages = array();
	}
	if(is_null($friends))
	{
		$friends = array();
	}
	for($i = 0; $i < 10; $i++)
	{
		if(array_key_exists($i, $new_stages) == false)
		{
			$new_stages[$i] = 0;
		}
		if(array_key_exists($i, $friends) == false)
		{
			$friends[$i] = 0;
		}
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO event_quest (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Stage, HealItem, Result, NewStage1, NewStage2, NewStage3, NewStage4, NewStage5, NewStage6, NewStage7, NewStage8, NewStage9, NewStage10, Friend1, Friend2, Friend3, Friend4, Friend5, Friend6, Friend7, Friend8, Friend9, Friend10, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $stage, $heal_item, $result, $new_stages[0], $new_stages[1], $new_stages[2], $new_stages[3], $new_stages[4], $new_stages[5], $new_stages[6], $new_stages[7], $new_stages[8], $new_stages[9], $friends[0], $friends[1], $friends[2], $friends[3], $friends[4], $friends[5], $friends[6], $friends[7], $friends[8], $friends[9], $error_message);
}

function HandShake($type, $file, $line, $sub_category, $user_status)
{
	if(!LOGDB_ENABLE_HANDSHAKE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO handshake (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UserStatus) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $user_status);
}

function Item($type, $file, $line, $sub_category, $item_action, $item_id, $count, $before_amount, $amount, $route, $present_type, $error_message)
{
	if(!LOGDB_ENABLE_ITEM)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$type_string = GetType($type);
	$file = basename($file);
	$ip_address = $_SERVER["REMOTE_ADDR"];
	$token = \GetParam("Token");
	$identifier = \utl\getGuid();
	$command = \GetParam("command");
	$action = \GetParam("action");
	\DB\QueryWithStrage($common["server"], "INSERT INTO item (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, ItemAction, ItemID, Count, BeforeAmount, Amount, Route, PresentType, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $item_action, $item_id, $count, $before_amount, $amount, $route, $present_type, $error_message);
}

function Item_Cron($type, $identifier, $file, $line, $sub_category, $item_action, $item_id, $count, $before_amount, $amount, $route, $present_type, $error_message)
{
	if(!LOGDB_ENABLE_ITEM)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$type_string = GetType($type);
	$file = basename($file);
	$ip_address = $_SERVER["REMOTE_ADDR"];
	$token = \GetParam("Token");
	$command = \GetParam("command");
	$action = \GetParam("action");
	\DB\QueryWithStrage($common["server"], "INSERT INTO item (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, ItemAction, ItemID, Count, BeforeAmount, Amount, Route, PresentType, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $identifier, $common["file"], $line, $common["command"], $common["action"], $sub_category, $item_action, $item_id, $count, $before_amount, $amount, $route, $present_type, $error_message);
}

function Present($type, $file, $line, $sub_category, $id, $item_id, $amount, $level, $exp, $present_type, $index, $sender, $present_type_string, $rank, $event_category = 0, $before_amount = 0)
{
	if(!LOGDB_ENABLE_PRESENT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO present (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Id, ItemId, BeforeAmount, Amount, Level, Exp, PresentType, PresentIndex, Sender, TypeString, Rank, EventCategory) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $id, $item_id, $before_amount, $amount, $level, $exp, $present_type, $index, $sender, $present_type_string, $rank, $event_category);
}

function Present_Cron($type, $identifier, $file, $line, $sub_category, $id, $item_id, $amount, $level, $exp, $present_type, $index, $sender, $present_type_string, $rank, $event_category = 0, $before_amount = 0)
{
	if(!LOGDB_ENABLE_PRESENT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO present (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Id, ItemId, BeforeAmount, Amount, Level, Exp, PresentType, PresentIndex, Sender, TypeString, Rank, EventCategory) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $identifier, $common["file"], $line, $common["command"], $common["action"], $sub_category, $id, $item_id, $before_amount, $amount, $level, $exp, $present_type, $index, $sender, $present_type_string, $rank, $event_category);
}

function Tutorial($type, $file, $line, $sub_category, $phase, $name, $leader, $units)
{
	if(!LOGDB_ENABLE_TUTORIAL)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO tutorial (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Phase, Name, Leader, Units) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $phase, $name, $leader, $units);
}

function Unit($type, $file, $line, $sub_category, $target, $user_action, $desc, $unique_id, $unit_id, $level, $level_max, $exp, $before_level, $before_level_max, $before_exp, $rare, $signature, $error_message)
{
	if(!LOGDB_ENABLE_UNIT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO unit (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Target, UserAction, UnitDesc, UniqueID, UnitID, Level, LevelMax, Exp, BeforeLevel, BeforeLevelMax, BeforeExp, Rare, Signature, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target, $user_action, $desc, $unique_id, $unit_id, $level, $level_max, $exp, $before_level, $before_level_max, $before_exp, $rare, $signature, $error_message);
}

function Training($type, $file, $line, $sub_category, $stage, $stage_sub, $use_point, $before_move, $after_move, $max_move, $boss_id, $result, $event, $error_message)
{
	if(!LOGDB_ENABLE_TRAINING)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO training (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Stage, StageSub, UsePoint, BeforeMove, AfterMove, MaxMove, BossId, Result, Event, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $stage, $stage_sub, $use_point, $before_move, $after_move, $max_move, $boss_id, $result, $event, $error_message);
}

function Invite($type, $file, $line, $sub_category, $send, $activate, $error_message)
{
	if(!LOGDB_ENABLE_INVITE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO invite (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Send, Activate, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $send, $activate, $error_message);
}

function CollectionItem($type, $file, $line, $sub_category, $battle_target, $series, $item_type, $complete, $battle_count, $battle_ok)
{
	if(!LOGDB_ENABLE_COLLECTIONITEM)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO collection_item (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, BattleTarget, Series, ItemType, Complete, BattleCount, BattleOk) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $battle_target, $series, $item_type, $complete, $battle_count, $battle_ok);
}

function Trade($type, $file, $line, $sub_category, $target_id, $items, $group_id, $item_list, $error_message)
{
	if(!LOGDB_ENABLE_TRADE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	for($i = 0; $i < 5; $i++)
	{
		if(array_key_exists($i, $item_list) == false)
		{
			$item_list[$i] = array();
		}
		if(array_key_exists("ItemId", $item_list[$i]) == false)
		{
			$item_list[$i]["ItemId"] = 0;
		}
		if(array_key_exists("ItemAmount", $item_list[$i]) == false)
		{
			$item_list[$i]["ItemAmount"] = 0;
		}
		if(array_key_exists("ItemLevel", $item_list[$i]) == false)
		{
			$item_list[$i]["ItemLevel"] = 0;
		}
		if(array_key_exists("ItemExp", $item_list[$i]) == false)
		{
			$item_list[$i]["ItemExp"] = 0;
		}
		if(array_key_exists("ItemSignature", $item_list[$i]) == false)
		{
			$item_list[$i]["ItemSignature"] = 0;
		}
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO trade (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, TargetId, Items, GroupId, Item1Id, Item1Amount, Item1Level, Item1Exp, Item1Signature, Item2Id, Item2Amount, Item2Level, Item2Exp, Item2Signature, Item3Id, Item3Amount, Item3Level, Item3Exp, Item3Signature, Item4Id, Item4Amount, Item4Level, Item4Exp, Item4Signature, Item5Id, Item5Amount, Item5Level, Item5Exp, Item5Signature, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target_id, $items, $group_id, $item_list[0]["ItemId"], $item_list[0]["ItemAmount"], $item_list[0]["ItemLevel"], $item_list[0]["ItemExp"], $item_list[0]["ItemSignature"], $item_list[1]["ItemId"], $item_list[1]["ItemAmount"], $item_list[1]["ItemLevel"], $item_list[1]["ItemExp"], $item_list[1]["ItemSignature"], $item_list[2]["ItemId"], $item_list[2]["ItemAmount"], $item_list[2]["ItemLevel"], $item_list[2]["ItemExp"], $item_list[2]["ItemSignature"], $item_list[3]["ItemId"], $item_list[3]["ItemAmount"], $item_list[3]["ItemLevel"], $item_list[3]["ItemExp"], $item_list[3]["ItemSignature"], $item_list[4]["ItemId"], $item_list[4]["ItemAmount"], $item_list[4]["ItemLevel"], $item_list[4]["ItemExp"], $item_list[4]["ItemSignature"], $error_message);
}

function Skill($type, $file, $line, $sub_category, $skill_type, $level, $need_money, $money, $need_bond, $bond, $condition1, $condition2, $condition3, $skill_value, $error_message)
{
	if(!LOGDB_ENABLE_SKILL)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO skill (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, SkillType, Level, NeedMoney, Money, NeedBond, Bond, Condition1, Condition2, Condition3, SkillValue, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $skill_type, $level, $need_money, $money, $need_bond, $bond, $condition1, $condition2, $condition3, $skill_value, $error_message);
}

function Login($type, $file, $line, $sub_category, $name, $status)
{
	if(!LOGDB_ENABLE_LOGIN)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO login (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Name, Status) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $name, $status);
}

function BingoLogin($type, $file, $line, $sub_category, $BingoType, $Offset, $ItemId, $ItemAmt, $BingoCnt, $CompCnt, $PushCnt, $error_message)
{
	if(!LOGDB_ENABLE_LOGIN_BINGO)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO login_bingo (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, " . "BingoType, Offset, Reward, RewardCount, BingoCount, CompleteCount, PushCount, ErrorMessage)" . " VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, " . "%s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $BingoType, $Offset, $ItemId, $ItemAmt, $BingoCnt, $CompCnt, $PushCnt, $error_message);
}

function Comeback($type, $file, $line, $sub_category, $target, $part, $status)
{
	if(!LOGDB_ENABLE_COMEBACK)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO comeback (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Target, Part, Status) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target, $part, $status);
}

function Transmigration($type, $file, $line, $sub_category, $unique_id, $monster_id, $monster_signature, $unit_id, $unit_signature, $high_stone, $low_stone, $percent, $cost, $status)
{
	if(!LOGDB_ENABLE_TRANSMIGRATION)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO transmigration (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UniqueID, MonsterID, MonsterSignature, UnitID, UnitSignature, HighStone, LowStone, Percent, Cost, Status) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $unique_id, $monster_id, $monster_signature, $unit_id, $unit_signature, $high_stone, $low_stone, $percent, $cost, $status);
}

function CompGacha($type, $file, $line, $sub_category, $series, $unit_id, $item_id, $privilege_unit_id)
{
	if(!LOGDB_ENABLE_COMPGACHA)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO compgacha (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Series, UnitID, ItemID, PrivilegeUnitID) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $series, $unit_id, $item_id, $privilege_unit_id);
}

function CompGachaState($type, $file, $line, $sub_category, $series, $complete, $unit)
{
	if(!LOGDB_ENABLE_COMPGACHASTATE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO compgacha_state (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Series, Complete, Unit1, Unit2, Unit3, Unit4, Unit5, Unit6, Unit7, Unit8, Unit9, Unit10, Unit11, Unit12, Unit13, Unit14, Unit15, Unit16, Unit17, Unit18, Unit19, Unit20, Unit21, Unit22, Unit23, Unit24, Unit25) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $series, $complete, $unit[0], $unit[1], $unit[2], $unit[3], $unit[4], $unit[5], $unit[6], $unit[7], $unit[8], $unit[9], $unit[10], $unit[11], $unit[12], $unit[13], $unit[14], $unit[15], $unit[16], $unit[17], $unit[18], $unit[19], $unit[20], $unit[21], $unit[22], $unit[23], $unit[24], $unit[25]);
}

function PlayerVs($type, $file, $line, $sub_category, $target, $target_series, $target_type, $battle_count, $is_pv_limit)
{
	if(!LOGDB_ENABLE_PLAYERVS)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO playervs (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Target, TargetSeries, TargetType, BattleCount, IsPvLimit) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target, $target_series, $target_type, $battle_count, $is_pv_limit);
}

function PlayerVsEvent($type, $file, $line, $sub_category, $preset_id, $target, $point, $win_count, $money, $exp, $present, $reward_point, $item_id, $amount, $area_id, $stage, $formation, $friends, $target_formation, $target_friends)
{
	if(!LOGDB_ENABLE_PLAYERVSEVENT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	if(is_null($formation))
	{
		$formation = array();
	}
	if(is_null($target_formation))
	{
		$target_formation = array();
	}
	for($i = 0; $i < 5; $i++)
	{
		if(array_key_exists($i, $formation) == false)
		{
			$formation[$i]["UnitId"] = 0;
			$formation[$i]["UnitLevel"] = 0;
		}
		if(array_key_exists($i, $target_formation) == false)
		{
			$target_formation[$i]["UnitId"] = 0;
			$target_formation[$i]["UnitLevel"] = 0;
		}
	}
	if(is_null($friends))
	{
		$friends = array();
	}
	if(array_key_exists(0, $friends) == false)
	{
		$friends[0] = 0;
	}
	if(array_key_exists(1, $friends) == false)
	{
		$friends[1] = 0;
	}
	if(is_null($target_friends))
	{
		$target_friends = array();
	}
	if(array_key_exists(0, $target_friends) == false)
	{
		$target_friends[0] = 0;
	}
	if(array_key_exists(1, $target_friends) == false)
	{
		$target_friends[1] = 0;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO playervs_event (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, PresetId, Target, Point, WinCount, Money, Exp, Present, RewardPoint, ItemId, Amount, Area_ID, Stage, Unit1Id, Unit1Level, Unit2Id, Unit2Level, Unit3Id, Unit3Level, Unit4Id, Unit4Level, Unit5Id, Unit5Level, Friend1, Friend2, TargetUnit1Id, TargetUnit1Level, TargetUnit2Id, TargetUnit2Level, TargetUnit3Id, TargetUnit3Level, TargetUnit4Id, TargetUnit4Level, TargetUnit5Id, TargetUnit5Level, TargetFriend1, TargetFriend2) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $preset_id, $target, $point, $win_count, $money, $exp, $present, $reward_point, $item_id, $amount, $area_id, $stage, $formation[0]["UnitId"], $formation[0]["UnitLevel"], $formation[1]["UnitId"], $formation[1]["UnitLevel"], $formation[2]["UnitId"], $formation[2]["UnitLevel"], $formation[3]["UnitId"], $formation[3]["UnitLevel"], $formation[4]["UnitId"], $formation[4]["UnitLevel"], $friends[0], $friends[1], $target_formation[0]["UnitId"], $target_formation[0]["UnitLevel"], $target_formation[1]["UnitId"], $target_formation[1]["UnitLevel"], $target_formation[2]["UnitId"], $target_formation[2]["UnitLevel"], $target_formation[3]["UnitId"], $target_formation[3]["UnitLevel"], $target_formation[4]["UnitId"], $target_formation[4]["UnitLevel"], $target_friends[0], $target_friends[1]);
}

function InviteID($type, $file, $line, $sub_category, $input, $error_message)
{
	if(!LOGDB_ENABLE_INVITEID)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO invite_id (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Input, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $input, $error_message);
}

function SerialCode($type, $file, $line, $sub_category, $serial_code_type, $status, $present, $serial_code, $table_index)
{
	if(!LOGDB_ENABLE_SERIALCODE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO serialcode (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, SerialCodeType, Status, Present, SerialCode, TableIndex) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $serial_code_type, $status, $present, $serial_code, $table_index);
}

function Conquest($type, $file, $line, $sub_category, $conquest_command, $panel, $reward_point, $reward_item, $reward_amount, $private_point, $global_point, $get_point, $round_number_identifier)
{
	if(!LOGDB_ENABLE_CONQUEST)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO conquest (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, ConquestCommand, Panel, RewardPoint, RewardItem, RewardAmount, PrivatePoint, GlobalPoint, GetPoint, RoundNumberIdentifier) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $conquest_command, $panel, $reward_point, $reward_item, $reward_amount, $private_point, $global_point, $get_point, $round_number_identifier);
}

function Raidboss($type, $file, $line, $sub_category, $comment, $before_point, $after_point, $item_id, $before_item, $after_item, $result, $friend, $boss_id, $time)
{
	if(!LOGDB_ENABLE_RAIDBOSS)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO raidboss (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Comment, BeforePoint, AfterPoint, ItemID, BeforeItem, AfterItem, Result, FriendID, BossID, Time) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $comment, $before_point, $after_point, $item_id, $before_item, $after_item, $result, $friend, $boss_id, $time);
}

function Tower($type, $file, $line, $sub_category, $tower_command, $floor, $reward_item, $amount)
{
	if(!LOGDB_ENABLE_TOWER)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO tower (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, TowerCommand, Floor, RewardItem, Amount) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $tower_command, $floor, $reward_item, $amount);
}

function StarFlower($type, $file, $line, $sub_category, $star_flower_command, $reward_item, $reward_amount, $add_point, $before_point, $after_point, $total_point_index, $total_point)
{
	if(!LOGDB_ENABLE_STARFLOWER)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO star_flower (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, StarFlowerCommand, RewardItem, RewardAmount, AddPoint, BeforePoint, AfterPoint, TotalPointIndex, TotalPoint) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $star_flower_command, $reward_item, $reward_amount, $add_point, $before_point, $after_point, $total_point_index, $total_point);
}

function Collaboration($type, $file, $line, $sub_category, $comment, $app_id, $from_id, $term, $status, $val1, $before_flag1, $before_flag2, $before_flag3, $after_flag1, $after_flag2, $after_flag3)
{
	if(!LOGDB_ENABLE_COLLABORATION)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO collaboration (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Comment, AppId, FromId, Term, Status, Val1, BeforeFlag1, BeforeFlag2, BeforeFlag3, AfterFlag1, AfterFlag2, AfterFlag3) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $comment, $app_id, $from_id, $term, $status, $val1, $before_flag1, $before_flag2, $before_flag3, $after_flag1, $after_flag2, $after_flag3);
}

function Reward($type, $file, $line, $sub_category, $reward_id, $item_id, $amount, $level, $exp)
{
	if(!LOGDB_ENABLE_REWARD)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO reward (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, RewardId, ItemId, Amount, Level, Exp) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $reward_id, $item_id, $amount, $level, $exp);
}

function Money($type, $file, $line, $sub_category, $target, $add_money, $money, $money_desc)
{
	if(!LOGDB_ENABLE_MONEY)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO money (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Target, AddMoney, Money, MoneyDesc) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $target, $add_money, $money, $money_desc);
}

function Tournament($type, $file, $line, $sub_category, $kind, $result, $target, $before_point, $after_point, $win, $timestamp, $user_exp, $unit_exp, $luna)
{
	if(!LOGDB_ENABLE_TOURNAMENT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO tournament (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Kind, Result, TargetID, BeforePoint, AfterPoint, Win, TimeStamp, UserExp, UnitExp, GetLuna) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $kind, $result, $target, $before_point, $after_point, $win, $timestamp, $user_exp, $unit_exp, $luna);
}

function Recycle($type, $file, $line, $sub_category, $user_action, $recycle_type, $get_item_id, $get_item_amount, $recycle_point, $before_recycle_point)
{
	if(!LOGDB_ENABLE_RECYCLE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO recycle (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UserAction, RecycleType, GetItemID, GetItemAmount, RecyclePoint, BeforeRecyclePoint) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $user_action, $recycle_type, $get_item_id, $get_item_amount, $recycle_point, $before_recycle_point);
}

function MonsterWalk($type, $file, $line, $sub_category, $unique_id, $start_time, $end_time, $use_boost, $result, $event1, $event2, $event3, $heal_time, $exp, $error_message)
{
	if(!LOGDB_ENABLE_MONSTER_WALK)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO monster_walk (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UniqueID, StartTime, EndTime, UseBoost, Result, Event1, Event2, Event3, HealTime, Exp, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $unique_id, $start_time, $end_time, $use_boost, $result, $event1, $event2, $event3, $heal_time, $exp, $error_message);
}

function MonsterWalk_Cron($type, $identifier, $file, $line, $sub_category, $unique_id, $start_time, $end_time, $use_boost, $result, $event1, $event2, $event3, $heal_time, $exp, $error_message)
{
	if(!LOGDB_ENABLE_MONSTER_WALK)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO monster_walk (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UniqueID, StartTime, EndTime, UseBoost, Result, Event1, Event2, Event3, HealTime, Exp, ErrorMessage) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $identifier, $common["file"], $line, $common["command"], $common["action"], $sub_category, $unique_id, $start_time, $end_time, $use_boost, $result, $event1, $event2, $event3, $heal_time, $exp, $error_message);
}

function Sell($type, $file, $line, $sub_category, $price, $before_money, $money)
{
	if(!LOGDB_ENABLE_SELL)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO sell (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Price, BeforeMoney, Money) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $price, $before_money, $money);
}

function Title($type, $file, $line, $sub_category, $user_action, $title_id, $title, $item_id, $price, $before_amount, $amount, $event_id, $event_sub_id)
{
	if(!LOGDB_ENABLE_TITLE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO title (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, UserAction, TitleID, Title, ItemId, Price, BeforeAmount, Amount, EventID, EventSubID) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $user_action, $title_id, $title, $item_id, $price, $before_amount, $amount, $event_id, $event_sub_id);
}

function Machine($type, $file, $line, $sub_category, $machine_name, $hardware, $os, $os_version, $screen_width, $screen_height, $memory_size, $screen_units, $screen_pixel_units, $client_version)
{
	if(!LOGDB_ENABLE_MACHINE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO machine (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, MachineName, Hardware, OS, OSVersion, ScreenWidth, ScreenHeight, MemorySize, ScreenUnits, ScreenPixelUnits, ClientVersion) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $machine_name, $hardware, $os, $os_version, $screen_width, $screen_height, $memory_size, $screen_units, $screen_pixel_units, $client_version);
}

function ParamCache($type, $file, $line, $sub_category, $query_identifier, $param_table, $query)
{
	if(!LOGDB_ENABLE_PARAMCACHE)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$query_data = urldecode($query);
	$query_data = str_replace("'", "\'", $query_data);
	$query = sprintf("INSERT INTO paramcache (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, QueryIdentifier, ParamTable, Query) VALUES (NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', %s, '%s', '%s')", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $query_identifier, $param_table, $query_data);
	\DB\QueryWithStrage($common["server"], $query);
}

function TextLog($type, $file, $line, $sub_category, $data)
{
	if(!LOGDB_ENABLE_TEXTLOG)
	{
		return;
	}
	if(APIMODE == APIMODE_RELEASE)
	{
		if(LOGDB_TEXTLOG_SANDBOX_ONLY)
		{
			// LOGDB_TEXTLOG_SANDBOX_ONLYがtrueの場合はSandBox以外では出力しない
			return;
		}
		if(LOGDB_TEXTLOG_ADMIN_ONLY)
		{
			require (DATA_ROOT . "/AdminList.php");
			$admin = false;
			foreach($AdminList as $admin_identifier)
			{
				if($admin_identifier == \utl\getGuid())
				{
					$admin = true;
					break;
				}
			}
			if($admin === false)
			{
				// LOGDB_TEXTLOG_ADMIN_ONLYがtrueの場合はAdmin以外では出力しない
				return;
			}
		}
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	$data = urldecode($data);
	$query = sprintf("INSERT INTO textlog (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Data) VALUES (NOW(), '%s', '%s', %s, %s, '%s', %s, '%s', '%s', '%s', '%s')", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $data);
	\DB\QueryWithStrage($common["server"], $query);
}

function Cheat($type, $file, $line, $sub_category, $message1, $message2)
{
	if(!LOGDB_ENABLE_CHEAT)
	{
		return;
	}
	$common = GetCommon($type, $file);
	if(is_null($common))
	{
		return;
	}
	\DB\QueryWithStrage($common["server"], "INSERT INTO cheat (Date, Type, IPaddress, Token, Identifier, File, Line, Command, Action, SubCategory, Message1, Message2) VALUES (NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $common["type_string"], $common["ip_address"], $common["token"], $common["identifier"], $common["file"], $line, $common["command"], $common["action"], $sub_category, $message1, $message2);
}

function UnitSource($card, $typeId, $typeSub, $item_id)
{
	if(!LOGDB_ENABLE_EXTUNIT)
	{
		return;
	}
	
	$common = GetCommon(LOGDB_INFO, __FILE__);
	if(is_null($common))
	{
		return;
	}
	
	$GachaType = 0;
	$EventId = 0;
	$Rare = $card["Rare"];
	$UniqueId = 0;
	$UnitId = $item_id;
	
	// GachaType
	// 超级扭蛋 1
	// 10连扭 2
	// 神扭 3
	// 系列扭蛋 1000
	switch($typeId)
	{
		// 扭蛋
		case 0:
			$UniqueId = $card["UniqueId"];
			$GachaType = $typeSub;
			break;
		// 活动
		case 1:
			$EventId = $typeSub;
			break;
		// 福袋
		case 2:
			break;
	}
	
	\DB\QueryWithStrage($common["server"], "INSERT INTO unitsource (Identifier,Time,TypeId,GachaType,EventId,Rare,UniqueId,UnitId) VALUES (%s,Now(),%s,%s,%s,%s,%s,%s)", \utl\getGuid(), $typeId, $GachaType, $EventId, $Rare, $UniqueId, $UnitId);
}

function GetCommon($type, $file)
{
	if(!LOG_OUTPUT_DB_ENABLE)
	{
		return null;
	}
	$type_string = GetType($type);
	$ip_address = $_SERVER["REMOTE_ADDR"];
	$token = \GetParam("Token");
	if(is_null($token))
	{
		$token = 0;
	}
	$identifier = \utl\getGuid();
	$file = basename($file);
	$command = \GetParam("command");
	$action = \GetParam("action");
	$server_number = LOGDB_SHARD1_BASE;
	if(LOGDB_ENABLE_SHARD1 == true)
	{
		$server_number = LOGDB_SHARD1_BASE + ($identifier % LOGDB_SHARD1_COUNT_MAX);
	}
	$server = "Log$server_number";
	$server_number = LOGDB_SHARD2_BASE;
	if(LOGDB_ENABLE_SHARD2 == true)
	{
		$server_number = LOGDB_SHARD2_BASE + ($identifier % LOGDB_SHARD2_COUNT_MAX);
	}
	$server2 = "Log$server_number";
	$result = array(
		"type_string" => $type_string, "ip_address" => $ip_address, "token" => $token, "identifier" => $identifier, "file" => $file, "command" => $command, "action" => $action, "server" => $server, "server2" => $server2 
	);
	return $result;
}

function GetType($type)
{
	switch($type)
	{
		case LOGDB_TRACE:
			return "Trace";
		case LOGDB_DEBUG:
			return "Debug";
		case LOGDB_PAYMENT:
			return "Payment";
		case LOGDB_INFO:
			return "Info";
		case LOGDB_WARNING:
			return "Warning";
		case LOGDB_ERROR:
			return "Error";
	}
	return "Unknown";
}

?>
