<?php

/**
 * 缓存
 */
namespace cache
{

	require_once (dirname(__FILE__) . "/../../config/config.inc");
	require_once (PROJECT_PATH . "/framework/DBManager.php");
	require_once (PROJECT_PATH . "/framework/Utility.php");
	require_once (PROJECT_PATH . "/framework/Memcache.php");

	function Get($identifier, $table, $member, $db_enable = true)
	{
		$value = false;
		$memcache_key = "$identifier:$table:$member";
		if(ENABLE_CACHE)
		{
			$value = \memcache\get($memcache_key);
		}
		if($db_enable && ($value == false))
		{
			$result = \DB\QueryShard($identifier, "SELECT $member FROM $table WHERE Identifier = %s", $identifier);
			if(is_null($result) == false)
			{
				$value = $result[$member];
				\memcache\set($memcache_key, $value);
			}
		}
		return $value;
	}

	function GetEx($search_conditions, $table, $member, $db_enable = true)
	{
		$identifier = 0;
		if(array_key_exists("Identifier", $search_conditions))
		{
			$identifier = $search_conditions["Identifier"];
		}
		$value = false;
		$memcache_key = "$identifier:$table:$member";
		if(ENABLE_CACHE)
		{
			$value = \memcache\get($memcache_key);
		}
		if($db_enable && ($value == false))
		{
			$first = true;
			foreach($search_conditions as $key => $data)
			{
				if($key == "Identifier")
				{
					continue;
				}
				if($first)
				{
					$first = false;
					$condition .= " WHERE {$key} = {$data}";
				}
				else
				{
					$condition .= " AND {$key} = {$data}";
				}
			}
			$result = \DB\QueryShard($identifier, "SELECT $member FROM $table" . $condition);
			if(is_null($result) == false)
			{
				$value = $result[$member];
			}
		}
		return $value;
	}

	function Set($identifier, $table, $member, $value)
	{
		if(ENABLE_CACHE == false)
		{
			return false;
		}
		$memcache_key = "$identifier:$table:$member";
		\memcache\set($memcache_key, $value);
		return true;
	}

	function Delete($identifier, $table, $member)
	{
		if(ENABLE_CACHE == false)
		{
			return false;
		}
		$memcache_key = "$identifier:$table:$member";
		return \memcache\delete($memcache_key);
	}
}

?>