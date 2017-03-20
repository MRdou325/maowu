<?php

/**
 * 2013-05-15 lizhien Conductor
 */
namespace Conductor;

require_once (PROJECT_PATH . "/framework/Common.php");
require_once (PROJECT_PATH . "/framework/GlobalStruct.php");
require_once (PROJECT_PATH . "/framework/Utility.php");
require_once (PROJECT_PATH . "/framework/Log.php");
const UNKNOWN_ERROR = 0;
const EXEC_ERROR = 1;
const DB_ERROR = 2;
const ACCESS_ERROR = 3;

/**
 * URL路由
 */
function Go($command, $action, $guid)
{
	$request = null;
	$starttime = microtime(true);
	
	// 路由配置
	require (PROJECT_PATH . "/contents/CommandList.php");
	if(array_key_exists($command, $CommandList))
	{
		if(WORKING_STYLE === FRAMEWORK_RELEASE)
		{
			if(array_key_exists($command, $DebugList))
			{
				if(in_array($action, $DebugList[$command]))
				{
					throw new \Exception("Route Error : Invalid request.");
				}
			}
		}
		
		// check
		$c_action = "c_" . $action;
		if($action === null)
		{
			$c_action = "c_default";
		}
		
		if(in_array($action, $CommandList[$command]))
		{
			if(!file_exists(PROJECT_PATH . "/contents/check/{$command}.php"))
			{
				$request = array();
				
				$check_method = "\\check\\{$c_action}";
				\O\Set("ctrl_error_check", true);
				\O\Set("ctrl_error_check_method", $check_method);
			}
			else
			{
				require_once (PROJECT_PATH . "/contents/check/{$command}.php");
				$check_method = "\\check\\{$c_action}";
				
				if(!is_callable($check_method))
				{
					$request = array();
					\O\Set("ctrl_error_check", true);
					\O\Set("ctrl_error_check_method", $check_method);
				}
				else
				{
					$request = $check_method();
				}
				if($request === null)
				{
					throw new \Exception("Route Error : Check Failure.");
				}
			}
			
			if(!file_exists(PROJECT_PATH . "/contents/commander/{$command}.php"))
			{
				throw new \Exception("Route Error : Invalid command [$command].");
			}
			
			require_once (PROJECT_PATH . "/contents/commander/{$command}.php");
			
			// command
			$e_action = "e_" . $action;
			if($action === null)
			{
				$e_action = "e_default";
			}
			
			// action
			$ctrl_method = "\\command\\{$e_action}";
			if(!is_callable($ctrl_method))
			{
				if(WORKING_STYLE === FRAMEWORK_DEVELOP)
				{
					$ctrl_method($request);
				}
				else
				{
					throw new \Exception("Execute error.");
				}
			}
			else
			{
				$ctrl_method($request);
			}
		}
		else
		{
			if(WORKING_STYLE === FRAMEWORK_DEVELOP)
			{
				throw new \Exception("Route Error.");
			}
		}
	}
	else
	{
		if(WORKING_STYLE === FRAMEWORK_DEVELOP)
		{
			throw new \Exception("Route Error.");
		}
	}
	
	$endtime = microtime(true);
	$time = round(($endtime - $starttime)*1000);
	if($time > 500)
	{
		\Log::timeout($time."ms");
	}
}

?>