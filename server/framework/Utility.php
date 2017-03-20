<?php

/**
 * lizhien 20130615 Utility
 */
namespace utl;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (dirname(__FILE__) . "/DBManager.php");
require_once (dirname(__FILE__) . "/Memcache.php");
require_once (dirname(__FILE__) . "/Log.php");
require_once (dirname(__FILE__) . "/Email.php");

function getGuid()
{
	global $guid;
	$guid = GetParam("Identifier");
	return $guid;
}

function getPlatform()
{
	$platform = GetParam("Platform");
	return $platform;
}

function GetResourceVersion()
{
	// require (dirname(__FILE__) . "/../Version.php");
	// $platform = GetParam("Platform");
	// if ($platform == 31 || $platform == 33) {
		// return 103;
	// }

	// $guid = GetParam("Identifier");
	// if ($guid == 100100) {
		// return 103;
	// }

	// if ($platform == 1 && $guid == 100001) {
		// return 103;
	// } else if ($platform == 31 && $guid == 100040) {
		// return 103;
	// } else if ($platform == 32 && $guid == 100083) {
		// return 103;
	// } else if ($platform == 33 && $guid == 100011) {
		// return 103;
	// } else if ($platform == 34 && $guid == 100049) {
		// return 103;
	// } else if ($platform == 35 && $guid == 100100) {
		// return 103;
	// }
	return RESOURCE_VERSION;
}

function MakeOneTimeToken()
{
	$time = time();
	$seed = mt_rand();
	return $token = sha1($time . $seed);
}

function GetToken()
{
	$result = array();
	if(AUTHORIZE_INTERFACE == AUTH_USING_DATABASE)
	{
		$guid = getGuid();
		$result = \DB\Query("SELECT * FROM Network WHERE Identifier=%s", $guid);
		if($result == null)
		{
			throw new \Exception("Invalid OAuth token.");
		}
	}
	return $result;
}

function TokenCheck()
{
	$req_tk = GetParam("Token");
	if($req_tk == null)
		return false;
	$ret = false;
	$token = null;
	if(TOKENCHECK_INTERFACE == TOKEN_USING_DATABASE)
	{
		$token = \DB\Query("SELECT Token FROM Network WHERE Identifier=%s", getGuid());
		if($token == null)
			return false;
		if($token["Token"] == $req_tk)
		{
			$ret = true;
		}
	}
	return $ret;
}

function CCheck()
{
	return GAMENAME . GetPlatform() == GetParam("C");
}

function SCreate($guid)
{
	$sessionid = $guid . mt_rand();
	$token = mt_rand();
	$SessionId = \DB\Query("SELECT SessionId FROM Network WHERE Identifier=%s", $guid);
	if($SessionId)
	{
		\DB\Query("UPDATE Network SET SessionId = %s, Token = %s, Time = %s WHERE Identifier = %s", $sessionid, $token, time(), $guid);
	}
	else
	{
		\DB\Query("INSERT INTO Network (Identifier, SessionId, Token, Time) VALUES (%s, %s, %s, %s)", $guid, $sessionid, $token,time());
	}
	
	\O\Set("SessionId", $sessionid);
	\O\Set("Token", $token);
}

function RefreshToken()
{
	$guid = getGuid();
	$Token = mt_rand();
	$token = \DB\Query("SELECT Token FROM Network WHERE Identifier=%s", $guid);
	if(!$token)
	{
		\DB\Query("INSERT INTO Network (Identifier, Token, Time) VALUES (%s, %s, %s)", $guid, $Token,time());
	}
	else
	{
		\DB\Query("UPDATE Network SET Token = %s, Time = %s WHERE Identifier = %s", $Token, time(), $guid);
	}
	\O\Set("Token", $Token);
}

function SCheck()
{
	$sessionid = GetParam("S");
	$SessionId = \DB\Query("SELECT SessionId FROM Network WHERE Identifier = %s", getGuid());
	if($SessionId && $SessionId["SessionId"] == $sessionid)
	{
		return true;
	}
	return false;
}

