/*
Navicat MySQL Data Transfer

Source Server         : phpstudyLocalhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-04-29 23:43:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dress_catalog`
-- ----------------------------
DROP TABLE IF EXISTS `dress_catalog`;
CREATE TABLE `dress_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `name` varchar(50) DEFAULT NULL COMMENT '服饰分类名称',
  `is_show` tinyint(4) DEFAULT NULL COMMENT '是否显示：1是0否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_catalog
-- ----------------------------
INSERT INTO `dress_catalog` VALUES ('1', '外套', '1');
INSERT INTO `dress_catalog` VALUES ('2', '上衣', '1');
INSERT INTO `dress_catalog` VALUES ('3', '裙子', '1');
INSERT INTO `dress_catalog` VALUES ('4', '男装专区', '1');
INSERT INTO `dress_catalog` VALUES ('5', '女装专区', '1');
INSERT INTO `dress_catalog` VALUES ('6', '折扣', '1');

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
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/6ef030fa9ae071bc7e2218a715efc5ef.jpeg\"]},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/cce8218c8ad80180ca133b149c4dad1d.jpeg\"]},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/f591926c72767baf3563cf5a02595013.jpeg\"]}]');

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

-- ----------------------------
-- Table structure for `vender`
-- ----------------------------
DROP TABLE IF EXISTS `vender`;
CREATE TABLE `vender` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家id',
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `name` varchar(50) DEFAULT NULL COMMENT '厂商名称',
  `company_code` varchar(200) DEFAULT NULL COMMENT '公司码',
  `dress_count_limit` int(11) DEFAULT '0' COMMENT '商家服饰数量限制',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender
-- ----------------------------
INSERT INTO `vender` VALUES ('1', 'jack', '15012121551', '45855@qq.com', '4ff9fc6e4e5d5f590c4f2134a8cc96d1', '以纯厂商', 'asadssasasasasa', '50');

-- ----------------------------
-- Table structure for `vender_shop`
-- ----------------------------
DROP TABLE IF EXISTS `vender_shop`;
CREATE TABLE `vender_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家id',
  `name` varchar(500) DEFAULT NULL COMMENT '商店名称',
  `logo` varchar(500) DEFAULT NULL COMMENT '商店Logo',
  `description` text COMMENT '商店说明',
  `pics` text COMMENT '轮播图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender_shop
-- ----------------------------
INSERT INTO `vender_shop` VALUES ('1', 'jack服饰商店', '/static/data/vender_shop_img/1/d845f884f76dc5916a316440caff76f7.jpg', 'jack服饰商店说明jack服饰商店说明jack服饰商店说明', '[\"\\/static\\/data\\/vender_shop_img\\/1\\/a547ce501430d26a861fb5d3b6b3779c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/1\\/7086ce468e50c8214da6d5ee8daa16a5.jpeg\"]');
