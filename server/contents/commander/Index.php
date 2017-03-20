<?php
namespace command;
require_once (PROJECT_PATH . "/contents/function/GatewayWorker.php");

function e_Index($request)
{
    $guid = \utl\getGuid();
    $platform = GetParam("Platform");
    \O\Set("UserParams", \DB\Query("SELECT * FROM UserParams WHERE Identifier = %s", $guid));
    \O\Set("ServerList", GetServerList($platform));
}

function e_Bind($request)
{
    $guid = \utl\getGuid();
    $clientId = GetParam("ClientId");
    \func\BindUid($clientId, $guid);
    \func\BindGroup($clientId, -1);
    \O\Set("Result", true);
}

function e_test($request)
{
    \func\SendToUid("100013", json_encode(array("type"=>"note","msg"=>array("sendid"=> \utl\getGuid(),"msg"=>"test"))));
    \O\Set("Result", true);
}