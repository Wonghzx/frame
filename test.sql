/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.161
Source Server Version : 50542
Source Host           : 192.168.1.161:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2017-11-20 10:11:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fd
-- ----------------------------
DROP TABLE IF EXISTS `fd`;
CREATE TABLE `fd` (
  `fd` char(255) NOT NULL DEFAULT '0' COMMENT '用户id',
  `groups_id` char(255) NOT NULL DEFAULT '0' COMMENT '绑定id',
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户绑定表';

-- ----------------------------
-- Records of fd
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users` varchar(255) NOT NULL COMMENT '1,2,3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', '1,2,3');

-- ----------------------------
-- Table structure for msg
-- ----------------------------
DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '内容',
  `tid` char(255) NOT NULL DEFAULT '0' COMMENT '接收用户id',
  `fid` int(11) NOT NULL DEFAULT '0' COMMENT '发送用户id',
  `groups` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of msg
-- ----------------------------
INSERT INTO `msg` VALUES ('1', '阿萨德', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('2', 'as ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('3', 'asd ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('4', 'as ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('5', 'as ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('6', 'as ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('7', 'as ', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('8', '啊', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('9', '啊', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('10', '啊', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('11', '阿萨德', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('12', '按时', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('13', '123', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('14', '345', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('15', '456', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('16', '按时', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('17', '啊', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('18', '啊', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('19', '多少', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('20', '啊\n', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('21', '啊', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('22', '按时', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('23', '啊', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('24', '123', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('25', '345', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('26', '按时', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('27', '哈哈哈', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('28', '啊', '2,3', '1', '1', '1');
INSERT INTO `msg` VALUES ('29', '', '1,3', '2', '1', '1');
INSERT INTO `msg` VALUES ('30', '啊', '2,3', '1', '1', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_pwd` char(255) NOT NULL,
  `user_nickname` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '15217162610', 'MDAwMDAwMDAwMIK6fd6xp4iU', '哈哈', 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2770691011,100164542&fm=27&gp=0.jpg');
INSERT INTO `user` VALUES ('2', '15217162611', 'MDAwMDAwMDAwMIK6fd6xp4iU', '呵呵', 'https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2523342981,456767842&fm=27&gp=0.jpg');
INSERT INTO `user` VALUES ('3', '15217162612', 'MDAwMDAwMDAwMIK6fd6xp4iU', '嘿嘿', 'https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2400942863,529912960&fm=27&gp=0.jpg');
