<?php
namespace func;

require_once (PROJECT_PATH . "/framework/Gateway.php");
use GatewayClient\Gateway;

function BindUid($client_id,$guid)
{
    Gateway::bindUid($client_id, $guid);
    Gateway::sendToUid($guid, json_encode(array('type'=>"note","msg"=>"bind success")));
}

function BindGroup($client_id, $group)
{
    Gateway::joinGroup($client_id, $group);
    Gateway::sendToClient($client_id,  json_encode(array('type'=>"note","msg"=>"join group success")));
}

function SendToUid($guid, $message)
{
    Gateway::sendToUid($guid, $message);
}

function SendToGroup($group, $message)
{
    Gateway::sendToGroup($group, $message);
}

function SendToAll($message)
{
    Gateway::sendToAll($message);
}