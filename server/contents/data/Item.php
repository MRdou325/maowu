<?php
$ItemData = array(
    1000 => array(
        "ItemId" => 1000,
        "Name" => "元宝",
        "Type" => "Item",    //道具Item，武器Equip，飞机Card
        "IsShop" => true,   //是否再商店显示
        "IsPay" => true,  //是否充值
        "PayPrice" => array(
            0=>array(   //人民币
                6 => 10,    //6元=>10个元宝
                10 =>20,
                30 =>70,
            ),
            1 => array( //美元
                0.99 =>10,
            ),
        ),
    ),
);