<?php

/**
 * 必须参数
 * ++++++++++++++++++++
 * 收信人地址
 * $email_to 例如zhangsan@126.com
 * 邮件标题
 * $email_subject 例如 祝贺您称为sharpng的客户
 * 邮件内容
 * $email_message 例如 sharpng是最好的wap建站程序之一,在您的帮助下,sharpng将会更好的成长
 * 发送方式(三选一)
 * $mailsend=1 通过 PHP 函数的 sendmail 发送(推荐此方式)
 * $mailsend=2 通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)
 * $mailsend=3 通过 PHP 函数 SMTP 发送 Email(仅 Windows 主机下有效, 不支持 ESMTP 验证)
 * 邮件头的分隔符,请根据您邮件服务器的设置调整此参数(三选一)
 * $maildelimiter=0 使用 LF 作为分隔符(通常为 Unix/Linux 主机)
 * $maildelimiter=1 使用 CRLF 作为分隔符(通常为 Windows 主机)
 * $maildelimiter=2 使用 CR 作为分隔符(通常为 Mac 主机)
 * 屏蔽邮件发送中的全部错误提示(二选一)
 * $mailsilent=1 是
 * $mailsilent=0否
 * ++++++++++++++++++++
 * 下面的 参数根据$mailsend参数的值选择性输入
 * ----------
 * 假如$mailsend=2/3
 * $mailserver SMTP 服务器,例如smtp.126.com
 * $mailport SMTP 端口 默认为 25,例如25
 * ----------
 * 假如$mailsend=2
 * $mailauth=1 是/$mailauth=0 否 - 要求身份验证,如果 SMTP 服务器要求身份验证才可以发信，请选择“是”(二选一)
 * $mailfrom 发信人邮件地址 如果需要验证, 必须为本服务器的邮件地址。邮件地址中如果要包含用户名，格式为“username <user@domain.com>”，也可以只填地址,例如 zhangsan@126.com
 * $mailauth_username SMTP 身份验证用户名，如126邮箱的是zhangsan@126.com
 * $mailauth_password SMTP 身份验证密码
 * ----------
 * 使用方法
 * $email_to = 'zhangsan@126.com,sjf122@gmail.com';//email地址,多个地址用,分隔开
 * $email_subject = '邮件标题';//email标题
 * $email_message = '邮件内容';//邮件内容
 * $charset = 'UTF-8';//邮件编码
 * $mailconf = array(
 * 'mailsend'=>'2',
 * 'mailserver'=>'smtp.126.com',
 * 'mailport'=>'25',
 * 'mailauth'=>'1',
 * 'mailfrom'=>'sjf122 <sjf122@126.com>',
 * 'mailauth_username'=>'sjf122@126.com',
 * 'mailauth_password'=>'******',
 * 'maildelimiter'=>'0',
 * 'mailsilent'=>'0',
 * );
 * sendMail($email_to, $email_subject, $email_message, $charset, $mailconf);
 */
namespace email;

require_once (dirname(__FILE__) . "/../config/config.inc");
require_once (dirname(__FILE__) . "/DBManager.php");
require_once (dirname(__FILE__) . "/Log.php");

