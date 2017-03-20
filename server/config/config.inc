<?php
/**
 * 2013-5-15 lizhien
 * 初始化配置
 */

// REQUIRE
require_once ("define.inc");
require_once ("serverlist.inc");
require_once ("platform.inc");

// GAMENAME
define("GAMENAME", "wushuang");

// TIMEZONE
date_default_timezone_set("Asia/Shanghai");

// MAIN
define("PROJECT_PATH", dirname(__FILE__) . "/../");
define("DATA_ROOT", dirname(__FILE__) . "/../contents/data/");
require_once (PROJECT_PATH . "/contents/Const.php");

// OTHER
define("IS_MAINTENANCE_IPHONE", false);
define("IS_MAINTENANCE_ANDROID", false);

define("WORKING_STYLE", FRAMEWORK_DEVELOP);
define("APIMODE", APIMODE_SANDBOX);

define("RESOURCE_IPHONE_URL", "Contents");
define("RESOURCE_IPHONE_LOW_URL", "Contents");
define("RESOURCE_IPHONE_JUDGE_URL", "Contents");
define("RESOURCE_IPHONE_JUDGE_LOW_URL", "Contents");
define("RESOURCE_ANDROID_URL", "Contents");

define("URL_ENCRYPTED", false);

define("SPLIT_LOAD", false);

define("LOG_LEVEL", (LEVEL_DEBUG | LEVEL_INFO | LEVEL_PAYMENT | LEVEL_WARNING | LEVEL_ERROR | LEVEL_TRACE));
define("LOG_OUTPUT_ACCESS_DATA_ENABLE", false);

define("LOG_OUTPUT_DB_ENABLE", true);
define("LOG_OUTPUT_DB_ACCESS_DATA_ENABLE", true);
define("LOG_OUTPUT_DB_ACCESS_DATA_REQUEST_ONLY", true);

define("AUTHORIZE_INTERFACE", AUTH_USING_DATABASE);
define("TOKENCHECK_INTERFACE", TOKEN_USING_DATABASE);
define("AUTH_EXPIRE_TIME", 1800);

// LANGUAGE
define("LANGUAGE", "cn");

define("UNITDATA", DATA_ROOT . "/Unit/UnitData.php");

// MEMCACHE
define("ENABLE_MEMCACHE", true);
define("MEMCACHE_HOST", "localhost");
define("DEFAULT_EXPIRE", 1800);

// SDK
define("PLARFORM", PLATFORM_MBGA);
define("USEAPI", (MBGA_MOBILE_API | MBGA_SMARTPHONE_API));
define("MBGAAPPID", 13000161);

// CHARSET
define("SYSTEM_CHARSET", "UTF-8");
define("OUTPUT_CHARSET", "UTF-8");
define("SYSTEM_REQUEST_CHARSET", "UTF-8");
define("FAKE_PLATFORM_API", false);

define("USING_DB_DRIVER", DBTYPE_MYSQLi_INNODB);
define("USING_DB_TRUNSUCTION", true);

define("PHP_ERROR_EXEC", "SAFE");
define("FLASH_EMULATION", TRUE);
define("OUTPUTFORMAT", FORMAT_JSON);
define("RELEASE_DATE", strtotime("2013/07/15 12:00:00"));

define("IDENTIFIER_MIN", 100000);
define("IDENTIFIER_MAX", 1000000);

?>