<?php
/**
 * lizhien 20130615 Log
 */
require_once (dirname(__FILE__) . "/../contents/LogSetting.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (PROJECT_PATH . "/framework/Memcache.php");

Log::init();
class Log
{
	private static $level = 0;
	private static $file_path = "";
	private static $date = null;
	private static $ip = null;
	private static $carrier = null;
	private static $uid = null;

	public static function init()
	{
		self::$level = LOG_LEVEL;
		self::$date = date("Ymd", time());
		self::$ip = $_SERVER["REMOTE_ADDR"];
		self::$uid = GetParam("Identifier");
	}

	public static function trace($logtype, $sc, $str)
	{
		if(self::$level & LEVEL_TRACE)
		{
			self::output("TRACE", $logtype, $sc, $str);
		}
	}

	public static function debug($logtype, $sc, $str, $object = null)
	{
		if(self::$level & LEVEL_DEBUG)
		{
			self::output("DEBUG", $logtype, $sc, $str, $object);
		}
	}

	public static function payment($logtype, $sc, $str)
	{
		if(self::$level & LEVEL_PAYMENT)
		{
			self::output("PAYMENT", $logtype, $sc, $str);
		}
	}

	public static function info($logtype, $sc, $str)
	{
		if(self::$level & LEVEL_INFO)
		{
			self::output("INFO", $logtype, $sc, $str);
		}
	}

	public static function warning($logtype, $sc, $str, $object = null)
	{
		if(self::$level & LEVEL_WARNING)
		{
			self::output("ERROR", $logtype, $sc, $str, $object);
		}
	}

	public static function error($logtype, $sc, $str, $object = null)
	{
		if(self::$level & LEVEL_ERROR)
		{
			self::output("ERROR", $logtype, $sc, $str, $object);
		}
	}
	
	public static function me($str)
	{
		self::debug(LOGTYPE_DEBUG, "MyInfo", $str);
	}
	
	public static function timeout($str)
	{
		self::debug(LOGTYPE_TIMEOUT, "TimeOut", $str);
	}
	
	public static function manualsendpresent($str)
	{
		self::debug(LOGTYPE_MANUALSENDPRESENT, "ManualSendPresent", $str);
	}

	private static function output($mode, $logtype, $sc, $str, $object = null)
	{
		global $LogSetting;
		if(array_key_exists($logtype, $LogSetting) == false || array_key_exists("Name", $LogSetting[$logtype]) == false)
		{
			return;
		}
		$filePath = PROJECT_PATH . "log/" . $LogSetting[$logtype]["Name"] . "_" . self::$date . ".csv";
		$create = false;
		$table = array_key_exists("Header", $LogSetting[$logtype]) ? $LogSetting[$logtype]["Header"] : "platform";
		$size = 0;
		if(file_exists($filePath))
		{
			$size = filesize($filePath);
		}
		else
		{
			touch($filePath);
			chmod($filePath, 0777);
			$create = true;
		}
		if($size > LOG_FILE_SIZE)
		{
			$index = 1;
			while(true)
			{
				$newFilePath = PROJECT_PATH . "log/" . $LogSetting[$logtype]["Name"] . "_" . self::$date . "_{$index}.csv";
				if(!file_exists($newFilePath))
				{
					break;
				}
				$index++;
			}
			if(file_exists($filePath))
			{
				rename($filePath, $newFilePath);
			}
			touch($filePath);
			chmod($filePath, 0777);
			$create = true;
		}
		if(is_array($str))
		{
			$str = implode(",", $str);
		}
		$now = date("Y/m/d/H:i:s");
		$obj_str = GetPlatformName(GetParam("Platform"));
		if($object != null)
		{
			$obj_str = print_r($object, true) . "\n";
			$obj_str = str_replace("\r\n", "\r", $obj_str);
			$obj_str = str_replace("\n", "\r", $obj_str);
			$obj_str = str_replace("\r", "<BR>", $obj_str);
		}
		if($create)
		{
			error_log("Date,Type,IP,Identifier,Command,Action,SubCategory,$table\n", 3, $filePath);
		}
		$ip = self::$ip;
		$carrier = self::$carrier;
		$uid = $user_name = GetParam("Identifier");
		$command = GetParam("command");
		$action = GetParam("action");
		error_log("{$now},{$mode},{$ip},{$uid},{$command},{$action},{$sc},{$str},{$obj_str}\n", 3, $filePath);
	}
	
	// admin log
	public static function adminLog($fileName, $type = 1, $dataArr = array())
	{
		require_once (PROJECT_PATH . "admin/inc/message.php");
		$filePath = PROJECT_PATH . "admin/doc/" . $fileName . ".csv";
		
		if(file_exists($filePath))
		{
			unlink($filePath);
		}
		
		touch($filePath);
		chmod($filePath, 0777);
		$create = true;
		switch($type)
		{
			case "code": // 礼包兑换码
				if($create)
				{
					error_log("{$m_code['Title']},{$m_code['GiftID']},{$m_code['SendTime']},{$m_code['ValidTime']},{$m_code['ReceiveStatus']},{$m_code['Receiver']},{$m_code['ReceiveTime']},\n", 3, $filePath);
				}
				foreach($dataArr as $k => $v)
				{
					error_log("{$v['Title']},{$v['GiftID']},{$v['SendTime']},{$v['ValidTime']},{$v['ReceiveStatus']},{$v['Receiver']},{$v['ReceiveTime']},\n", 3, $filePath);
				}
				return true;
				break;
		}
		return false;
	}
}

?>
