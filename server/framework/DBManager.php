<?php

/**
 * DB
 */
namespace DB;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (PROJECT_PATH . "/framework/Memcache.php");
require_once (PROJECT_PATH . "/framework/Log.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (dirname(__FILE__) . "/MySqli.php");

class DBSingletonManager
{
	private $target = "no target";
	private $myAccessor = null;
	private $cacheKey = null;
	private $cache_enable = null;
	private static $self = null;
	private $performance_analyze = false;
	private $access_time_sum = 0.0;

	private function __construct()
	{}

	private static function get()
	{
		if(self::$self === null)
		{
			self::$self = new DBSingletonManager();
		}
		return self::$self;
	}

	static public function GetAccessor()
	{
		return self::get()->myAccessor;
	}

	static public function Have($target)
	{
		if(is_callable($target))
		{
			if(strcmp(self::get()->target, $target()))
			{
				self::get()->target = $target();
				self::get()->myAccessor = new \DBAccessor($target());
				self::get()->myAccessor->tryConnect();
			}
		}
		else
		{
			if(strcmp(self::get()->target, $target))
			{
				self::get()->target = $target;
				self::get()->myAccessor = new \DBAccessor($target);
				self::get()->myAccessor->tryConnect();
			}
		}
		
		return self::get()->myAccessor;
	}

	static public function Release()
	{
		self::get()->target = "no target";
		self::get()->myAccessor = null;
	}

	static public function SetPerformanceAnalyze($enable)
	{
		self::get()->performance_analyze = $enable;
	}

	static public function GetPerformanceAnalyze()
	{
		return self::get()->performance_analyze;
	}

	static public function SetAccessTimeSum($time)
	{
		self::get()->access_time_sum = $time;
	}

	static public function GetAccessTimeSum()
	{
		return self::get()->access_time_sum;
	}

	static function CacheStart($cacheName)
	{
		self::get()->cacheKey = $cacheName;
	}

	static function GetCacheKey()
	{
		return self::get()->cacheKey;
	}

	static function CacheEnd()
	{
		self::get()->cacheKey = null;
	}

	static function Action($action)
	{
		switch($action)
		{
			case "GetLastID":
				return self::get()->myAccessor->GetLastestID();
				break;
		}
	}

	static function SetCacheEnable($enable)
	{
		$cache_enable = $enable;
	}

	static function IsCacheEnable()
	{
		return $cache_enable;
	}
}

function QueryParser($query)
{
	$ret = array();
	$ret["TableName"] = null;
	$ret["CacheSet"] = 0;
	$cache_key = DBSingletonManager::GetCacheKey();
	
	if(stripos($query, "SELECT") === 0)
	{
		$ret["QueryType"] = "SELECT";
		$ret["CacheSet"] = 1;
		$matches = array();
		
		if(preg_match("/FROM (.*?) (WHERE)|(GROUP)|(ORDER)|(LIMIT)/i", $query, $matches, PREG_OFFSET_CAPTURE))
		{
			$ret["TableName"] = trim($matches[1][0]);
		}
		else
		{
			$ret["TableName"] = trim(substr($query, stripos($query, "FROM")));
		}
	}
	
	if(stripos($query, "UPDATE") === 0 && stripos($query, " SET") > 0 && stripos($query, "WHERE") > 0)
	{
		$ret["QueryType"] = "UPDATE";
		$ret["CacheSet"] = 2;
		$matches = array();
		if(preg_match("/UPDATE (.*?) SET/i", $query, $matches, PREG_OFFSET_CAPTURE))
		{
			$ret["TableName"] = trim($matches[1][0]);
		}
	}
	
	if(stripos($query, "INSERT") === 0)
	{
		$ret["QueryType"] = "INSERT";
		$ret["CacheSet"] = 3;
		$matches = array();
		if(preg_match("/(IGNORE|INTO) (.*?) (VALUES|\()/i", $query, $matches, PREG_OFFSET_CAPTURE))
		{
			$ret["TableName"] = trim($matches[2][0]);
		}
	}
	
	if(stripos($query, "DELETE") === 0 && stripos($query, "FROM") > 0 && stripos($query, "WHERE") > 0)
	{
		$ret["QueryType"] = "DELETE";
		$ret["CacheSet"] = 4;
		$matches = array();
		if(preg_match("/FROM(.*?)WHERE/i", $query, $matches, PREG_OFFSET_CAPTURE))
		{
			$ret["TableName"] = trim($matches[1][0]);
		}
	}
	
	$ret["Query"] = $query;
	return $ret;
}

function GetCacheKeyFromQuery($qs, $db_desc)
{
	if(!array_key_exists("Where", $qs))	return null;
	$key = $qs["TableName"];
	foreach($db_desc["CacheKeyPrimary"] as $dbkey)
	{
		if(array_key_exists($dbkey, $qs["Where"]))
		{
			$key .= "_" . $dbkey . "" . $qs["Where"][$dbkey];
		}
		else
		{
			$key = null;
			break;
		}
	}
	return $key;
}

function QueryWithStrage()
{
	$argument = func_get_args();
	$storage = array_shift($argument);
	$query = array_shift($argument);
	$qs = QueryParser($query);
	$tbname = $qs["TableName"];
	if(is_null($tbname))
	{
		return;
	}
	$connector = DBSingletonManager::Have($storage);
	if($connector)
	{
		if(func_num_args() > 1)
		{
			$args = func_num_args() - 1;
			for($i = 0; $i < $args; $i++)
			{
				if(array_key_exists($i, $argument))
				{
					if(!is_numeric($argument[$i]))
					{
						$argument[$i] = "'" . $connector->escape($argument[$i]) . "'";
					}
				}
			}
			$query = vsprintf($query, $argument);
		}
		if(APIMODE === APIMODE_SANDBOX)
		{
			$connector->set_abort(true);
			$connector->set_logout(true);
		}
		else
		{
			$connector->set_abort(false);
			$connector->set_logout(false);
		}
		$result = $connector->query($query);
		if(count($result) >= 1)
		{
			$result = $result[0];
		}
		$end_time = (double) microtime(true);
		return $result;
	}
	return null;
}

function QueryMultiLineWithStrage()
{
	$argument = func_get_args();
	$storage = array_shift($argument);
	$query = array_shift($argument);
	$qs = QueryParser($query);
	$tbname = $qs["TableName"];
	if(is_null($tbname))
	{
		return;
	}
	$connector = DBSingletonManager::Have($storage);
	if($connector)
	{
		if(func_num_args() > 1)
		{
			$args = func_num_args() - 2;
			for($i = 0; $i < $args; $i++)
			{
				if(!is_numeric($argument[$i]))
				{
					$argument[$i] = "'".$connector->escape($argument[$i])."'";
				}
			}
			$query = vsprintf($query, $argument);
		}
		if(APIMODE === APIMODE_SANDBOX)
		{
			$connector->set_abort(true);
			$connector->set_logout(true);
		}
		else
		{
			$connector->set_abort(false);
			$connector->set_logout(false);
		}
		$result = $connector->query($query);
		$end_time = (double) microtime(true);
		return $result;
	}
	return null;
}

function Query()
{
	return QueryExec(\utl\getGuid(), func_get_args());
}

function QueryShard()
{
	$argument = func_get_args();
	$shard_key = array_shift($argument);
	return QueryExec($shard_key, $argument);
}

function QueryExec($shard_key, $argument)
{
	$start_time = (double) microtime(true);
	$query = array_shift($argument);
	$qs = QueryParser($query);
	$tbname = $qs["TableName"];
	if(is_numeric($query))
	{
		throw new \Exception("Need use shard :" . $query);
	}
	if(is_null($tbname))
	{
		throw new \Exception("DB bad query :" . $query);
	}
	$db_desc = GetDBDesc($tbname);
	if(is_null($db_desc) == false)
	{
		$storage = "";
		$shard = false;
		if(array_key_exists("Shard", $db_desc))
		{
			$shard = $db_desc["Shard"];
		}
		if($shard == true)
		{
			$shard_index = $shard_key % count($db_desc["ShardStorage"]);
			$storage = $db_desc["ShardStorage"][$shard_index];
		}
		else
		{
			$storage = $db_desc["Storage"];
		}
		$connector = DBSingletonManager::Have($storage);
		if($connector)
		{
			if(count($argument) > 0)
			{
				$args = count($argument);
				for($i = 0; $i < $args; $i++)
				{
					if(is_numeric($argument[$i]) == false)
					{
						$argument[$i] = "'" . $connector->escape($argument[$i]) . "'";
					}
				}
				$query = vsprintf($query, $argument);
			}
			$connector->set_abort(true);
			$connector->set_logout(true);
			$result = $connector->query($query);
			if(count($result) == 1)
			{
				$result = $result[0];
			}
			else
			{
				if(count($result) > 1)
				{
					$log_query = str_replace("\"", "\"\"", $query);
					\Log::info(LOGTYPE_DB, "QueryExec error", array("\"" . $log_query . "\""));
				}
				else
				{
					$result = null;
				}
			}
			$end_time = (double) microtime(true);
			PerformanceAnalyze($start_time, $end_time, $storage, $query);
			return $result;
		}
		else
		{
			return null;
		}
	}
	else
	{
		throw new \Exception("DB no such table " . $tbname);
	}
}

function QueryMultiLine()
{
	return QueryMultiLineExec(\utl\getGuid(), func_get_args());
}

function QueryShardMultiLine()
{
	$argument = func_get_args();
	$shard_key = array_shift($argument);
	return QueryMultiLineExec($shard_key, $argument);
}

function QueryMultiLineExec($shard_key, $argument)
{
	$start_time = (double) microtime(true);
	$query = array_shift($argument);
	$qs = QueryParser($query);
	$tbname = $qs["TableName"];
	$cacheset = $qs["CacheSet"];
	if(is_numeric($query))
	{
		$query = array_shift($argument);
		throw new \Exception("Need use shard :" . $query);
	}
	if(is_null($tbname))
	{
		throw new \Exception("DB bad query :" . $query);
	}
	$db_desc = GetDBDesc($tbname);
	if(is_null($db_desc) == false)
	{
		$storage = "";
		$shard = false;
		if(array_key_exists("Shard", $db_desc))
		{
			$shard = $db_desc["Shard"];
		}
		if($shard == true)
		{
			$shard_index = $shard_key % count($db_desc["ShardStorage"]);
			$storage = $db_desc["ShardStorage"][$shard_index];
		}
		else
		{
			$storage = $db_desc["Storage"];
		}
		$connector = DBSingletonManager::Have($storage);
		if($connector)
		{
			if(count($argument) > 0)
			{
				$args = count($argument);
				for($i = 0; $i < $args; $i++)
				{
					if(is_numeric($argument[$i]) == false)
					{
						$argument[$i] = "'" . $connector->escape($argument[$i]) . "'";
					}
				}
				$query = vsprintf($query, $argument);
			}
			$connector->set_abort(true);
			$connector->set_logout(true);
			$result = $connector->query($query);
			$end_time = (double) microtime(true);
			PerformanceAnalyze($start_time, $end_time, $storage, $query);
			return $result;
		}
		else
		{
			return null;
		}
	}
	else
	{
		throw new \Exception("DB no such table " . $tbname);
	}
}

function GetShardMax($table)
{
	$shard_max = 0;
	$db_desc = GetDBDesc($table);
	if(is_null($db_desc) == false)
	{
		$shard_max = 1;
		if(array_key_exists("Shard", $db_desc))
		{
			if($db_desc["Shard"] == true)
			{
				$shard_max = count($db_desc["ShardStorage"]);
			}
		}
	}
	return $shard_max;
}

function GetCacheKey($cache_key, $query)
{
	$data = \memcache\get($cache_key);
	$matches = array();
	$ret = false;
	if(preg_match("/SELECT (.*?) FROM/i", $query, $matches, PREG_OFFSET_CAPTURE))
	{
		$rkey_array = explode(",", $matches[1][0]);
		foreach($rkey_array as $req_key)
		{
			$key = trim($req_key);
			if(!array_key_exists($key, $data))
			{
				$ret = true;
				break;
			}
			if($data[$key] == null)
			{
				$ret = true;
				break;
			}
		}
	}
	if($ret)
	{
		return null;
	}
	return $data;
}

function GetCache($tbname, $cache_key, $query)
{
	$data = \memcache\get($cache_key);
	$matches = array();
	$ret = false;
	
	if($data == null)
	{
		return null;
	}
	
	$db_desc = GetDBDesc($tbname);
	if(preg_match("/SELECT (.*?) FROM/i", $query, $matches, PREG_OFFSET_CAPTURE))
	{
		$rkey_array = explode(",", $matches[1][0]);
		foreach($rkey_array as $req_key)
		{
			$key = trim($req_key);
			if(!array_key_exists($key, $data))
			{
				$ret = true;
				break;
			}
			if($data[$key] == null && !in_array($key, $db_desc))
			{
				$ret = true;
				break;
			}
		}
	}
	
	if($ret)
	{
		return null;
	}
	return $data;
}

function ReplaceCacheSelect($cache_key, $result)
{
	$data = \memcache\get($cache_key);
	foreach($result as $key => $lines)
	{
		foreach($lines as $key => $d)
		{
			$data[$key] = $d;
		}
	}
	\memcache\set($cache_key, $data);
}

function ReplaceCacheUpdate($cache_key, $query)
{
	$data = \memcache\get($cache_key);
	$matches = array();
	if(preg_match("/SET(.*?)WHERE/i", $query, $matches, PREG_OFFSET_CAPTURE))
	{
		$set_array = explode(",", $matches[1][0]);
		foreach($set_array as $set)
		{
			$set = trim(str_replace("'", "", $set));
			$kv = explode("=", $set);
			$data[$kv[0]] = $kv[1];
		}
	}
	\memcache\set($cache_key, $data);
}

function ReplaceCacheInsert($cache_key, $query)
{
	$data = \memcache\get($cache_key);
	$matches = array();
	if(preg_match("/\((.*?)\)(.*?)VALUES(.*?)\((.*?)\)/i", $query, $matches, PREG_OFFSET_CAPTURE))
	{
		$key_array = explode(",", $matches[1][0]);
		$value_array = explode(",", $matches[4][0]);
		$i = 0;
		foreach($key_array as $key)
		{
			$data[$key] = $value_array[$i];
			$i++;
		}
	}
	\memcache\set($cache_key, $data);
}

function CacheHit($cache_key)
{
	DBSingletonManager::CacheStart($cache_key);
}

function CacheEnd()
{
	DBSingletonManager::CacheEnd();
}

function CacheDelete($cache_key)
{
	DBSingletonManager::CacheEnd();
	$data = \memcache\delete($cache_key);
}

function Close()
{
	DBSingletonManager::Release();
}

function TransactionStart($dbname = "Master01")
{
	$connector = DBSingletonManager::Have($dbname);
	$connector->setTransaction(true);
	$connector->begin();
}

function TransactionEnd($rollback_flag = false)
{
	$connector = DBSingletonManager::GetAccessor();
	$result = $connector->end($rollback_flag);
	$connector->setTransaction(false);
	DBSingletonManager::Release();
	
	return $result;
}

function CacheControl($enable)
{
	DBSingletonManager::SetCacheEnable($enable);
}

function Action($action)
{
	return DBSingletonManager::Action($action);
}

function Escape($Target, $Text)
{
	$connector = DBSingletonManager::Have($Target);
	return "'" . $connector->escape($Text) . "'";
}

function GetDBDesc($table)
{
	return array(
		"Storage" => "Main" 
	);
}

function GetStorage($table)
{
	$db_desc = GetDBDesc($table);
	if(is_null($db_desc))
	{
		return null;
	}
	return $db_desc["Storage"];
}

function SetPerformanceAnalyze($enable)
{
	DBSingletonManager::SetPerformanceAnalyze($enable);
}

function SetAccessTimeSum($time)
{
	DBSingletonManager::SetAccessTimeSum($time);
}

function GetAccessTimeSum()
{
	return DBSingletonManager::GetAccessTimeSum();
}

function PerformanceAnalyze($start_time, $end_time, $db_desc, $query)
{
	if(DBSingletonManager::GetPerformanceAnalyze() == false)
	{
		return;
	}
	$db_access_time = $end_time - $start_time;
	$db_access_time_sum = DBSingletonManager::GetAccessTimeSum() + $db_access_time;
	DBSingletonManager::SetAccessTimeSum($db_access_time_sum);
	return;
}

?>
