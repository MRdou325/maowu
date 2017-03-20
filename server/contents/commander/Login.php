<?php

/**
 * 2013-07-31 login lizhien
 */
namespace command;

require_once (dirname(__FILE__) . "/../../config/config.inc");
require_once (PROJECT_PATH . "/framework/DBManager.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (PROJECT_PATH . "/framework/LogDB.php");
// require_once (PROJECT_PATH . "/contents/function/Item.php");
// require_once (PROJECT_PATH . "/contents/function/Ranking.php");
// require_once (PROJECT_PATH . "/contents/function/BBS.php");
// require_once (PROJECT_PATH . "/contents/function/User.php");
// require_once (PROJECT_PATH . "/contents/function/UnitList.php");
// require_once (PROJECT_PATH . "/contents/function/Menu.php");
// require_once (PROJECT_PATH . "/contents/function/Event.php");
// require_once (PROJECT_PATH . "/contents/function/Battle.php");
// require_once (PROJECT_PATH . "/contents/function/Friend.php");
// require_once (PROJECT_PATH . "/contents/function/BlackList.php");
// require_once (PROJECT_PATH . "/contents/function/EventDaily.php");
// require_once (PROJECT_PATH . "/contents/function/Present.php");
// require_once (PROJECT_PATH . "/contents/function/Trade.php");
// require_once (PROJECT_PATH . "/contents/function/RaidBoss.php");
// require_once (PROJECT_PATH . "/contents/function/Mining.php");
// require_once (PROJECT_PATH . "/contents/function/WorldBoss.php");
// require_once (PROJECT_PATH . "/contents/function/MonthCard.php");
// require_once (PROJECT_PATH . "/contents/function/Fund.php");
// require_once (PROJECT_PATH . "/contents/function/Gacha.php");
// require_once (PROJECT_PATH . "/contents/function/Shop.php");
// require_once (PROJECT_PATH . "/contents/function/Buy.php");
// require_once (PROJECT_PATH . "/contents/function/Reward.php");

function e_default($request)
{
	throw new \Exception("Invalid request.:Login UID:" . \utl\getGuid());
}

function e_Login($request)
{
	$loginname = GetParam("LoginName");
	$password = GetParam("PassWord");
	$password = md5($password);
	$user_data = \DB\Query("SELECT * FROM User WHERE LoginName = %s AND PassWord = %s", $loginname, $password);
	if(!$user_data)
	{
	    \utl\GameError("用户名或密码错误。");
	}
	
	\O\Set("User", $user_data);
	\O\Set("UserParams", \DB\Query("SELECT * FROM UserParams WHERE Identifier = %s", $user_data['Identifier']));
	\O\Set("Result", true);
}

function e_Register($request)
{
    $guid = \utl\getGuid();
    $loginname = GetParam("LoginName");
    $password = GetParam("PassWord");
    $password = md5($password);
    $user = \DB\Query("SELECT * FROM User WHERE LoginName = %s", $loginname);
    if($user)
    {
        \utl\GameError("账号已经存在。");
    }
    if(!\utl\validEmail($loginname))
    {
        \utl\GameError("账号不是合法的邮件地址。");
    }
    $myData = \DB\Query("SELECT * FROM User WHERE Identifier = %s",$guid);
    if(!is_null($myData['LoginName']))
    {
        \utl\GameError("当前账号已经注册，请勿重复注册。");
    }
    \DB\Query("UPDATE User SET LoginName = %s, PassWord = %s WHERE Identifier = %s", $loginname, $password, $guid);
    $myData["LoginName"] = $loginname;
    \O\Set("User", $myData);
    \O\Set("Result",true);
}

?>
