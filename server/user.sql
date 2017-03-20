/*
Navicat MySQL Data Transfer

Source Server         : 192.168.200.114
Source Server Version : 50716
Source Host           : 192.168.200.114:3306
Source Database       : user

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2017-03-20 15:23:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blacklist
-- ----------------------------
DROP TABLE IF EXISTS `blacklist`;
CREATE TABLE `blacklist` (
  `Identifier` int(11) NOT NULL DEFAULT '0',
  `TargetId` int(11) NOT NULL,
  `CreateTime` int(11) NOT NULL,
  PRIMARY KEY (`Identifier`,`TargetId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blacklist
-- ----------------------------

-- ----------------------------
-- Table structure for equip
-- ----------------------------
DROP TABLE IF EXISTS `equip`;
CREATE TABLE `equip` (
  `EquipId` int(11) NOT NULL,
  `Identifier` int(11) NOT NULL,
  `Level` int(11) NOT NULL DEFAULT '1',
  `CreateTime` int(11) NOT NULL,
  `CardId` int(11) NOT NULL,
  `Exp` int(11) NOT NULL,
  PRIMARY KEY (`EquipId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equip
-- ----------------------------

-- ----------------------------
-- Table structure for fighter
-- ----------------------------
DROP TABLE IF EXISTS `fighter`;
CREATE TABLE `fighter` (
  `FighterId` int(11) NOT NULL,
  `Identifier` int(11) NOT NULL,
  `CardId` int(11) NOT NULL,
  `Level` int(11) NOT NULL DEFAULT '1',
  `CreateTime` int(11) NOT NULL,
  `Exp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FighterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fighter
-- ----------------------------

-- ----------------------------
-- Table structure for friend
-- ----------------------------
DROP TABLE IF EXISTS `friend`;
CREATE TABLE `friend` (
  `RequestId` int(11) NOT NULL,
  `ReceiveId` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '状态：1未同意 2已同意',
  `RequestTime` int(11) NOT NULL,
  `ReceiveTime` int(11) NOT NULL,
  PRIMARY KEY (`RequestId`,`ReceiveId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friend
-- ----------------------------

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `ItemId` int(11) NOT NULL,
  `Identifier` int(11) NOT NULL DEFAULT '0',
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`Identifier`,`ItemId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item
-- ----------------------------

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `MessageId` int(11) NOT NULL,
  `Sender` int(11) NOT NULL COMMENT '发送者：0为系统',
  `TargetId` int(11) NOT NULL COMMENT '接受者：0为所有人',
  `Status` text COMMENT '状态：记录已读Id',
  `Content` text,
  `CreateTime` int(11) NOT NULL,
  `Other` text COMMENT '其他信息：如发送奖励的奖励ID',
  `Type` tinyint(4) NOT NULL COMMENT '类型：1系统消息  2好友消息  3战斗消息  ',
  PRIMARY KEY (`MessageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for network
-- ----------------------------
DROP TABLE IF EXISTS `network`;
CREATE TABLE `network` (
  `Identifier` int(11) NOT NULL DEFAULT '0',
  `Token` varchar(255) NOT NULL DEFAULT '',
  `Time` int(11) NOT NULL DEFAULT '0',
  `SessionId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Identifier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of network
-- ----------------------------
INSERT INTO `network` VALUES ('0', '612687156', '1489677118', '0');
INSERT INTO `network` VALUES ('1', '610711654', '1488865871', '0');
INSERT INTO `network` VALUES ('100000', '1597977854', '1488866455', '0');
INSERT INTO `network` VALUES ('100013', '171629883', '1489987627', '0');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `ShopId` int(11) NOT NULL,
  `Identifier` int(11) NOT NULL DEFAULT '0',
  `ItemId` int(11) NOT NULL,
  `CreateTime` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Type` tinyint(4) NOT NULL COMMENT '货币类型',
  `Gold` int(11) NOT NULL COMMENT '货币数量',
  PRIMARY KEY (`ShopId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop
-- ----------------------------

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `TransId` int(20) NOT NULL,
  `Identifier` int(11) NOT NULL DEFAULT '0',
  `GoldId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Price` decimal(11,2) NOT NULL,
  `Type` tinyint(4) NOT NULL COMMENT '货币种类：美元，人民币',
  `PlatId` int(11) NOT NULL,
  `PlatForm` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL COMMENT '状态：1代付款 2已付款',
  `CreateTime` int(11) DEFAULT NULL,
  `ComplateTime` int(11) DEFAULT NULL COMMENT '完成时间',
  PRIMARY KEY (`TransId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transaction
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `LoginName` varchar(255) DEFAULT '',
  `PassWord` varchar(255) DEFAULT '',
  `CreateTime` int(11) NOT NULL,
  `LastTime` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT '',
  `Mac` varchar(255) DEFAULT '',
  `PlatForm` int(11) NOT NULL,
  `OS` varchar(255) NOT NULL,
  `Server` varchar(255) DEFAULT '',
  `LastServer` text,
  `IP` varchar(16) DEFAULT NULL,
  `DeviceId` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=100017 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('100000', '', '', '1488782132', '1488782395', '', '38:c9:86:51:13:ba', '0', 'Browser', '', '', '192.168.200.114', '');
INSERT INTO `user` VALUES ('100001', '', '', '1489246098', '1489246098', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100002', '', '', '1489246184', '1489246184', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100003', '', '', '1489246248', '1489246248', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100004', '', '', '1489246311', '1489246311', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100005', '', '', '1489246354', '1489246354', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100006', '', '', '1489246500', '1489246500', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100007', '', '', '1489246546', '1489246546', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100008', '', '', '1489246642', '1489246642', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100009', '', '', '1489246777', '1489246777', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100010', '', '', '1489246821', '1489246821', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100011', '', '', '1489246923', '1489246923', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100012', '', '', '1489246950', '1489246950', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100013', '', '', '1489246996', '1489246996', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100014', '', '', '1489250686', '1489250686', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100015', '', '', '1489499192', '1489499192', '', '', '0', 'Browser', '', '', '127.0.0.1', '');
INSERT INTO `user` VALUES ('100016', '', '', '1489677115', '1489677115', '', '', '0', 'Browser', '', '', '127.0.0.1', '');

-- ----------------------------
-- Table structure for userparams
-- ----------------------------
DROP TABLE IF EXISTS `userparams`;
CREATE TABLE `userparams` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `Avatar` varchar(255) NOT NULL DEFAULT 'default.png',
  `UserName` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL,
  `Summary` varchar(255) NOT NULL DEFAULT '这个家伙很懒，什么都没有留下' COMMENT '简介',
  `Level` int(11) NOT NULL DEFAULT '1',
  `Score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `MaxFight` int(11) NOT NULL DEFAULT '0',
  `TeamMaxFight` int(11) NOT NULL DEFAULT '0',
  `Gold` int(11) NOT NULL DEFAULT '0' COMMENT '充值元宝数量',
  `CreateTime` int(11) NOT NULL DEFAULT '0',
  `LastTime` int(11) NOT NULL DEFAULT '0',
  `BlackListType` tinyint(3) NOT NULL DEFAULT '0' COMMENT '黑名单：1临时，2永久',
  `BlackListTime` int(11) NOT NULL DEFAULT '0',
  `BackList` text,
  `Tutorial` int(11) NOT NULL DEFAULT '1',
  `CheckIn` tinyint(3) NOT NULL DEFAULT '0' COMMENT '签到',
  `Leader` int(11) NOT NULL DEFAULT '0',
  `Medal` int(11) NOT NULL DEFAULT '0' COMMENT '奖章，勋章',
  PRIMARY KEY (`Identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=100017 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of userparams
-- ----------------------------
INSERT INTO `userparams` VALUES ('100000', '', 'MW100000', '', '', '', '', '1', '0', '0', '0', '0', '1489246248', '1489246248', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100004', '', 'MW100004', '', '', '', '', '1', '0', '0', '0', '0', '1489246311', '1489246311', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100005', '', 'MW100005', '', '', '', '', '1', '0', '0', '0', '0', '1489246354', '1489246354', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100006', '', 'MW100006', '', '', '', '', '1', '0', '0', '0', '0', '1489246500', '1489246500', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100007', '', 'MW100007', '', '', '', '', '1', '0', '0', '0', '0', '1489246546', '1489246546', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100008', '', 'MW100008', '', '', '', '', '1', '0', '0', '0', '0', '1489246642', '1489246642', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100009', '', 'MW100009', '', '', '', '', '1', '0', '0', '0', '0', '1489246777', '1489246777', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100010', '', 'MW100010', '', '', '', '', '1', '0', '0', '0', '0', '1489246821', '1489246821', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100011', '', 'MW100011', '', '', '', '', '1', '0', '0', '0', '0', '1489246923', '1489246923', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100012', '', 'MW100012', '', '', '', '', '1', '0', '0', '0', '0', '1489246950', '1489246950', '1', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100013', '', '什么鬼', '', '', '', '', '1', '0', '0', '0', '0', '1488988785', '1489987627', '1', '0', '2,4,9,12', '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100014', 'default.png', 'MW100014', '', '', '', '这个家伙很懒，什么都没有留下', '1', '0', '0', '0', '0', '1489250686', '1489250686', '0', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100015', 'default.png', 'MW100015', '', '', '', '这个家伙很懒，什么都没有留下', '1', '0', '0', '0', '0', '1489499192', '1489499192', '0', '0', null, '1', '0', '0', '0');
INSERT INTO `userparams` VALUES ('100016', 'default.png', 'MW100016', '', '', '', '这个家伙很懒，什么都没有留下', '1', '0', '0', '0', '0', '1489677115', '1489677115', '0', '0', null, '1', '0', '0', '0');
