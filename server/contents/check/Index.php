<?php

namespace check;

function c_Index()
{
    return array();
}

function c_Bind()
{
    $ret = array();
    $ret['ClientId'] = GetParam("ClientId");
    if(empty($ret['ClientId']))
    {
        return null;
    }
    return $ret;
}

function c_test()
{
    return array();
}