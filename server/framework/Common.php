<?php
/**
 * lizhien 20130615 Common
 */
$ParsedQueryFlag = false;
$ParsedQuery = array();

function GetParam($name)
{
	global $ParsedQueryFlag;
	
	$ret = null;
	if($ParsedQueryFlag)
	{
		global $ParsedQuery;
		if(isset($ParsedQuery[$name]))
		{
			$ret = $ParsedQuery[$name];
		}
	}
	else
	{
		if(isset($_GET[$name]))
		{
			$ret = $_GET[$name];
		}
		if(isset($_POST[$name]))
		{
			$ret = $_POST[$name];
		}
	}
	
	return $ret;
}

function SetParsedQuery($Query)
{
	global $ParsedQueryFlag;
	global $ParsedQuery;
	$ParsedQuery = $Query;
	$ParsedQueryFlag = true;
}

function Pic(&$dic, $key)
{
	if(array_key_exists($key, $dic))
	{
		return $dic[$key];
	}
	else
	{
		return null;
	}
}

function IsTW()
{
	return GetParam("Platform") == 888;
}

function IsApple()
{
	return GetParam("Platform") == 19;
	// return GetParam("Platform") == 19 || GetParam("Platform") == 0;
}

function IsEnglishClient()
{
	return GetParam('Language') === 'en';
}

function CheckParams($paramName, $msg, $type = null)
{
    $param = GetParam($paramName);
    if(!is_null($type))
    {
        if(is_null($param))
        {
            \utl\GameError($msg."不能为空。");
            \utl\RefreshToken();
            echo \O\GetJSON();exit;
        }
        switch ($type)
        {
            case 'int':
                if(!is_numeric($param))
                {
                    \utl\GameError($msg."必须为数字。");
                    \utl\RefreshToken();
                    echo \O\GetJSON();exit;
                }
                break;
        }
    }
    return $param;
}

?>