function sendMail($email_to, $email_subject, $email_message, $charset, $mailconf)
{
	while(list($k, $v) = each($mailconf))
	{
		($k == 'mailsend') ? $mailsend = $v : '';
		($k == 'mailserver') ? $mailserver = $v : '';
		($k == 'mailport') ? $mailport = $v : '';
		($k == 'mailauth') ? $mailauth = $v : '';
		($k == 'mailfrom') ? $mailfrom = $v : '';
		($k == 'mailauth_username') ? $mailauth_username = $v : '';
		($k == 'mailauth_password') ? $mailauth_password = $v : '';
		($k == 'maildelimiter') ? $maildelimiter = $v : '';
		($k == 'mailsilent') ? $sendmail_silent = $v : '';
		($k == 'maillogfile') ? $maillogfile = $v : '';
	}
	
	if($sendmail_silent)
	{
		error_reporting(0);
	}
	
	// 分隔符
	$maildelimiter = !empty($maildelimiter) ? "\r\n" : "\n";
	// $email_subject= '=?'.$charset.'?B?'.base64_encode(str_replace("\r", '', str_replace("\n", '', $email_subject))).'?=';
	$mailsite = strstr($email_to, '@');
	$log_message = $email_message;
	$log_fp = false;
	
	if(in_array($mailsite, array(
		'@gmail.com' 
	)))
	{
		$email_message = str_replace("\r\n.", " \r\n..", str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $email_message)))));
	}
	else
	{
		$email_message = chunk_split(base64_encode(str_replace("\r\n.", " \r\n..", str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $email_message)))))));
	}
	
	foreach(explode(',', $email_to) as $touser)
	{
		$tousers[] = $touser;
	}
	$email_to = implode(',', $tousers);
	
	$headers = "From: $mailfrom{$maildelimiter}MIME-Version: 1.0{$maildelimiter}Content-type: text/html; charset=$charset{$maildelimiter}Content-Transfer-Encoding: base64{$maildelimiter}";
	
	if($mailsend == 1 && function_exists('mail'))
	{
		@mail($email_to, $email_subject, $email_message, $headers);
	}
	elseif($mailsend == 2)
	{
		if(!$fp = fsockopen($mailserver, $mailport, $errno, $errstr, 30))
		{
			die("SMTP($mailserver:$mailport CONNECT - Unable to connect to the SMTP server");
			log($log_fp, $maillogfile, "SMTP($mailserver:$mailport CONNECT - Unable to connect to the SMTP server");
		}
		
		stream_set_blocking($fp, true);
		
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != '220')
		{
			die("SMTP($mailserver:$mailport CONNECT - $lastmessage");
			log($log_fp, $maillogfile, "SMTP($mailserver:$mailport CONNECT - $lastmessage");
		}
		
		send($fp, ($mailauth ? 'EHLO' : 'HELO') . " SupeSite\r\n", $log_fp, $maillogfile);
		$lastmessage = fgets($fp, 512);
		log($log_fp, $maillogfile, $lastmessage);
		if(substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250)
		{
			die("SMTP($mailserver:$mailport HELO/EHLO - $lastmessage");
			log($log_fp, $maillogfile, "SMTP($mailserver:$mailport HELO/EHLO - $lastmessage");
		}
		
		while(1)
		{
			if(substr($lastmessage, 3, 1) != '-' || empty($lastmessage))
			{
				break;
			}
			$lastmessage = fgets($fp, 512);
			log($log_fp, $maillogfile, $lastmessage);
		}
		
		if($mailauth)
		{
			send($fp, "AUTH LOGIN\r\n", $log_fp, $maillogfile);
			$lastmessage = fgets($fp, 512);
			log($log_fp, $maillogfile, $lastmessage);
			if(substr($lastmessage, 0, 3) != 334)
			{
				die("SMTP($mailserver:$mailport AUTH LOGIN - $lastmessage");
				log($log_fp, $maillogfile, "SMTP($mailserver:$mailport AUTH LOGIN - $lastmessage");
			}
			
			send($fp, base64_encode($mailauth_username) . "\r\n", $log_fp, $maillogfile);
			$lastmessage = fgets($fp, 512);
			log($log_fp, $maillogfile, $lastmessage);
			if(substr($lastmessage, 0, 3) != 334)
			{
				die("SMTP($mailserver:$mailport USERNAME - $lastmessage");
				log($log_fp, $maillogfile, "SMTP($mailserver:$mailport USERNAME - $lastmessage");
			}
			
			send($fp, base64_encode($mailauth_password) . "\r\n", $log_fp, $maillogfile);
			$lastmessage = fgets($fp, 512);
			log($log_fp, $maillogfile, $lastmessage);
			if(substr($lastmessage, 0, 3) != 235)
			{
				die("SMTP($mailserver:$mailport PASSWORD - $lastmessage");
				log($log_fp, $maillogfile, "SMTP($mailserver:$mailport PASSWORD - $lastmessage");
			}
			
			$mailfrom = $mailfrom;
		}
		
		send($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $mailfrom) . ">\r\n", $log_fp, $maillogfile);
		$lastmessage = fgets($fp, 512);
		log($log_fp, $maillogfile, $lastmessage);
		if(substr($lastmessage, 0, 3) != 250)
		{
			send($fp, "MAIL FROM: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $mailfrom) . ">\r\n", $log_fp, $maillogfile);
			$lastmessage = fgets($fp, 512);
			log($log_fp, $maillogfile, $lastmessage);
			if(substr($lastmessage, 0, 3) != 250)
			{
				die("SMTP($mailserver:$mailport  MAIL FROM - $lastmessage");
				log($log_fp, $maillogfile, "SMTP($mailserver:$mailport  MAIL FROM - $lastmessage");
			}
		}
		
		foreach(explode(',', $email_to) as $touser)
		{
			$touser = trim($touser);
			if($touser)
			{
				send($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser) . ">\r\n", $log_fp, $maillogfile);
				$lastmessage = fgets($fp, 512);
				log($log_fp, $maillogfile, $lastmessage);
				if(substr($lastmessage, 0, 3) != 250)
				{
					send($fp, "RCPT TO: <" . preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser) . ">\r\n", $log_fp, $maillogfile);
					$lastmessage = fgets($fp, 512);
					log($log_fp, $maillogfile, $lastmessage);
					die("SMTP($mailserver:$mailport  RCPT TO - $lastmessage");
					log($log_fp, $maillogfile, "SMTP($mailserver:$mailport  RCPT TO - $lastmessage");
				}
			}
		}
		
		send($fp, "DATA\r\n", $log_fp, $maillogfile);
		$lastmessage = fgets($fp, 512);
		log($log_fp, $maillogfile, $lastmessage);
		if(substr($lastmessage, 0, 3) != 354)
		{
			die("SMTP($mailserver:$mailport DATA - $lastmessage");
			log($log_fp, $maillogfile, "SMTP($mailserver:$mailport DATA - $lastmessage");
		}
		
		$headers .= 'Message-ID: <' . gmdate('YmdHs') . '.' . substr(md5($email_message . microtime()), 0, 6) . '@' . $_SERVER['HTTP_HOST'] . ">{$maildelimiter}X-Priority: 3{$maildelimiter}X-Mailer: 魔界之王! Mailer{$maildelimiter}";
		
		send($fp, "Date: " . gmdate('r') . "\r\n", $log_fp, $maillogfile);
		send($fp, "To: " . $email_to . "\r\n", $log_fp, $maillogfile);
		send($fp, "Subject: " . $email_subject . "\r\n", $log_fp, $maillogfile);
		send($fp, $headers . "\r\n", $log_fp, $maillogfile);
		fputs($fp, "\r\n\r\n$email_message\r\n.\r\n");
		log($log_fp, $maillogfile, "$log_message\r\n\r\n", 1);
		send($fp, "QUIT\r\n", $log_fp, $maillogfile);
	}
	elseif($mailsend == 3)
	{
		ini_set('SMTP', $mailserver);
		ini_set('smtp_port', $mailport);
		ini_set('sendmail_from', $mailfrom);
		
		@mail($email_to, $email_subject, $email_message, $headers);
	}
}

function send($fp, $text, $log_fp, $maillogfile)
{
	fputs($fp, $text);
	log($log_fp, $maillogfile, $text, 1);
}

function log(&$log_fp, $log_file, $text, $mode = 0)
{
	// open file
	if(!$log_file)
	{
		return;
	}
	
	if(!$log_fp)
	{
		if(!($log_fp = fopen($log_file, 'a')))
			return;
		fwrite($log_fp, "\r\n-------------------------------------------\r\n");
		fwrite($log_fp, " Sent " . date("Y-m-d H:i:s") . "\r\n");
		fwrite($log_fp, "-------------------------------------------\r\n");
	}
	
	// write to log
	if(!$mode)
	{
		fwrite($log_fp, "	$text\r\n");
	}
	else
	{
		fwrite($log_fp, "$text\r\n");
	}
}