<?php

/**
 * lizhien 20130615 Struct
 */
namespace O;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (dirname(__FILE__) . "/Log.php");
require_once (dirname(__FILE__) . "/Utility.php");

function Jsonp($value)
{
	if(GetParam("JsonpCallBack"))
	{
		return GetParam("JsonpCallBack") . "($value)";
	}
	else
	{
		return $value;
	}
}

function Set($key, $value)
{
	global $GlobalOutPutStorage;
	$GlobalOutPutStorage[$key] = $value;
}

function Get($key)
{
	global $GlobalOutPutStorage;
	if(array_key_exists($key, $GlobalOutPutStorage))
	{
		return $GlobalOutPutStorage[$key];
	}
	else
	{
		return null;
	}
}

function GetJSON()
{
	global $GlobalOutPutStorage;
	if(GetParam("debug"))
	{
		return \utl\JSON($GlobalOutPutStorage);
	}
	else
	{
		return Jsonp(json_encode($GlobalOutPutStorage));
	}
}

function GetForCSV($header = null)
{
	$ret = "";
	global $GlobalOutPutStorage;
	if($header)
	{
		$dataTmp = array();
		foreach($header as $k)
		{
			$dataTmp[] = $GlobalOutPutStorage[$k];
		}
		$ret = implode(",", $dataTmp);
	}
	else
	{
		$headTmp = array();
		$dataTmp = array();
		foreach($GlobalOutPutStorage as $k => $v)
		{
			$headTmp[] = $k;
			$dataTmp[] = $v;
		}
		$ret = implode(",", $headTmp) . "\r" . implode(",", $dataTmp);
	}
	return $ret;
}

?>