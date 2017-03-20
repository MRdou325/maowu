<?php
namespace command;
require_once (PROJECT_PATH . "/contents/function/Cache.php");
/**
 * 充值开始
 * @param array $request
 */
function e_PayStart($request)
{
    $guid = \utl\getGuid();
    $goldId = GetParam("GoldId");
    $amount = GetParam("Amount");
    $price = GetParam("Price");
    $platform = GetParam("Platform");
    $type = GetParam("MoneyType");//货币类型
    $platId = \cache\Get($guid, "User", "PlatId");
    require_once(DATA_ROOT . "Item.php");
    if(empty($ItemData[$goldId]) || $ItemData[$goldId]["IsPay"] === false)
    {
        return \utl\GameError(\func\GetMessage(BUY_LIMIT));
    }
    $goldInfo = $ItemData[$goldId];
    if(empty($goldInfo["PayPrice"][$type]) || empty($goldInfo["PayPrice"][$type][$price]))
    {
        return \utl\GameError(\func\GetMessage(BUY_ERROR2));
    }
    if($goldInfo["PayPrice"][$type][$price] != $amount)
    {
        return \utl\GameError(\func\GetMessage(BUY_ERROR5));
    }
    $transId = date("YmdHis").rand(1000,9999);
    \DB\Query("INSERT INTO Transaction (TransId, Identifier, GoldId, Amount, Price, Type, PlatId, PlatForm, Status, CreateTime, ComplateTime) VALUE (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $transId,$guid,$goldId,$amount,$price,$type,$platId,$platform,1,time(),0);
    $transInfo = \DB\Query("SELECT * From Transaction WHERE Identifier = %s ORDER BY CreateTime DESC LIMIT 1");
    \O\Set("TransactionId", $transInfo['TransId']);
    \O\Set("Result", true);
}

/**
 * 充值结束
 * @param unknown $request
 */
function e_PayResult($request)
{
    $guid = \utl\getGuid();
    $result = $request['Result'];
    $transId = $request['TransId'];
    if($result != 2)
    {
        return \utl\GameError(\func\GetMessage(BUY_FAILURE));
    }
    $transInfo = \DB\Query("SELECT * FROM Transaction WHERE Identifier = %s AND TransId = %s", $guid, $transId);
    if($transInfo['Status'] != 1)
    {
        return \utl\GameError(\func\GetMessage(BUY_ERROR13));
    }
    $items = array(array("ItemId" => $transInfo['GoldId'], "Type" => \func\GetItemType($transInfo['GoldId']),"Amount" => $transInfo['Amount'],"Flag" => true));
    \func\GetItem($guid, $items);
    \DB\Query("UPDATE Transaction SET Status = 2 , ComplateTime = %s WHERE Identifier = %s AND TransId = %s", time(), $guid, $transId);
    \O\Set("Result", true);
}

/**
 * 店铺购买
 * @param unknown $request
 */
function e_Buy($request)
{
    
}