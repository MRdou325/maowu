<?php

/**
 * lizhien 20130731 登录编号
 */
require_once (dirname(__FILE__) . "/config/config.inc");
require_once (PROJECT_PATH . "/framework/Common.php");
require_once (PROJECT_PATH . "/framework/DBManager.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (PROJECT_PATH . "/framework/GlobalStruct.php");
require_once (PROJECT_PATH . "/framework/Log.php");
require_once (PROJECT_PATH . "/Version.php");

try
{
	\utl\Decode();
	
	$type = GetParam("Type");
	$platform = GetParam("Platform");
	$uerId = GetParam("UserId");
	$loginName = GetParam("LoginName");
	$password = GetParam("Password");
	$password1 = GetParam("Password1");
	$nickName = GetParam("NickName");
	$deviceId = GetParam("DeviceId");
	$mac = GetParam("Mac");
	$server = GetParam("Server");
	$os = GetPlatformOS($platform);
	$verifiedCode = GetParam("VerifiedCode");
	$debug = GetParam("debug");
	$date = time();
	
	if(\utl\CCheck() == false && false)
	{
		\O\Set("CError", true);
		\utl\GameError("链非法接。");
	}
	else if($type == "Platform")
	{
		\O\Set("Version", \utl\GetResourceVersion());
		\O\Set("Platform", GetPlatformList($platform));
		\O\Set("Result", true);
	}
	else if($type == "Login" || $type == "UpdateServer")
	{
		Login($platform, $uerId, $loginName, $password, $nickName, $deviceId, $mac, $server, $os, $date);
	}
	else if($type == "Register")
	{
		Register($platform, $uerId, $loginName, $password, $nickName, $deviceId, $mac, $server, $os, $date);
	}
	else if($type == "FindPassword")
	{
		FindPassword($platform, $loginName);
	}
	else if($type == "ResetPassword")
	{
		ResetPassword($platform, $loginName, $verifiedCode);
	}
	else if($type == "ChangePassword")
	{
		ChangePassword($platform, $loginName, $password, $password1);
	}
	else if($type == "Verified")
	{
		Verified($platform, $loginName, $verifiedCode);
	}
	else
	{
		\O\Set("Result", false);
	}
	
	//输出
	header("Content-type: application/x-javascript");
	echo \O\GetJSON();
}
catch(Exception $e)
{
	echo $e->getMessage();
}

function Login($platform, $uerId, $loginName, $password, $nickName, $deviceId, $mac, $server, $os, $date)
{
	if($platform != null)
	{
		$password = md5($password);
		$ip = $_SERVER["REMOTE_ADDR"];
		$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE (Platform = %s AND UserId = %s) OR (LoginName = %s AND Password = %s)", $platform, $uerId, $loginName, $password);
		if($user)
		{
// 			$nickName = $user["NickName"] = $nickName ? $nickName : $user["NickName"];
// 			$deviceId = $user["DeviceId"] = $deviceId ? $deviceId : $user["DeviceId"];
			$mac = $user["Mac"] = $mac ? $mac : $user["Mac"];
			$server = $user["Server"] = $server ? $server : $user["Server"];
			$lastservers = explode(",", $user["LastServer"]);
			if(in_array($server, $lastservers))
			{
				unset($lastservers[array_keys($lastservers, $server)[0]]);
				(int)$server > 0 && array_push($lastservers, $server);
				$lastserver = $user["LastServer"] = implode(",", $lastservers);
			}
			else
			{
				$lastserver = $user["LastServer"] = (int)$server > 0 ? (is_null($user["LastServer"]) ? $server : $user["LastServer"].",".$server) : $user["LastServer"];
			}
			\DB\QueryWithStrage("User", "UPDATE User SET Mac = %s, Server = %s, LastServer = %s, LastTime = %s, OS = %s, IP = %s WHERE UserId = %s", $mac, $server, $lastserver, $date, $os, $ip, $user["UserId"]);
			\O\Set("ServerList", GetServerList($platform));
			\O\Set("User", $user);
			\O\Set("Result", true);
		}
		else
		{
			// 第三方平台用户登录
			if(GetPlatformRegister($platform) == false && $uerId)
			{
				// 防止刷小号
				// if($platform > 1000 && $deviceId && $mac)
				// {
					// $userCount = \DB\QueryWithStrage("User", "SELECT COUNT(*) AS Count FROM User WHERE DeviceId = %s AND Mac = %s", $deviceId, $mac);
					// if($userCount && $userCount["Count"] >= 3)
					// {
						// return \utl\GameError("亲，您已经注册过3个账号啦。");
					// }
				// }
				
				\DB\QueryWithStrage("User", "INSERT INTO User (Platform, UserId, LoginName, NickName, DeviceId, Mac, OS, IP, RegDate, LoginDate, Server, LastServer) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $platform, $uerId, $uerId, $nickName, $deviceId, $mac, $os, $ip, $date, $date, "", "");
				$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE Platform = %s AND UserId = %s", $platform, $uerId);
				if($user)
				{
					\O\Set("ServerList", GetServerList($platform));
					\O\Set("User", $user);
					\O\Set("Result", true);
				}
			}
			else
			{
			    \DB\QueryWithStrage("User", "INSERT INTO User (Platform, Mac, OS, IP, CreateTime, LastTime, Server, LastServer) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", $platform, $mac, $os, $ip, $date, $date, "", "");
			    $user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE Platform = %s AND Mac = %s", $platform, $mac);
			    if($user)
			    {
			        \O\Set("ServerList", GetServerList($platform));
			        \O\Set("User", $user);
			        \O\Set("Result", true);
			    }
				//\utl\GameError("账号和密码不正确。");
			}
		}
	}
	else
	{
		\utl\GameError("登录出现错误。");
	}
}

function Register($platform, $uerId, $loginName, $password, $nickName, $deviceId, $mac, $server, $os, $date)
{
	if($platform != null && GetPlatformRegister($platform) && $loginName && $password)
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		
		// 防止刷小号
		// if($platform > 0 && $deviceId && $mac)
		// {
			// $userCount = \DB\QueryWithStrage("User", "SELECT COUNT(*) AS Count FROM User WHERE DeviceId = %s AND Mac = %s", $deviceId, $mac);
			// if($userCount && $userCount["Count"] >= 3)
			// {
				// return \utl\GameError("亲，您已经注册过3个账号啦。");
			// }
		// }
		
		$password = md5($password);
		$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s", $loginName);
		if($user)
		{
			\utl\GameError("账号已经存在。");
		}
		else
		{
			if(\utl\validEmail($loginName))
			{
				\DB\QueryWithStrage("User", "INSERT INTO User (Platform, UserId, LoginName, Password, OS, DeviceId, Mac, IP, RegDate, LoginDate, Server, LastServer) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $platform, $loginName, $loginName, $password, $os, $deviceId, $mac, $ip, $date, $date, "", "");
				$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s AND Password = %s", $loginName, $password);
				if($user)
				{
					\O\Set("ServerList", GetServerList($platform));
					\O\Set("User", $user);
					\O\Set("Result", true);
				}
			}
			else
			{
				\utl\GameError("账号不是合法的邮件地址。");
			}
		}
	}
	else
	{
		\utl\GameError("账号和密码不能为空。");
	}
}

function FindPassword($platform, $loginName)
{
	if($platform != null && GetPlatformRegister($platform) && $loginName)
	{
		$verifiedCode = time();
		\DB\QueryWithStrage("User", "UPDATE User SET VerifiedCode = %s WHERE LoginName = %s", $verifiedCode, $loginName);
		
		$to = $loginName;
		$subject = "重设密码邮件";
		$url = "http://" . SERVER1 . "/mojie/server/Login.php?Type=ResetPassword&VerifiedCode=" . $verifiedCode . "&Platform=" . $platform . "&LoginName=" . $loginName;
		$message = "<html><body><meta charset=utf-8 /><p><font color=red>点击下面链接获得新密码：</font></p><p><font color=red><a href=" . $url . ">" . $url . "</a></font></p></body></html>";
		\utl\sendMail($to, $subject, $message);
		
		\O\Set("Result", true);
	}
	else
	{
		\utl\GameError("账号不能为空。");
	}
}

function ResetPassword($platform, $loginName, $verifiedCode)
{
	if($platform != null && GetPlatformRegister($platform) && $loginName && $verifiedCode)
	{
		$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s AND VerifiedCode = %s", $loginName, $verifiedCode);
		if(!$user)
		{
			exit("链接已经失效。");
		}
		else
		{
			$verifiedCode = rand(100000, 999999);
			$password = md5($verifiedCode);
			\DB\QueryWithStrage("User", "UPDATE User SET Password = %s, VerifiedCode = %s WHERE LoginName = %s", $password, $verifiedCode, $loginName);
			
			$to = $loginName;
			$subject = "密码更改通知";
			$message = "<html><body><meta charset=utf-8 /><p><font color=red>密码修改成功，你的新密码是：</font></p><p>" . $verifiedCode . "</p><p>请登录游戏后修改。</p></body></html>";
			\utl\sendMail($to, $subject, $message);
			
			exit("<meta charset=utf-8 />你的新密码是：" . $verifiedCode . " ,请登录游戏后修改。");
		}
	}
	else
	{
		exit("非法链接。");
	}
}

function ChangePassword($platform, $loginName, $password, $password1)
{
	if($platform != null && GetPlatformRegister($platform) && $loginName && $password && $password1)
	{
		$newpassword = $password1;
		$password = md5($password);
		$password1 = md5($password1);
		$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s AND Password = %s", $loginName, $password);
		if(!$user)
		{
			\utl\GameError("新密码输入错误。");
		}
		else
		{
			if($password != $password1)
			{
				\DB\QueryWithStrage("User", "UPDATE User SET Password = %s WHERE LoginName = %s", $password1, $loginName);
				\O\Set("Result", true);
				
				$to = $loginName;
				$subject = "密码更改通知";
				$message = "<html><body><meta charset=utf-8 /><p><font color=red>密码修改成功，你的新密码是：</font></p><p>" . $newpassword . "</p><p>请牢记。</p></body></html>";
				\utl\sendMail($to, $subject, $message);
			}
			else
			{
				\utl\GameError("新密码和旧密码不能一致。");
			}
		}
	}
	else
	{
		\utl\GameError("账号和密码不能为空。");
	}
}

function Verified($platform, $loginName, $verifiedCode)
{
	if($platform != null && GetPlatformRegister($platform) && $loginName)
	{
		if($verifiedCode)
		{
			$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s AND VerifiedCode = %s", $loginName, $verifiedCode);
			if($user["Verified"] == 1)
			{
				return \utl\GameError("请勿重复验证。");
			}
			if($user)
			{
				\DB\QueryWithStrage("User", "UPDATE User SET Verified = 1 WHERE LoginName = %s", $loginName);
				\O\Set("Result", true);
			}
			else
			{
				\utl\GameError("验证码输入错误。");
			}
		}
		else
		{
			$user = \DB\QueryWithStrage("User", "SELECT * FROM User WHERE LoginName = %s", $loginName);
			if($user["Verified"] > 0 || ($user["VerifiedCode"] >= 100000 && $user["VerifiedCode"] <= 999999))
			{
				\utl\GameError("请勿重复验证。");
			}
			else
			{
				$verifiedCode = rand(100000, 999999);
				\DB\QueryWithStrage("User", "UPDATE User SET VerifiedCode = %s WHERE LoginName = %s", $verifiedCode, $loginName);
				\O\Set("Result", true);
				
				$to = $loginName;
				$subject = "账号邮件验证通知";
				$message = "<html><body><meta charset=utf-8 /><p><font color=red>验证码是：</font>" . $verifiedCode . "</p></body></html>";
				\utl\sendMail($to, $subject, $message);
			}
		}
	}
	else
	{
		\utl\GameError("非法链接。");
	}
}

?>
