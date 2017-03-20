<?php

namespace func;

function GetMessage($id)
{
	$args = func_get_args();
	array_shift($args);
	$filename = IsEnglishClient() ? "Message_en" : "Message";
	require (DATA_ROOT . "./$filename.php");
	$message = "";
	if(array_key_exists($id, $Message))
	{
		$message = $Message[$id];
	}
	foreach($args as $i => $arg)
	{
		$index = $i + 1;
		$percent = "%$index";
		$message = str_replace($percent, $arg, $message);
	}
	return $message;
}

function GetClientUpdateMessage($platform)
{
	$message = GetMessage("ERROR_MSG3");
	$p = GetPlatformKeyName($platform);
	if($p == "QH360Android")
	{
		$message = GetMessage("ERROR_MSG10");
	}
	else if($p == "UCAndroid")
	{
		$message = GetMessage("ERROR_MSG11");
	}
	else if($p == "MobageAndroid")
	{
		$message = GetMessage("ERROR_MSG12");
	}
	else if($p == "ND91Android")
	{
		$message = GetMessage("ERROR_MSG13");
	}
	return $message;
}

function GetEventInfo()
{
	if(IsTW())
	{
		require (DATA_ROOT . "NoticeDataTW.php");
	}
	else
	{
		require (DATA_ROOT . "NoticeData.php");
	}
	$EventInfo = array();
	$GachaInfo = array();
	$Info = array();
	if(is_null($NoticeData["EventInfomation"]) == false)
	{
		foreach($NoticeData["EventInfomation"] as $key => $data)
		{
			$starTime = strtotime($data["starTime"]);
			$nowTime = strtotime("now");
			$endTime = strtotime($data["endTime"]);
			if($nowTime < $starTime)
			{
				$EventInfo[] = $data["content1"];
			}
			else if($nowTime > $endTime)
			{
				$EventInfo[] = $data["content3"];
			}
			else
			{
				$EventInfo[] = $data["content2"];
			}
		}
	}
	$loglist = \DB\QueryMultiline("SELECT * FROM GachaLog WHERE Series = 0 ORDER BY GachaTime DESC");
	$retry = 3;
	if(!is_null($loglist))
	{
		foreach($loglist as $data)
		{
			if(!\func\Card::ExistCard($data["UnitId"]))
			{
				continue;
			}
			if($retry <= 0)
			{
				continue;
			}
			$retry--;
			$data["UserName"] = \cache\Get($data["Identifier"], "User", "Name");
			$data["Rare"] = \func\Card::GetCardRare($data["UnitId"]);
			$data["Name"] = \func\Card::GetCardName($data["UnitId"]);
			$GachaInfo[] = $data;
		}
	}
	$Info["EventInfo"] = $EventInfo;
	$Info["GachaInfo"] = $GachaInfo;
	return $Info;
}

function GetNotice()
{
	$now = date("Y-m-d H:i:s");
	$notice = \DB\QueryWithStrage("User", "SELECT * FROM Notice WHERE StartTime <= %s AND EndTime >= %s ORDER BY Time DESC LIMIT 1", $now, $now);
	// $serverid = GetParam("ServerId");
	// $notice = \DB\QueryWithStrage("User", "SELECT * FROM Notice WHERE StartTime <= %s AND EndTime >= %s AND ServerId = %s ORDER BY Time DESC LIMIT 1", $now, $now, $serverid);
	// if (is_null($notice))
	// {
		// $notice = \DB\QueryWithStrage("User", "SELECT * FROM Notice WHERE StartTime <= %s AND EndTime >= %s AND ServerId = 0 ORDER BY Time DESC LIMIT 1", $now, $now);
	// }
	$data = array();
	if(!is_null($notice))
	{
		$data["Title"] = $notice["Title"];
		$data["StartTime"] = $notice["StartTime"];
		$data["EndTime"] = $notice["EndTime"];
		$data["Content"] = $notice["Content"];
	}
	
	return $data;
}

?>