function UpdateAccessTime($guid)
{
	$userparams = \DB\Query("SELECT LastTime, CreateTime, BackList FROM UserParams WHERE Identifier = %s", $guid);
	if(!empty($userparams)){
        if($userparams['LastTime'] < strtotime(date("Y-m-d")) || !$userparams['BackList'])
        {
            $userback = explode(",", $userparams['BackList']);
        	$reg = strtotime(date("Y-m-d", $userparams['CreateTime'])." 23:59:59");
        	$day = abs(ceil((time()-$reg)/86400));
        	if($day > 0 && !in_array($day, $userback))
        	{
        		$userback[] = $day;
        	}
        	$userparams['BackList'] = implode(",", array_filter($userback));
        }
        \DB\Query("UPDATE UserParams SET LastTime = %s, BackList = %s WHERE Identifier = %s", time(),$userparams['BackList'], $guid);
	}
}

function getClientVersion()
{
	return GetPlatformClientVersion(getPlatform());
}

function VersionCheck()
{
	$v = GetParam("V");
	return $v && $v >= getClientVersion();
}

function ResVersionCheck()
{
	$r = GetParam("R");
	return $r && $r >= GetResourceVersion();
}

function GameError($msg)
{
	\O\Set("Result", false);
	\O\Set("Message", $msg);
}

function close()
{
	\DB\Close();
	\memcache\MemcacheManager::close(MEMCACHE_MAIN);
	exit();
}

function mb_chr($num)
{
	return ($num < 256) ? chr($num) : mb_convert_encoding(mb_chr($num / 256) . chr($num % 256), "UTF-8", "UTF-16");
}

function mb_ord($char)
{
	return (strlen($char) < 2) ? ord($char) : 256 * mb_ord(substr($char, 0, -1)) + ord(substr($char, -1));
}

function Encode($request_list)
{
	$request_str = mb_convert_encoding($request_list, 'UTF-16', 'UTF-8');
	$offset = mt_rand(1, 9);
	$destination = mb_chr(113 + $offset);
	$i = 0;
	while(isset($request_str[$i]))
	{
		$str = $request_str[$i] . $request_str[$i + 1];
		$code = mb_ord($str);
		if($code > 255)
		{
			$destination .= mb_chr(113 + $offset);
			$offset = $offset < 9 ? $offset + 1 : 0;
			
			$half = $code / 4096 | 0;
			$destination .= mb_chr(97 + $half + $offset);
			$offset = $offset < 9 ? $offset + 1 : 0;
			
			$code -= $half * 4096;
			$half = $code / 256 | 0;
			$destination .= mb_chr(97 + $half + $offset);
			$offset = $offset < 9 ? $offset + 1 : 0;
			
			$code -= $half * 256;
		}
		$half = $code / 16 | 0;
		$destination .= mb_chr(97 + $half + $offset);
		$offset = $offset < 9 ? $offset + 1 : 0;
		$code -= $half * 16;
		$destination .= mb_chr(97 + $code + $offset);
		$offset = $offset < 9 ? $offset + 1 : 0;
		
		$i += 2;
	}
	\Log::info(LOGTYPE_ENCRYPTED_TIME, "Encrypted", array("Encode", microtime(true)));
	return $destination;
}

