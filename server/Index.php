<?php
use function transaction\guid;

/*;*
 * lizhien 20130615 入口
 */
require_once (dirname(__FILE__) . "/config/config.inc");
require_once (PROJECT_PATH . "/framework/Common.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (PROJECT_PATH . "/framework/DBManager.php");
require_once (PROJECT_PATH . "/framework/LogDB.php");
require_once (PROJECT_PATH . "/framework/Memcache.php");
require_once (PROJECT_PATH . "/framework/Conductor.php");
require_once (PROJECT_PATH . "/framework/Gateway.php");
require_once (PROJECT_PATH . "/contents/Item.php");
require_once (PROJECT_PATH . "/contents/function/BlackList.php");
require_once (PROJECT_PATH . "/contents/function/Index.php");
require_once (PROJECT_PATH . "/contents/function/Message.php");
// require_once (PROJECT_PATH . "/contents/function/User.php");
require_once (PROJECT_PATH . "/Version.php");
use GatewayClient\Gateway;
Gateway::$registerAddress = '127.0.0.1:1238';

ob_start();

try
{
	// 定义参数
	\utl\Decode(true);
	$timeClient = GetParam("T");
	if ($timeClient)
	{
		\O\Set("TimeClient", $timeClient - 0);
		\O\Set("TimeServer", time());
	}

	$guid = \utl\getGuid();
	$command = GetParam("command");
	$action = GetParam("action");
	$isDebug = GetParam("debug");
	$isFirst = GetParam("First");
	$platform = GetParam("Platform");
	$serverId = GetParam("ServerId");
	$deviceId = GetParam("DeviceId");
	$serverIp = $_SERVER["REMOTE_ADDR"];
	$os = GetPlatformOS($platform);
	$maintenance = false;
	
	if(!$command || !$action)
	{
		throw new \Exception(\func\GetMessage("ERROR_MSG1"));
	}
	
	if(!$guid && empty($serverId))
	{
	    $guid = \func\initUserInfo($platform, $os, $serverIp, $deviceId);
	    if(!$guid)
	    {
	        throw new \Exception(\func\GetMessage("ERROR_MSG1"));
	    }
	}
	
	// 黑名单
	$blackListType = \func\GetBanType($guid);
	
	// 停服代开
	$now = strtotime(date("Y-m-d H:i:s"));
	$stopfrom = date("2015-12-10 10:00:00");
	$stopto = date("2016-03-10 12:00:00");
	if($now > strtotime($stopfrom) && $now < strtotime($stopto) && $platform > 1 && $platform != 12)
	{
		\O\Set("Maintenance", true);
		throw new \Exception("对不起，停机维护中。。。");
	}
	if($os != "Android")
	{
		if ($platform == 18 && $_SERVER["HTTP_HOST"] == "112.74.95.214")
		{
			\O\Set("Maintenance", true);
			throw new \Exception("请到同步推下载新游戏包！");
		}
		if (in_array($guid, array())) {
			//	白名单	无视	开关服限制
		} else if (in_array($serverIp, array("27.159.61.193"))) {
			//	IP白名单
		} else {
			if ($serverId == 5)
			{
				$stopfrom = date("2016-09-07 15:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("9月7号下午3：00 开放！");
				}
			}
			else if ($serverId == 4)
			{
				$stopfrom = date("2016-08-17 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月17号早上10：00 开放！");
				}
			}
			else if ($serverId == 3)
			{
				$stopfrom = date("2016-08-10 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月10号早上10：00 开放！");
				}
			}
			else if ($serverId == 2)
			{
				$stopfrom = date("2016-08-03 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月03号早上10：00 开放！");
				}
			}
			else
			{
				$stopfrom = date("2016-07-20 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("7月20号早上10：00 开放！");
				}
				// $stopto = date("2016-05-26 00:00:00");
				// if ($now > strtotime($stopto)) {
					// \O\Set("Maintenance", true);
					// throw new \Exception("现已关服,下次开服敬请期待!");
				// }
				// if ($serverId != 2) {
					// \O\Set("Maintenance", true);
					// throw new \Exception("1区暂不开放，请登录2区");
				// }
			}
		}
	}
	else if(true)
	{
		// if (in_array($guid, array(111006, 111099, 111393, 108539, 100005, 100107, 111004, 109202, 111032, 111009, 109203, 111035, 111434, 100001, 111465, 111407, 111018))) {
		if (in_array($guid, array())) {
			//	白名单	无视	开关服限制
		} else if (in_array($serverIp, array("27.159.61.193"))) {
			//	IP白名单
		} else {
			if ($serverId == 6)
			{
				$stopfrom = date("2016-09-07 15:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("9月7号下午3：00 开放！");
				}
			}
			else if ($serverId == 5)
			{
				$stopfrom = date("2016-08-17 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月17号早上10：00 开放！");
				}
			}
			else if ($serverId == 4)
			{
				$stopfrom = date("2016-08-10 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月10号早上10：00 开放！");
				}
			}
			else if ($serverId == 3)
			{
				$stopfrom = date("2016-08-03 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("8月03号早上10：00 开放！");
				}
			}
			else if ($serverId == 2 || in_array($platform, array(37, 36, 39, 42, 43, 40, 41, 41)))
			{
				$stopfrom = date("2016-07-20 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("7月20号早上10：00 开放！");
				}
			}
			else
			{
				$stopfrom = date("2016-05-11 10:00:00");
				if ($now < strtotime($stopfrom)) {
					\O\Set("Maintenance", true);
					throw new \Exception("2016年05月11号 10:00:00开服!");
				}
				// $stopto = date("2016-05-26 00:00:00");
				// if ($now > strtotime($stopto)) {
					// \O\Set("Maintenance", true);
					// throw new \Exception("现已关服,下次开服敬请期待!");
				// }
			}
		}
	}	
	// 维护检测
	if($maintenance)
	{
		\O\Set("Maintenance", true);
		throw new \Exception(\func\GetMessage("ERROR_MSG2"));
	}
	// 资源版本检测
	else if($action != "Result" && \utl\ResVersionCheck() == false)
	{
		\O\Set("ResUpdate", true);
		\O\Set("ClientVersion", \utl\getClientVersion());
		\O\Set("ResVersion", \utl\GetResourceVersion());

		$r = GetParam("R");
		$allResVersionSize = json_decode(file_get_contents("./update/size.json"), true);
		$ResSize = 0;
		foreach($allResVersionSize as $key => $data)
		{
			if ((int)$key > $r)
			{
				$ResSize += $data;
			}
		}
		\O\Set("ResSize", $ResSize);

		throw new \Exception(\func\GetMessage("ERROR_MSG4"));
	}
	// 客户端版本检测
	else if($action != "Result" && \utl\VersionCheck() == false)
	{
		\O\Set("ClientUpdate", true);
		\O\Set("ClientVersion", \utl\getClientVersion());
		\O\Set("ResVersion", \utl\GetResourceVersion());
		throw new \Exception(\func\GetClientUpdateMessage(\utl\getPlatform()));
	}
	// 临时黑名单
	else if($blackListType == 1)
	{
		\O\Set("BlackList", true);
		\O\Set("BanType", $blackListType);
		$blackInfo = \func\GetBanData($guid);
		throw new \Exception(\func\GetMessage("ERROR_MSG5", $blackInfo["End"]));
	}
	// 永久黑名单
	else if($blackListType == 2)
	{
		\O\Set("BlackList", true);
		\O\Set("BanType", $blackListType);
		throw new \Exception(\func\GetMessage("ERROR_MSG6"));
	}
	// 设备黑名单
	else if(\func\CheckBlackList($guid) == true)
	{
		\O\Set("BlackList", true);
		\O\Set("BanType", 2);
		throw new \Exception(\func\GetMessage("ERROR_MSG6"));
	}
	// Session检测
	else if(!$isFirst && $command != "Info" && \utl\SCheck() == false && $isDebug == false)
	{
		\O\Set("SError", true);
		throw new \Exception(\func\GetMessage("ERROR_MSG9"));
	}
	// Token检测
	else if(!$isFirst && \utl\TokenCheck() == false && $isDebug == false)
	{
		\O\Set("TokenError", true);
		throw new \Exception(\func\GetMessage("ERROR_MSG7"));
	}
	// 安全检测
	else if(\utl\CCheck() == false && $isDebug == false)
	{
		\O\Set("CError", true);
		throw new \Exception(\func\GetMessage("ERROR_MSG8"));
	}
	else
	{
		\utl\UpdateAccessTime($guid);
		\Conductor\Go($command, $action, $guid);
		//\O\Set("Remind", \func\GetUserRemind());
		$isFirst && \utl\SCreate($guid);
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	\Log::info(LOGTYPE_ERROR, "Exception", array($message));
	\LogDB\Error(LOGDB_ERROR, __FILE__, __LINE__, "Exception", $message);
	\O\Set("Error", "Exception");
	\O\Set("ErrorMsg", $message);
}

// 输出
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
$content = ob_get_contents();
ob_end_clean();
if($content != null)
{
	\O\Set("PHP_ERROR", $content);
}
header("Content-type: application/x-javascript");
\utl\RefreshToken();
echo \O\GetJSON();

// 关闭数据库、Memcache
\utl\close();

?>
