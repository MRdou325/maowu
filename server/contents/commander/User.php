<?php
namespace command;

function e_SetUserName($request)
{
    $name = $request["Name"];
    $name_len = (strlen($name) + mb_strlen($name, 'utf-8')) / 4;
    require (DATA_ROOT . "/FilterWords.php");
    if($name_len < 2)
    {
        return \utl\GameError(\func\GetMessage("ERROR_0057"));
    }
    else if($name_len > 5)
    {
        return \utl\GameError(\func\GetMessage("ERROR_0058"));
    }
    else if(in_array($name, $FilterWords))
    {
        return \utl\GameError(\func\GetMessage("ERROR_0078"));
    }
    else
    {
        $reg = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u'; // 匹配中文字符，数字，字母的正则表达式
        if(!preg_match($reg, $name))
        {
            return \utl\GameError(\func\GetMessage("ERROR_0059"));
        }
    }
    $user = \DB\Query("SELECT * FROM UserParams WHERE UserName = %s", $name);
    if($user)
    {
        return \utl\GameError(\func\GetMessage("ERROR_0056"));
    }
    \DB\Query("UPDATE UserParams SET UserName = %s WHERE Identifier = %s", $name, \utl\getGuid());
    \O\Set("Result", true);
}