function Decode($error=false)
{
	if(isset($_GET['Query']))
	{
		$request_string = $_GET['Query'];
		unset($_GET['Query']);
		
		$offset = mb_ord($request_string[0]) - 113;
		$destination = "";
		
		$i = 1;
		while(isset($request_string[$i]))
		{
			$str = '';
			$code = mb_ord($request_string[$i]);
			if($code == 113 + $offset)
			{
				$offset = $offset < 9 ? $offset + 1 : 0;
				$i++;
				
				$str .= dechex(mb_ord($request_string[$i]) - (97 + $offset));
				$offset = $offset < 9 ? $offset + 1 : 0;
				$i++;
				
				$str .= dechex(mb_ord($request_string[$i]) - (97 + $offset));
				$offset = $offset < 9 ? $offset + 1 : 0;
				$i++;
			}
			$str .= dechex(mb_ord($request_string[$i]) - (97 + $offset));
			$offset = $offset < 9 ? $offset + 1 : 0;
			$i++;
			
			$str .= dechex(mb_ord($request_string[$i]) - (97 + $offset));
			$offset = $offset < 9 ? $offset + 1 : 0;
			$i++;
			
			$destination .= mb_chr(hexdec($str));
		}
		
		$request_list = explode('&', $destination);
		
		$result = array();
		foreach($request_list as $request)
		{
			if(strpos($request, '=') === false)
			{
				throw new \Exception('参数错误。');
			}
			
			list($key, $value) = explode('=', $request);
			$result[$key] = $value;
			$_GET[$key] = $value;
		}
		$_SERVER['QUERY_STRING'] = $destination;
		\Log::info(LOGTYPE_ENCRYPTED_TIME, "Encrypted", array("Decode"));
		return true;
	}
	else
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		$local = strpos($ip, "192.168") === 0 ? true : false;
		$isDebug = GetParam("debug");
		if($error && !$local && !$isDebug)
		{
			throw new \Exception("数据不合法。");
		}		
		\Log::info(LOGTYPE_ENCRYPTED_TIME, "Encrypted", array("NonDecode"));
		return false;
	}
}

function DecodeURI($uri)
{
	$uri = mb_convert_encoding($uri, 'UTF-8', 'auto');
	$uri = urldecode($uri);
	return $uri;
}

function toUrl($url, $get = null, $urlsession = false)
{
	$getParam = null;
	if($get != null && count($get) > 0)
		$getParam = http_build_query($get, "", "&");
	
	if(defined("URL_REWRITE") && self::isOpenSocial())
	{
		$location = $url;
		if($getParam != null)
		{
			$location = "{$location}?{$getParam}";
		}
		
		$content = "url";
		if(strpos($location, "view=flash") !== false)
		{
			if(PLATFORM === "mbga")
			{
				$content = "url";
			}
			else
			{
				$content = "flash";
			}
		}
		$location = GADGET_ROOT . "?{$content}=" . urlencode($location) . "&nocache=1";
		
		if(defined("GUID_ON"))
		{
			$location .= "&guid=ON";
		}
	}
	else
	{
		if(defined("GUID_ON"))
		{
			if($getParam != null)
			{
				$getParam = "{$getParam}&guid=ON";
			}
			else
			{
				$getParam = "guid=ON";
			}
		}
		
		$location = $url;
		if($getParam != null)
		{
			$location = "{$location}?{$getParam}";
		}
	}
	
	return $location;
}

function getLocalUrl($url, $get = null, $urlsession = false)
{
	$getParam = null;
	if($get != null && count($get) > 0)
		$getParam = http_build_query($get, "", "&");
	
	$location = $url;
	if($getParam != null)
	{
		$location = "{$location}?{$getParam}";
	}
	
	return $location;
}

function getGuidOn()
{
	$guid = "&nocache=1";
	if(defined("GUID_ON"))
	{
		$guid .= "&guid=ON";
	}
	return $guid;
}

function timePassed($lastTime, $resetTime, $time = NULL)
{
	if($time === NULL)
	{
		$time = time();
	}
	return ($lastTime < strtotime("today" . $resetTime) && $time >= strtotime("today" . $resetTime)) || ($lastTime < strtotime("yesterday" . $resetTime));
}

function timeStampPassed($lastTimeStamp, $resetTime, $time = NULL)
{
	if($time === NULL)
	{
		$time = time();
	}
	$lastTime = strtotime($lastTimeStamp);
	return ($lastTime < strtotime("today" . $resetTime) && $time >= strtotime("today" . $resetTime)) || ($lastTime < strtotime("yesterday" . $resetTime));
}

