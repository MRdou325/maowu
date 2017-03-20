<?php

namespace check;

function c_default()
{
	return array();
}

function c_Login()
{
	$ret = array();
	
	$ret["LoginName"] = CheckParams("LoginName","用户名","string");
	$ret["PassWord"] = CheckParams("PassWord","密码","string");
	var_dump($ret);
	return $ret;
}

function c_Register()
{
    $ret = array();
    $ret["LoginName"] = CheckParams("LoginName","用户名","string");
    $ret["PassWord"] = CheckParams("PassWord","密码","string");
    return $ret;
}

?>