<?php

/*
 * Memcache
 */
namespace memcache;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (dirname(__FILE__) . "/../config/cachestore.inc");
require_once (dirname(__FILE__) . "/Log.php");
class MemcacheManager
{
	private static $memcache = array(
		null, null 
	);

	static public function init()
	{
		global $MemCachePorts;
		foreach($MemCachePorts as $key => $port)
		{
			if(self::$memcache[$key] === null)
			{
				self::$memcache[$key] = new \Memcache();
				$ret = null;
				$ret = self::$memcache[$key]->connect(MEMCACHE_HOST, $port);
				if($ret == false)
				{
					self::$memcache[$key] = null;
					throw new \Exception("Memcache::init() : Memcache Error.");
				}
			}
		}
	}

	static public function connect($type)
	{
		global $MemCachePorts;
		if(array_key_exists($type, $MemCachePorts))
		{
			if(self::$memcache[$type] === null)
			{
				self::$memcache[$type] = new \Memcache();
				$ret = null;
				$ret = self::$memcache[$type]->connect(MEMCACHE_HOST, $MemCachePorts[$type]);
				if($ret == false)
				{
					self::$memcache[$key] = null;
					throw new \Exception("Memcache::connect() : connect error.");
				}
			}
		}
		else
		{
			self::$memcache[$type] = null;
			throw new \Exception("Memcache::connect() : not find type.");
		}
		
		return $ret;
	}
	
	// 値取得
	static public function get($key, $type = MEMCACHE_MAIN)
	{
		$data = null;
		if(self::$memcache[$type] === null)
		{
			self::connect($type);
		}
		$data = self::$memcache[$type]->get($key);
		return $data;
	}
	
	// 指定keyによる値のセット($flag=圧縮格納, $expire=有効期限)
	static public function set($key, $value, $expire = DEFAULT_EXPIRE, $type = MEMCACHE_MAIN, $flag = null)
	{
		$ret = false;
		
		if(self::$memcache[$type] === null)
		{
			self::connect($type);
		}
		
		$ret = self::$memcache[$type]->set($key, $value, $flag, $expire);
		if($ret == false)
		{
			throw new \Exception("Memcache::set() Error.");
		}
		
		return $ret;
	}
	
	// 指定keyによる値のセット
	static public function increment($key, $value, $type = MEMCACHE_MAIN)
	{
		$ret = false;
		if(is_null(self::$memcache[$type]))
		{
			self::connect($type);
		}
		$ret = self::$memcache[$type]->increment($key, $value);
		if($ret == false)
		{
			throw new \Exception("Memcache::increment() Error.");
		}
		return $ret;
	}
	
	// keyに対応する値を削除する($timeoutで何秒後に削除するかを指定できます)
	static public function delete($key, $type = MEMCACHE_MAIN, $timeout = 0)
	{
		$ret = false;
		if(is_null(self::$memcache[$type]))
		{
			self::connect($type);
		}
		$ret = self::$memcache[$type]->delete($key, $timeout);
		if($ret == false)
		{
			// delete fail
		}
		else
		{
			// delete
		}
		return $ret;
	}
	
	// Memcacheサーバとの接続を切る
	static public function close($type = MEMCACHE_MAIN)
	{
		// 任意に接続を切断しても良いが、スクリプトの実行終了時に自動的に接続は切られる。
		if(self::$memcache[$type] != null)
		{
			$ret = self::$memcache[$type]->close();
		}
	}
	
	// **Memcahceを全削除**
	static public function flush($type = MEMCACHE_MAIN)
	{
		$ret = false;
		if(is_null(self::$memcache[$type]))
		{
			self::connect($type);
		}
		$ret = self::$memcache[$type]->flush();
		return $ret;
	}
}

// シングルトンの初期化(通常初期化はコマンド中で行うためここではしない)
if(ENABLE_MEMCACHE && ENABLE_MEMCACHE)
{
	MemcacheManager::init();
}

// namespace間接アクセサ
function set($key, $value, $expire = DEFAULT_EXPIRE, $type = MEMCACHE_MAIN, $flag = null)
{
	if(ENABLE_MEMCACHE == false)
	{
		return false;
	}
	$signature = "release";
	if(APIMODE == APIMODE_SANDBOX)
	{
		$signature = "sandbox";
	}
	$key = $signature . "-" . $key . "-" . GetParam("ServerId");
	return MemcacheManager::set($key, $value, $expire, $type, $flag);
}

function get($key, $type = MEMCACHE_MAIN)
{
	if(ENABLE_MEMCACHE == false)
	{
		return false;
	}
	$signature = "release";
	if(APIMODE == APIMODE_SANDBOX)
	{
		$signature = "sandbox";
	}
	$key = $signature . "-" . $key . "-" . GetParam("ServerId");
	return MemcacheManager::get($key, $type);
}

function increment($key, $value, $type = MEMCACHE_MAIN)
{
	if(ENABLE_MEMCACHE == false)
	{
		return false;
	}
	$signature = "release";
	if(APIMODE == APIMODE_SANDBOX)
	{
		$signature = "sandbox";
	}
	$key = $signature . "-" . $key . "-" . GetParam("ServerId");
	return MemcacheManager::increment($key, $value, $type);
}

function delete($key, $type = MEMCACHE_MAIN, $timeout = 0)
{
	if(ENABLE_MEMCACHE == false)
	{
		return false;
	}
	$signature = "release";
	if(APIMODE == APIMODE_SANDBOX)
	{
		$signature = "sandbox";
	}
	$key = $signature . "-" . $key . "-" . GetParam("ServerId");
	return MemcacheManager::delete($key, $type, $timeout);
}

function flush($type = MEMCACHE_MAIN)
{
	if(ENABLE_MEMCACHE == false)
	{
		return false;
	}
	MemcacheManager::flush($type);
}

// columnとvalueからkeyを作成する（serializeだと長くなるから）
function createKeyColumnsAndValues($columns, $values)
{
	$count = count($columns);
	$key = "";
	for($i = 0; $i < $count; $i++)
	{
		if(isset($columns[$i]) && isset($values[$i]))
		{
			$key .= $columns[$i] . "=" . $values[$i];
		}
	}
	return $key;
}

// columnsとsignとvaluesからkeyを作成する
function createKeyColumnsAndSignAndValues($columns, $sign, $values)
{
	$count = count($columns);
	$key = "";
	for($i = 0; $i < $count; $i++)
	{
		if(isset($columns[$i]) && isset($sign[$i]) && isset($values[$i]))
		{
			$key .= $columns[$i] . $sign[$i] . $values[$i];
		}
	}
	return $key;
}

?>