function convertToUnixTime($timeStamp)
{
	return strtotime($timeStamp);
}

function convertToTimeStamp($unixTime)
{
	return date("Y-m-d H:i:s", $unixTime);
}

function nocacheURLHash()
{
	$hash = time();
	return $hash;
}

// 将数组转为JOSN lizhien 20130516
function arrayRecursive(& $array, $function, $apply_to_keys_also = false)
{
	static $recursive_counter = 0;
	if(++$recursive_counter > 1000)
	{
		die('possible deep recursion attack');
	}
	foreach($array as $key => $value)
	{
		if(is_array($value))
		{
			arrayRecursive($array[$key], $function, $apply_to_keys_also);
		}
		else
		{
			$array[$key] = $function($value);
		}
		if($apply_to_keys_also && is_string($key))
		{
			$new_key = $function($key);
			if($new_key != $key)
			{
				$array[$new_key] = $array[$key];
				unset($array[$key]);
			}
		}
	}
	$recursive_counter--;
}

function JSON($array)
{
	arrayRecursive($array, 'urlencode', true);
	$json = json_encode($array);
	return urldecode($json);
}

// Email校验
function validEmail($email)
{
	$isValid = true;
	$atIndex = strrpos($email, "@");
	if(is_bool($atIndex) && !$atIndex)
	{
		$isValid = false;
	}
	else
	{
		$domain = substr($email, $atIndex + 1);
		$local = substr($email, 0, $atIndex);
		$localLen = strlen($local);
		$domainLen = strlen($domain);
		if($localLen < 1 || $localLen > 64)
		{
			// local part length exceeded
			$isValid = false;
		}
		else if($domainLen < 1 || $domainLen > 255)
		{
			// domain part length exceeded
			$isValid = false;
		}
		else if($local[0] == '.' || $local[$localLen - 1] == '.')
		{
			// local part starts or ends with '.'
			$isValid = false;
		}
		else if(preg_match('/\\.\\./', $local))
		{
			// local part has two consecutive dots
			$isValid = false;
		}
		else if(!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
		{
			// character not valid in domain part
			$isValid = false;
		}
		else if(preg_match('/\\.\\./', $domain))
		{
			// domain part has two consecutive dots
			$isValid = false;
		}
		else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local)))
		{
			// character not valid in local part unless
			// local part is quoted
			if(!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local)))
			{
				$isValid = false;
			}
		}
		// if($isValid && !(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A")))
		// {
			// domain not found in DNS
			// $isValid = false;
		// }
	}
	return $isValid;
}

// 发送SMTP邮件
function sendMail($to, $subject, $message)
{
	$charset = 'UTF-8';
	$mailconf = array(
		'mailsend' => '2', 'mailserver' => 'smtp.126.com', 'mailport' => '25', 'mailauth' => '1', 'mailfrom' => "女神雄起 <mojiezhiwang126@126.com>", 'mailauth_username' => 'mojiezhiwang126@126.com', 'mailauth_password' => 'mojiezhiwang8', 'maildelimiter' => '0', 'mailsilent' => '0', 'maillogfile' => PROJECT_PATH . "log/mail_log" . date("Ymd", time()) . ".log" 
	);
	
	\email\sendMail($to, $subject, $message, $charset, $mailconf);
}

/**
 * PHP获取字符串中英文混合长度
 * @param $str string
 * 字符串
 * @param $$charset string
 * 编码
 * @return 返回长度，1中文=1位，2英文=1位
 *
 */
function strLength($str)
{
	$str = iconv('utf-8', 'gb2312', $str);
	$num = strlen($str);
	$cnNum = 0;
	for($i = 0; $i < $num; $i++)
	{
		if(ord(substr($str, $i + 1, 1)) > 127)
		{
			$cnNum++;
			$i++;
		}
	}
	$enNum = $num - ($cnNum * 2);
	$number = ($enNum / 2) + $cnNum;
	return ceil($number);
}

?>
