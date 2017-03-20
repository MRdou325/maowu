/*
Navicat MySQL Data Transfer

Source Server         : 192.168.200.114
Source Server Version : 50716
Source Host           : 192.168.200.114:3306
Source Database       : server_db

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2017-03-20 15:23:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alone
-- ----------------------------
DROP TABLE IF EXISTS `alone`;
CREATE TABLE `alone` (
  `Identifier` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `JoinTime` int(11) NOT NULL,
  PRIMARY KEY (`Identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of alone
-- ----------------------------

-- ----------------------------
-- Table structure for network
-- ----------------------------
DROP TABLE IF EXISTS `network`;
CREATE TABLE `network` (
  `UserId` int(11) NOT NULL DEFAULT '0',
  `Token` varchar(255) NOT NULL DEFAULT '',
  `Time` int(11) NOT NULL DEFAULT '0',
  `SessionId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of network
-- ----------------------------
INSERT INTO `network` VALUES ('1', '610711654', '1488865871', '0');
INSERT INTO `network` VALUES ('100000', '1848324754', '1488958589', '0');

-- ----------------------------
-- Table structure for Online
-- ----------------------------
DROP TABLE IF EXISTS `Online`;
CREATE TABLE `Online` (
  `Identifier` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  PRIMARY KEY (`Identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Online
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Avatar` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Summary` varchar(255) NOT NULL COMMENT '简介',
  `Level` int(11) NOT NULL,
  `Score` int(11) NOT NULL COMMENT '积分',
  `MaxFight` int(11) NOT NULL,
  `TeamMaxFight` int(11) NOT NULL,
  `Gold` int(11) NOT NULL,
  `CreateTime` int(11) NOT NULL,
  `LastTime` int(11) NOT NULL,
  `BlackListType` tinyint(3) NOT NULL DEFAULT '1' COMMENT '黑名单：1临时，2永久',
  `BlackListTime` int(11) NOT NULL DEFAULT '0',
  `BackList` text,
  `Tutorial` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
