/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.177
Source Server Version : 50540
Source Host           : 192.168.0.177:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-04-27 11:44:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'admin', null, null, '21232f297a57a5a743894a0e4a801fc3', '管理员');

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `keystr` varchar(50) DEFAULT NULL COMMENT '键',
  `valuestr` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/369f530a6b9a428a14b9531e5d8645b2.jpeg\"]},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/3c3eb4abcc73a0fbdab95a4a3a2490c5.jpeg\"]},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/6fb10781b5b07c84e34c7e3df6528593.jpeg\"]}]');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
