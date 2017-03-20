<?php
namespace check;

function c_SetUserName()
{
    $ret = array();
    $ret['Name'] = GetParam("NewName");
    return $ret;
}