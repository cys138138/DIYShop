/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.177
Source Server Version : 50540
Source Host           : 192.168.0.177:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-05-09 15:13:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `delivery_address`
-- ----------------------------
DROP TABLE IF EXISTS `delivery_address`;
CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '收货地址记录ID自增',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `province_id` int(11) DEFAULT NULL COMMENT '省ID',
  `city_id` int(11) DEFAULT NULL COMMENT '市ID',
  `area_id` int(11) DEFAULT NULL COMMENT '地区ID',
  `address` text COMMENT '详细地址',
  `is_default` tinyint(4) DEFAULT NULL COMMENT '是否默认的收货地址',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of delivery_address
-- ----------------------------

-- ----------------------------
-- Table structure for `dress`
-- ----------------------------
DROP TABLE IF EXISTS `dress`;
CREATE TABLE `dress` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰ID，自增',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `catalog_id` int(11) DEFAULT NULL COMMENT '服饰分类ID',
  `name` varchar(500) DEFAULT NULL COMMENT '服饰标题',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `pics` text COMMENT '服饰轮播图片',
  `status` int(11) DEFAULT NULL COMMENT '服饰状态：1未上架2已上架3已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress
-- ----------------------------
INSERT INTO `dress` VALUES ('1', '1', '1', '测试服饰1', '50.00', '[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"]', '2');

-- ----------------------------
-- Table structure for `dress_catalog`
-- ----------------------------
DROP TABLE IF EXISTS `dress_catalog`;
CREATE TABLE `dress_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `pid` int(11) DEFAULT '0' COMMENT '父id',
  `name` varchar(50) DEFAULT NULL COMMENT '服饰分类名称',
  `is_show` tinyint(4) DEFAULT NULL COMMENT '是否显示：1是0否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_catalog
-- ----------------------------
INSERT INTO `dress_catalog` VALUES ('1', '0', '外套', '1');
INSERT INTO `dress_catalog` VALUES ('2', '0', '上衣', '1');
INSERT INTO `dress_catalog` VALUES ('3', '0', '裙子', '1');
INSERT INTO `dress_catalog` VALUES ('4', '0', '男装专区', '1');
INSERT INTO `dress_catalog` VALUES ('5', '0', '女装专区', '1');
INSERT INTO `dress_catalog` VALUES ('6', '0', '折扣', '1');
INSERT INTO `dress_catalog` VALUES ('7', '1', '衣领', '1');
INSERT INTO `dress_catalog` VALUES ('8', '1', '衣袖', '1');

-- ----------------------------
-- Table structure for `dress_comment`
-- ----------------------------
DROP TABLE IF EXISTS `dress_comment`;
CREATE TABLE `dress_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰评论ID，自增',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `comment` text COMMENT '评论内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `dress_size_color_count`
-- ----------------------------
DROP TABLE IF EXISTS `dress_size_color_count`;
CREATE TABLE `dress_size_color_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰尺码颜色库存记录ID，自增',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `size_name` varchar(100) DEFAULT NULL COMMENT '尺码名称',
  `color_name` varchar(100) DEFAULT NULL COMMENT '颜色名称',
  `stock` int(11) DEFAULT NULL COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_size_color_count
-- ----------------------------
INSERT INTO `dress_size_color_count` VALUES ('1', '1', '1', 'S', '白', '1');
INSERT INTO `dress_size_color_count` VALUES ('2', '1', '1', 'S', '黑', '2');
INSERT INTO `dress_size_color_count` VALUES ('3', '1', '1', 'M', '白', '3');
INSERT INTO `dress_size_color_count` VALUES ('4', '1', '1', 'M', '黑', '4');
INSERT INTO `dress_size_color_count` VALUES ('5', '1', '1', 'L', '白', '5');
INSERT INTO `dress_size_color_count` VALUES ('6', '1', '1', 'L', '黑', '6');

-- ----------------------------
-- Table structure for `dress_tag`
-- ----------------------------
DROP TABLE IF EXISTS `dress_tag`;
CREATE TABLE `dress_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰标签ID',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `name` varchar(50) DEFAULT NULL COMMENT '标签名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_tag
-- ----------------------------
INSERT INTO `dress_tag` VALUES ('1', '1', '1', '夹克');
INSERT INTO `dress_tag` VALUES ('2', '1', '1', '秋冬');

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
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'admin', null, null, '21232f297a57a5a743894a0e4a801fc3', '管理员', '1461635974');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单记录ID自增',
  `order_number` varchar(200) DEFAULT NULL COMMENT '订单号',
  `order_info` text COMMENT '订单信息',
  `status` int(11) DEFAULT NULL COMMENT '订单状态:1确认订单2待付款3待发货4待收货5申请退货6退换货7确认收货',
  `express_info` text COMMENT '快递信息',
  `create_time` int(11) DEFAULT NULL COMMENT '确认订单时间',
  `pay_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `deliver_time` int(11) DEFAULT NULL COMMENT '发货时间',
  `end_time` int(11) DEFAULT NULL COMMENT '确认收货时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `keystr` varchar(50) DEFAULT NULL COMMENT '键',
  `valuestr` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/6ef030fa9ae071bc7e2218a715efc5ef.jpeg\"]},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/cce8218c8ad80180ca133b149c4dad1d.jpeg\"]},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\",\"pics\":[\"\\/static\\/data\\/advertisement_position_img\\/f591926c72767baf3563cf5a02595013.jpeg\"]}]');
INSERT INTO `setting` VALUES ('2', 'guess_like_config', '[{\"vender_id\":\"1\",\"dress_id\":1,\"pic_index\":1}]');
INSERT INTO `setting` VALUES ('3', 'discount_activity_config', '[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/bb6db92becfaeba6c1032050134ebe06.jpeg\",\"link_url\":\"www.baidu.com\"}]');
INSERT INTO `setting` VALUES ('4', 'vote_config', '[{\"identity\":\"0c7e3645eda540d7ae0aa5cec145803d\",\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/26df5e0f2812e68cd3e31abe0d541e3f.jpeg\",\"description\":\"\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\"}]');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` varchar(30) DEFAULT NULL COMMENT '用户名',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `password` varchar(100) DEFAULT NULL COMMENT '密码',
  `avatar` varchar(500) DEFAULT NULL COMMENT '头像',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
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
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender
-- ----------------------------
INSERT INTO `vender` VALUES ('1', 'jack', '15012121551', '45855@qq.com', '4ff9fc6e4e5d5f590c4f2134a8cc96d1', '以纯厂商', 'asadssasasasasa', '50', '1461635974');

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

-- ----------------------------
-- Table structure for `vote_record`
-- ----------------------------
DROP TABLE IF EXISTS `vote_record`;
CREATE TABLE `vote_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投票记录ID，自增',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `identity` varchar(100) DEFAULT NULL COMMENT '投票标识',
  `create_time` int(11) DEFAULT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_record
-- ----------------------------
