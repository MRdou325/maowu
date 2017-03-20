<?php
/**
 * 2013-5-15 lizhien 定义全局变量
 */
define("AUTH_USING_DATABASE", 1);
define("TOKEN_USING_DATABASE", 1);

define("DEV_RELEASE", 1);
define("DEV_DEVELOP", 2);
define("EM_RELEASE", 3);
define("EM_DEVELOP", 4);

define("PLATFORM_MBGA", 1);
define("PLATFORM_GREE", 2);
define("PLATFORM_HANGE", 3);

define("FRAMEWORK_DEVELOP", 1);
define("FRAMEWORK_CALCS", 2);
define("FRAMEWORK_RELEASE", 3);

define("DB_PLAYER_TARGET", 1);
define("DB_MASTER_1_TARGET", 2);
define("DB_MASTER_2_TARGET", 3);
define("DB_MASTER_3_TARGET", 4);

define("DBTYPE_MYSQL_MYISAM", 1);
define("DBTYPE_MYSQL_INNODB", 2);
define("DBTYPE_MYSQLi_MYISAM", 3);
define("DBTYPE_MYSQLi_INNODB", 4);
define("DBTYPE_MONGODB", 5);

define("LOG_FILE_SIZE", 1024 * 1024 * 10);

define("LEVEL_DEBUG", 1);
define("LEVEL_INFO", 2);
define("LEVEL_WARNING", 4);
define("LEVEL_ERROR", 8);
define("LEVEL_TRACE", 16);
define("LEVEL_PAYMENT", 32);

define("MBGA_MOBILE_API", 1);
define("MBGA_SMARTPHONE_API", 2);
define("GREE_API", 4);

define("APIMODE_SANDBOX", 1);
define("APIMODE_RELEASE", 2);

define("SETTING_D_OPENSOCIAL", 0x1000);
define("SETTING_D_USERAGENT", 0x2000);
define("SETTING_D_GLOBAL", 0x4000);
define("EFFECTSKIP_BATTLE", 0x0001);

define("FORMAT_JSON", 1);
define("FORMAT_CSV", 2);
define("FORMAT_DUMP", 3);
?>