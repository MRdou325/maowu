<?php
namespace func;

function initUserInfo($platform, $os, $ip, $deviceId)
{
    $date = time();
    \DB\Query("INSERT INTO User (Platform, OS, IP, CreateTime, LastTime, Server, LastServer, DeviceId) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", $platform, $os, $ip, $date, $date, "", "", $deviceId);
    $user = \DB\Query("SELECT * FROM User WHERE Platform = %s AND DeviceId = %s ORDER BY Identifier DESC LIMIT 1", $platform, $deviceId);
    if($user)
    {
        \DB\Query("DELETE FROM UserParams Where Identifier = %s", $user['Identifier']);
        $userAddr = GetIpForAddr($ip);
        \DB\Query("INSERT INTO UserParams (Identifier, UserName, Level, CreateTime, LastTime, Country, Province, City) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", $user['Identifier'], "MW".$user['Identifier'], 1, $date, $date, $userAddr['country'], $userAddr['province'], $userAddr['city']);
        \O\Set("User", $user);
        return $user['Identifier'];
    }
    return false;
}

function GetIpForAddr($ip){  
    if(empty($ip)){  
        $ip = GetIp();  
    }
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
    if(empty($res)){ return false; }  
    $jsonMatches = array();  
    preg_match('#\{.+?\}#', $res, $jsonMatches);  
    if(!isset($jsonMatches[0])){ return false; }  
    $json = json_decode($jsonMatches[0], true);  
    if(isset($json['ret']) && $json['ret'] == 1){  
        $json['ip'] = $ip;  
        unset($json['ret']);  
    }else{  
        return false;  
    }  
    return $json;  
} 

function GetIp(){
    $realip = '';
    $unknown = 'unknown';
    if (isset($_SERVER)){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach($arr as $ip){
                $ip = trim($ip);
                if ($ip != 'unknown'){
                    $realip = $ip;
                    break;
                }
            }
        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){
            $realip = $_SERVER['REMOTE_ADDR'];
        }else{
            $realip = $unknown;
        }
    }else{
        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){
            $realip = getenv("HTTP_CLIENT_IP");
        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){
            $realip = getenv("REMOTE_ADDR");
        }else{
            $realip = $unknown;
        }
    }
    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;
    return $realip;
}