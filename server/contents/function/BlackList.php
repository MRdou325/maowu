<?php

namespace func;

function GetBanData($guid)
{
	$user_data = \DB\Query("SELECT BlackListType, BlackListTime FROM UserParams WHERE Identifier = %s", $guid);
	if($user_data)
	{
		return array(
			"BanType" => $user_data["BlackListType"], "End" => $user_data["BlackListTime"] 
		);
	}
	return null;
}

function GetBanType($guid)
{
	$BanType = 0;
	$BanData = \func\GetBanData($guid);
	if($BanData)
	{
		if($BanData["BanType"] == 1)
		{
			$NowTime = strtotime("now");
			$EndTime = $BanData["End"];
			if($NowTime <= $EndTime)
			{
				$BanType = 1;
			}
		}
		else if($BanData["BanType"] == 2)
		{
			$BanType = 2;
		}
	}
	return $BanType;
}

function CheckBlackList($guid)
{
	$user_data = \DB\Query("SELECT * FROM User WHERE Identifier = %s", $guid);
	if($user_data)
	{
		require (DATA_ROOT . "BlackList.php");
		foreach($BlackLists as $data)
		{
			if($user_data[key($data)] == $data[key($data)])
			{
				return true;
			}
		}
	}
	return false;
}

?>
