<?php
/**
 * lizhien 20130615 MySqli
 */
require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (dirname(__FILE__) . "/Log.php");

class DBAccessor
{
	private $dbinfo = null;
	private $dblink = null;
	private $result_buff = null;
	private $ts_enable = false;
	private $ts_flag = false;
	private $ts_result = false;
	private $c = false;
	private $abort = true;
	private $logout = true;

	public function __construct($target, $transaction = false)
	{
		if(IsTW())
		{
			require (dirname(__FILE__) . "/../config/databasestw.inc");
		}
		else
		{
			require (dirname(__FILE__) . "/../config/databases.inc");
		}
		
		$this->dbinfo = $DataBaseDefinition[$target];
		$this->dblink = mysqli_init();
		$this->ts_enable = false;
		if(array_key_exists("transaction", $this->dbinfo) && $this->dbinfo["transaction"] == true)
		{
			$this->ts_enable = USING_DB_TRUNSUCTION & $this->dbinfo["transaction"];
		}
		$this->ts_flag = $transaction & $this->ts_enable;
		if($this->ts_result)
		{
			$this->ts_result = false;
		}
	}

	public function __destruct()
	{
		$this->close();
	}

	private function connect()
	{
		if($this->c)
		{
			return;
		}
		if(!mysqli_options($this->dblink, MYSQLI_OPT_CONNECT_TIMEOUT, 10))
		{
			if($this->abort)
			{
				throw new Exception("DB Setting fail.");
			}
			return;
		}
		$info = $this->dbinfo;
		if($info["port"] == "")
		{
			if(!mysqli_real_connect($this->dblink, $info["host"], $info["user"], $info["pass"], $info["db"]))
			{
				if($this->abort)
				{
					throw new Exception("DB Connection Error.");
				}
				return;
			}
			else
			{
				$this->c = true;
			}
		}
		else
		{
			if(!mysqli_real_connect($this->dblink, $info["host"], $info["user"], $info["pass"], $info["db"], $info["port"]))
			{
				if($this->abort)
				{
					throw new Exception("DB Connection Error.");
				}
				return;
			}
			else
			{
				$this->c = true;
			}
		}
		
		if(!mysqli_set_charset($this->dblink, "utf8"))
		{
			if($this->abort)
			{
				throw new Exception("Error CHARSET Set utf8: %s", mysqli_error($link));
			}
			return;
		}
	}

	private function close()
	{
		mysqli_close($this->dblink);
	}

	private function store()
	{
		$datas = null;
		$result = mysqli_store_result($this->dblink);
		if($result)
		{
			if(mysqli_num_rows($result) > 0)
			{
				$datas = array();
				while($row = $result->fetch_assoc())
				{
					$datas[] = $row;
				}
			}
			mysqli_free_result($result);
		}
		return $datas;
	}

	public function tryConnect()
	{
		$this->connect();
	}

	public function setTransaction($transaction)
	{
		if(!$this->ts_enable)
		{
			return;
		}
		
		$this->ts_flag = $transaction;
	}

	public function begin()
	{
		if(!$this->ts_enable)
		{
			return true;
		}
		
		if(!$this->ts_flag)
		{
			return false;
		}
		if(!$this->c)
		{
			$this->connect();
		}
		
		if(!mysqli_autocommit($this->dblink, FALSE))
		{
			if($this->abort)
			{
				throw new Exception("DB Autocommit Change Fail");
			}
			return false;
		}
		
		return true;
	}

	public function end($rollback_flag = false)
	{
		if(!$this->ts_enable)
		{
			return true;
		}
		
		if(!$this->ts_flag)
		{
			return true;
		}
		
		if($this->ts_result && !$rollback_flag)
		{
			mysqli_commit($this->dblink);
			return true;
		}
		else
		{
			mysqli_rollback($this->dblink);
			return false;
		}
		
		return false;
	}

	public function query($query)
	{
		if(func_num_args() == 0)
		{
			return;
		}
		
		if($this->result_buff !== null)
		{
			free($this->result_buff);
		}
		
		if(!$this->c)
		{
			$this->connect($query);
		}
		$result = null;
		
		if($this->ts_flag)
		{
			$stmt = null;
			if(mysqli_real_query($this->dblink, $query))
			{
				$this->ts_result = true;
				return $this->store();
			}
			else
			{
				$this->ts_result = false;
				return null;
			}
		}
		else
		{
			if(mysqli_real_query($this->dblink, $query))
			{
				return $this->store();
			}
			else
			{
				$command = \GetParam("command");
				$action = \GetParam("action");
				$access_token = \GetParam("Token");
				$log_query = str_replace("\"", "\"\"", $query);
				if($this->logout)
				{
					\Log::debug(LOGTYPE_DB, "Query Logout Error", array($command, $action, $access_token, "\"" . $log_query . "\"", mysqli_error($this->dblink)));
				}
				if($this->abort)
				{
					\Log::info(LOGTYPE_ERROR, "Query Abort Error", array($command, $action, $access_token, "\"" . $log_query . "\""));
					throw new Exception("DB Query Error.($query)");
				}
				return null;
			}
		}
	}

	public function escape($text)
	{
		return mysqli_real_escape_string($this->dblink, $text);
	}

	public function GetLastestID()
	{
		return mysqli_insert_id($this->dblink);
	}

	public function set_abort($abort)
	{
		$this->abort = $abort;
	}

	public function set_logout($logout)
	{
		$this->logout = $logout;
	}
}

?>
