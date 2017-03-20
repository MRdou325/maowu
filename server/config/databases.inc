<?php
/**
 * 2013-5-16 lizhien 数据库相关
 */
$DataBaseDefinition = array(
    "User" => array(    //用户数据服务器，默认主服务器，战斗服务器结束时更新用户信息
        "host" => "127.0.0.1",
        "port" => "3306",
        "user" => "root1",
        "pass" => "123456",
        "db" => "user",
        "transaction" => false,
    ),
    "Main" => array(
        0 =>array(  //没有选择服务器时的默认主服务器
            "host" => "127.0.0.1",
            "port" => "3306",
            "user" => "root1",
            "pass" => "123456",
            "db" => "user",
            "transaction" => false,
        ),
        1 => array(
            "host" => "127.0.0.1",
            "port" => "3306",
            "user" => "root1",
            "pass" => "123456",
            "db" => "server_db1",
            "transaction" => false,
        ),
        2 => array(
            "host" => "127.0.0.1",
            "port" => "3306",
            "user" => "root2",
            "pass" => "123456",
            "db" => "server_db2",
            "transaction" => false,
        ),
    ),
);

$serverId = empty(GetParam("ServerId")) ? 0 : GetParam("ServerId");
$DataBaseDefinition["Main"] = $DataBaseDefinition["Main"][$serverId];

	// print_r($DataBaseDefinition);
?>
