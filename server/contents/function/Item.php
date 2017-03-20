<?php
namespace func;

function GetItemAmount($guid, $itemid, $flag = true)
{
    $itemInfo = \DB\Query("SELECT * FROM Item WHERE ItemId = %s AND Identifier = %s", $itemid, $guid);
    if ($itemInfo)
    {
        return $itemInfo['Amount'];
    }
    return $flag ? 0 : false;
}

function GetItemType($itemid)
{
    require_once(DATA_ROOT . "Item.php");
    if(empty($ItemData[$itemid]))
    {
        return "Item";
    }
    return $ItemData[$itemid]["Type"];
}

function GetItem($guid, $items = array())
{
    if($items)
    {
        foreach ($items as $item)
        {
            switch ($item["Type"])
            {
                case "Item":
                    if($item["Flag"])
                    {
                        AddItem($guid, $item['ItemId'], $item['Amount']);
                    }
                    else
                    {
                        DelItem($guid, $item['ItemId'], $item['Amount']);
                    }
                    break;
                case "Equip":
                    break;
                case "Card":
                    break;
            }
        }
    }
}

function AddItem($guid, $itemid, $amount)
{
    $res = GetItemAmount($guid, $itemid);
    if ($res === false){
        \DB\Query("INSERT INFO Item (ItemId, Identifier, Amount) VALUE (%s, %s, %s)", $itemid, $guid, $amount);
    }else{
        \DB\Query("UPDATE Item SET Amount = Amount + %s WHERE ItemId = %s AND Identifier = %s)", $amount, $itemid, $guid);
    }
}

function DelItem($guid, $itemid, $amount)
{
    \DB\Query("UPDATE Item SET Amount = Amount - %s WHERE ItemId = %s AND Identifier = %s)", $amount, $itemid, $guid);
}