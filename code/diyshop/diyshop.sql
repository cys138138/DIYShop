/*
Navicat MySQL Data Transfer

Source Server         : phpstudyLocalhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-10-02 21:36:23
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
  `name` varchar(50) DEFAULT NULL COMMENT '收货人',
  `contact` varchar(200) DEFAULT NULL COMMENT '联系电话',
  `address` text COMMENT '详细地址',
  `is_default` tinyint(4) DEFAULT NULL COMMENT '是否默认的收货地址',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of delivery_address
-- ----------------------------
INSERT INTO `delivery_address` VALUES ('1', '1', null, null, '14000', 'jay', '020-8889898', '广州', '1', '1468295387');

-- ----------------------------
-- Table structure for `dress`
-- ----------------------------
DROP TABLE IF EXISTS `dress`;
CREATE TABLE `dress` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰ID，自增',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `catalog_id` int(11) DEFAULT NULL COMMENT '服饰分类ID',
  `name` varchar(500) DEFAULT NULL COMMENT '服饰标题',
  `desc` varchar(500) DEFAULT NULL COMMENT '二级名称描述',
  `sex` int(11) DEFAULT NULL COMMENT '性别：1男2女',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `discount_price` decimal(10,2) DEFAULT NULL COMMENT '新品优惠价格',
  `pics` text COMMENT '服饰轮播图片',
  `dress_match_ids` text COMMENT '商家服饰搭配ID',
  `sale_count` int(11) DEFAULT '0' COMMENT '销售量',
  `like_count` int(11) DEFAULT '0' COMMENT '赞的个数',
  `is_hot` tinyint(4) DEFAULT NULL COMMENT '是否热门1是0否',
  `status` int(11) DEFAULT NULL COMMENT '服饰状态：1未上架2已上架3已删除',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress
-- ----------------------------
INSERT INTO `dress` VALUES ('1', '1', '1', '测试服饰1', '测试服饰1测试服饰1', '2', '50.00', '40.00', '[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"]', '{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]}', '0', '0', '1', '2', '1475294365', '1474507738');
INSERT INTO `dress` VALUES ('2', '2', '1', '韩式短袖衫', null, '1', '10.00', null, '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[]', '0', '0', null, '2', '1474507705', '1474507705');
INSERT INTO `dress` VALUES ('3', '2', '4', 'diy长裤', null, '1', '20.00', null, '[\"\\/static\\/data\\/dress\\/71\\/de9ff668f655a936c718ea0a60440da5.jpg\"]', '[]', '0', '0', null, '2', '1474507705', '1474507705');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
  `desc_point` int(11) DEFAULT NULL COMMENT '描述评分',
  `delivery_point` int(11) DEFAULT NULL COMMENT '物流服务评分',
  `service_point` int(11) DEFAULT NULL COMMENT '服务态度评分',
  `comment` text COMMENT '评论内容',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_comment
-- ----------------------------
INSERT INTO `dress_comment` VALUES ('1', '1', '1', '2', '3', '4', '好看', '1472548865');

-- ----------------------------
-- Table structure for `dress_decoration`
-- ----------------------------
DROP TABLE IF EXISTS `dress_decoration`;
CREATE TABLE `dress_decoration` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '饰件id',
  `name` varchar(100) DEFAULT NULL COMMENT '饰件名称',
  `detail_pics` text COMMENT '详细图片',
  `effect_pic` varchar(500) DEFAULT NULL COMMENT '效果图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_decoration
-- ----------------------------
INSERT INTO `dress_decoration` VALUES ('1', '围巾-女', '[\"\\/static\\/data\\/dress\\/45\\/5b3c103a054fceace90fcbed218ac687.jpeg\",\"\\/static\\/data\\/dress\\/47\\/caeaa2bc0c3370bd2de48a1102a001db.jpeg\"]', '/static/data/dress/83/103717c5cf55e37b62cf8d3be9934789.jpeg');

-- ----------------------------
-- Table structure for `dress_material`
-- ----------------------------
DROP TABLE IF EXISTS `dress_material`;
CREATE TABLE `dress_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰面料ID',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `name` varchar(50) DEFAULT NULL COMMENT '面料名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_material
-- ----------------------------
INSERT INTO `dress_material` VALUES ('13', '0', '0', '纯棉');
INSERT INTO `dress_material` VALUES ('40', '1', '1', '尼龙');
INSERT INTO `dress_material` VALUES ('39', '1', '1', '麻布');
INSERT INTO `dress_material` VALUES ('15', '0', '0', '麻布');
INSERT INTO `dress_material` VALUES ('16', '0', '0', '尼龙');
INSERT INTO `dress_material` VALUES ('38', '1', '1', '纯棉');

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
  `pic` text COMMENT '详细图片',
  `pics` text COMMENT '正反面图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_size_color_count
-- ----------------------------
INSERT INTO `dress_size_color_count` VALUES ('113', '1', '1', 'L', '白', '5', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('112', '1', '1', 'M', '黑', '91', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('28', '2', '2', 'M', '黑', '44', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('27', '2', '2', 'S', '白', '620', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('29', '2', '3', 'S', '黑', '22', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('30', '2', '3', 'M', '白', '27', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('110', '1', '1', 'S', '黑', '2', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('111', '1', '1', 'M', '白', '3', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('109', '1', '1', 'S', '白', '1', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"]', '[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]');
INSERT INTO `dress_size_color_count` VALUES ('114', '1', '1', 'L', '黑', '6', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[\"\",\"\"]');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_tag
-- ----------------------------
INSERT INTO `dress_tag` VALUES ('39', '1', '1', '秋冬');
INSERT INTO `dress_tag` VALUES ('38', '1', '1', '夹克');
INSERT INTO `dress_tag` VALUES ('10', '2', '2', '帅');
INSERT INTO `dress_tag` VALUES ('11', '2', '3', '帅');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'admin', null, null, '21232f297a57a5a743894a0e4a801fc3', '管理员', '1461635974');

-- ----------------------------
-- Table structure for `manager_dress_match`
-- ----------------------------
DROP TABLE IF EXISTS `manager_dress_match`;
CREATE TABLE `manager_dress_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员服饰搭配记录ID，自增',
  `name` varchar(500) DEFAULT NULL COMMENT '搭配别名',
  `catalog_id` int(11) DEFAULT NULL COMMENT '服饰分类ID',
  `sex` int(11) DEFAULT NULL COMMENT '性别：1男2女',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `pics` text COMMENT '正反面图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager_dress_match
-- ----------------------------
INSERT INTO `manager_dress_match` VALUES ('1', '外套衣领白色', '7', '1', '34.00', '[\"\\/static\\/data\\/dress\\/51\\/89182f0bf496a7c4341a3a14f91dafca.jpeg\",\"\\/static\\/data\\/dress\\/24\\/4c78344cb602bd1b605b8c80f630c3e5.jpeg\"]', '1462852377');
INSERT INTO `manager_dress_match` VALUES ('3', '外套衣领黑色', '7', '1', null, '[\"\\/static\\/data\\/dress\\/26\\/196c006af0daa6a3ad90f70fc83bd25d.jpeg\",\"\\/static\\/data\\/dress\\/50\\/e5ac373b7fd3ff4224ffdb8b89e8f2c2.jpeg\"]', '1462866961');

-- ----------------------------
-- Table structure for `mark`
-- ----------------------------
DROP TABLE IF EXISTS `mark`;
CREATE TABLE `mark` (
  `id` int(11) NOT NULL COMMENT '用户ID',
  `mark_total` smallint(5) NOT NULL COMMENT '总的签到次数',
  `mark_continuous` smallint(5) NOT NULL COMMENT '连续签到次数',
  `last_mark_date` int(11) NOT NULL COMMENT '上一次签到日期',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`mark_total`,`mark_continuous`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mark
-- ----------------------------
INSERT INTO `mark` VALUES ('1', '6', '2', '20160831');

-- ----------------------------
-- Table structure for `mobile_verify`
-- ----------------------------
DROP TABLE IF EXISTS `mobile_verify`;
CREATE TABLE `mobile_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `mobile` varchar(12) DEFAULT NULL COMMENT '手机号',
  `verify_code` varchar(10) DEFAULT NULL COMMENT '验证码',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mobile_verify
-- ----------------------------
INSERT INTO `mobile_verify` VALUES ('1', '15014191886', '658339', '1468228203');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单记录ID自增',
  `order_type` int(11) DEFAULT '0' COMMENT '订单类型：0普通订单，1合并订单（特殊订单）',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `order_number` varchar(200) DEFAULT NULL COMMENT '订单号',
  `trace_num` varchar(200) DEFAULT NULL COMMENT '交易号',
  `order_info` text COMMENT '订单信息',
  `dress_count` int(11) DEFAULT NULL COMMENT '服饰数量',
  `total_price` decimal(10,2) DEFAULT NULL COMMENT '订单总价',
  `status` int(11) DEFAULT NULL COMMENT '订单状态:1确认订单2待付款3待发货4待收货5申请退货6退换货7确认收货',
  `buyer_msg` varchar(500) DEFAULT NULL COMMENT '买家留言',
  `express_info` text COMMENT '快递信息',
  `create_time` int(11) DEFAULT NULL COMMENT '确认订单时间',
  `pay_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `deliver_time` int(11) DEFAULT NULL COMMENT '发货时间',
  `end_time` int(11) DEFAULT NULL COMMENT '确认收货时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('13', '0', '1', '1', 'fb7f451b8af93a52936cd7c9dd6aa536', '', '[{\"item_info\":{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"sex\":\"2\",\"price\":\"50.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":[\"1\"],\"status\":\"2\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"19\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"20\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"21\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"22\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"23\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"24\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"}],\"dress_tag\":[{\"id\":\"7\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"8\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/1\\/d845f884f76dc5916a316440caff76f7.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/1\\/a547ce501430d26a861fb5d3b6b3779c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/1\\/7086ce468e50c8214da6d5ee8daa16a5.jpeg\"],\"kefu_tel\":\"020-5656566\"},\"item_size_color_count_info\":{\"id\":\"22\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":91,\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},\"item_count\":\"2\",\"item_price\":100,\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}}]', '2', '100.00', '2', null, '[]', '1472608158', '0', '0', '0');
INSERT INTO `order` VALUES ('14', '0', '1', '2', 'a83f1292e8ca7596dc88dff882a54821', '', '[{\"item_info\":{\"id\":\"2\",\"vender_id\":\"2\",\"catalog_id\":\"1\",\"name\":\"\\u97e9\\u5f0f\\u77ed\\u8896\\u886b\",\"sex\":\"1\",\"price\":\"10.00\",\"pics\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"dress_match_ids\":[],\"status\":\"2\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"27\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"620\",\"pic\":\"\\/static\\/data\\/dress\\/89\\/c5ae596da9449d6ac20288d5ce56fc05.jpg\"},{\"id\":\"28\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"44\",\"pic\":\"\\/static\\/data\\/dress\\/71\\/9a2eae6036f72c48e21dd1233155ffa4.jpg\"}],\"dress_tag\":[{\"id\":\"10\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"name\":\"\\u5e05\"}]},\"shop_info\":{\"id\":\"2\",\"name\":\"fsz\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/43\\/73e927d26448b5e1bb110bb58bcaca35.jpg\",\"description\":\"fszfszfsz\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"],\"kefu_tel\":\"020-65658955\"},\"item_size_color_count_info\":{\"id\":\"28\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":44,\"pic\":\"\\/static\\/data\\/dress\\/71\\/9a2eae6036f72c48e21dd1233155ffa4.jpg\"},\"item_count\":\"1\",\"item_price\":10,\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}},{\"item_info\":{\"id\":\"3\",\"vender_id\":\"2\",\"catalog_id\":\"4\",\"name\":\"diy\\u957f\\u88e4\",\"sex\":\"1\",\"price\":\"20.00\",\"pics\":[\"\\/static\\/data\\/dress\\/71\\/de9ff668f655a936c718ea0a60440da5.jpg\"],\"dress_match_ids\":[],\"status\":\"2\",\"catalog_name\":\"\\u7537\\u88c5\\u4e13\\u533a\",\"dress_size_color_count\":[{\"id\":\"29\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"22\",\"pic\":\"\\/static\\/data\\/dress\\/52\\/b94f283d2ba3e7acd83484b8d936d624.jpg\"},{\"id\":\"30\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"27\",\"pic\":\"\\/static\\/data\\/dress\\/40\\/d5d0eae5ab5b422ec7d45c43eeb0b8b8.jpg\"}],\"dress_tag\":[{\"id\":\"11\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"name\":\"\\u5e05\"}]},\"shop_info\":{\"id\":\"2\",\"name\":\"fsz\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/43\\/73e927d26448b5e1bb110bb58bcaca35.jpg\",\"description\":\"fszfszfsz\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"],\"kefu_tel\":\"020-65658955\"},\"item_size_color_count_info\":{\"id\":\"30\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":27,\"pic\":\"\\/static\\/data\\/dress\\/40\\/d5d0eae5ab5b422ec7d45c43eeb0b8b8.jpg\"},\"item_count\":\"1\",\"item_price\":20,\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}}]', '2', '30.00', '2', null, '[]', '1472608158', '0', '0', '0');
INSERT INTO `order` VALUES ('15', '1', '1', '0', '32bc4d435785c439bf01ab3a42f9fb6e', '', '[\"fb7f451b8af93a52936cd7c9dd6aa536\",\"a83f1292e8ca7596dc88dff882a54821\"]', '4', '130.00', '2', null, '[]', '1472608158', '0', '0', '0');

-- ----------------------------
-- Table structure for `qiniu_pic_key_map`
-- ----------------------------
DROP TABLE IF EXISTS `qiniu_pic_key_map`;
CREATE TABLE `qiniu_pic_key_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '七牛图key对照表ID，自增',
  `file_key` varchar(500) DEFAULT NULL COMMENT '七牛文件key',
  `file_name` varchar(500) DEFAULT NULL COMMENT '本地图片文件名，无后缀',
  `file_path` varchar(500) DEFAULT NULL COMMENT '本地图片路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qiniu_pic_key_map
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
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/6ef030fa9ae071bc7e2218a715efc5ef.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/cce8218c8ad80180ca133b149c4dad1d.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/f591926c72767baf3563cf5a02595013.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]}]');
INSERT INTO `setting` VALUES ('2', 'guess_like_config', '[{\"vender_id\":\"1\",\"dress_id\":1,\"pic_index\":1}]');
INSERT INTO `setting` VALUES ('3', 'discount_activity_config', '[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/bb6db92becfaeba6c1032050134ebe06.jpeg\",\"link_url\":\"www.baidu.com\"}]');
INSERT INTO `setting` VALUES ('4', 'vote_config', '[{\"identity\":\"0c7e3645eda540d7ae0aa5cec145803d\",\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/26df5e0f2812e68cd3e31abe0d541e3f.jpeg\",\"description\":\"\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\\u6295\\u7968\\u8bf4\\u660e\"}]');

-- ----------------------------
-- Table structure for `shopping_cart`
-- ----------------------------
DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增，购物车id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `count` int(11) DEFAULT NULL COMMENT '数量',
  `dress_info` text COMMENT '服饰信息',
  `size_color_info` text COMMENT '尺寸颜色信息',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopping_cart
-- ----------------------------
INSERT INTO `shopping_cart` VALUES ('1', '1', '1', '2', '{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"desc\":\"\\u6d4b\\u8bd5\\u670d\\u99701\\u6d4b\\u8bd5\\u670d\\u99701\",\"sex\":\"2\",\"price\":\"50.00\",\"discount_price\":\"40.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1475294365\",\"create_time\":\"1474507738\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"109\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]},{\"id\":\"110\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"111\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"113\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"114\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u7eaf\\u68c9\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u9ebb\\u5e03\"},{\"id\":\"40\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}', '1475343144');

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
  `gold` int(11) DEFAULT '0' COMMENT '金币',
  `sex` tinyint(4) DEFAULT NULL COMMENT '性别：1男2女',
  `avatar` varchar(500) DEFAULT NULL COMMENT '头像',
  `desc` varchar(500) DEFAULT NULL COMMENT '个人说明',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'jay', null, '15014191886', null, 'e10adc3949ba59abbe56e057f20f883e', '8', '1', null, null, '1468226675');

-- ----------------------------
-- Table structure for `user_add_gold_record`
-- ----------------------------
DROP TABLE IF EXISTS `user_add_gold_record`;
CREATE TABLE `user_add_gold_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '添加金币记录ID，自增',
  `user_type` tinyint(1) DEFAULT NULL COMMENT '操作用户类型，0：管理员，1：商家',
  `operate_id` int(11) DEFAULT NULL COMMENT '操作用户ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `gold` int(11) DEFAULT NULL COMMENT '添加金币数',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_add_gold_record
-- ----------------------------
INSERT INTO `user_add_gold_record` VALUES ('1', '0', '1', '1', '1', '1474357870');
INSERT INTO `user_add_gold_record` VALUES ('2', '0', '1', '1', '2', '1474357928');

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
  `company_property` varchar(200) DEFAULT NULL COMMENT '公司性质',
  `company_address` varchar(500) DEFAULT NULL COMMENT '公司地址',
  `dress_count_limit` int(11) DEFAULT '0' COMMENT '商家服饰数量限制',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender
-- ----------------------------
INSERT INTO `vender` VALUES ('1', 'jack', '15012121551', '45855@qq.com', '4ff9fc6e4e5d5f590c4f2134a8cc96d1', '以纯厂商', 'asadssasasasasa', '私营企业', '广州海珠区xx路110号', '50', '1461635974');
INSERT INTO `vender` VALUES ('2', 'lucy', '15014185151', '1502121214@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 'fsz', 'dsafdasf', 'guang zhou hai', 'guang zhou hai6958', '0', '1472454081');

-- ----------------------------
-- Table structure for `vender_dress_match`
-- ----------------------------
DROP TABLE IF EXISTS `vender_dress_match`;
CREATE TABLE `vender_dress_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家服饰搭配记录ID，自增',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `name` varchar(500) DEFAULT NULL COMMENT '搭配别名',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `manager_dress_match_id` int(11) DEFAULT NULL COMMENT '管理员服饰搭配ID',
  `detail_pics` text COMMENT '详细图片',
  `pics` text COMMENT '正反面图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender_dress_match
-- ----------------------------
INSERT INTO `vender_dress_match` VALUES ('1', '1', '外套衣领白色0001', '23.00', '1', '[\"\\/static\\/data\\/dress\\/41\\/35f9416708830811138ac57387719d4f.jpeg\",\"\\/static\\/data\\/dress\\/67\\/316ff858004dd3f2abdc9daab065b90c.jpeg\"]', '[\"\\/static\\/data\\/dress\\/46\\/6501a622cfe0b3bf8fc06c042779a708.jpeg\",\"\\/static\\/data\\/dress\\/47\\/5fe8ec7e6e5df441f1f1fe5d93ae1e54.jpeg\"]', '1462935809');

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
  `kefu_tel` varchar(50) DEFAULT NULL COMMENT '客服电话',
  `qq` varchar(20) DEFAULT NULL COMMENT 'qq号',
  `weixin` varchar(50) DEFAULT NULL COMMENT '微信号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender_shop
-- ----------------------------
INSERT INTO `vender_shop` VALUES ('1', 'jack服饰商店', '/static/data/vender_shop_img/1/d845f884f76dc5916a316440caff76f7.jpg', 'jack服饰商店说明jack服饰商店说明jack服饰商店说明', '[\"\\/static\\/data\\/vender_shop_img\\/1\\/a547ce501430d26a861fb5d3b6b3779c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/1\\/7086ce468e50c8214da6d5ee8daa16a5.jpeg\"]', '020-5656566', '3243242342', 'vx34234');
INSERT INTO `vender_shop` VALUES ('2', 'fsz', '/static/data/vender_shop_img/43/73e927d26448b5e1bb110bb58bcaca35.jpg', 'fszfszfsz', '[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"]', '020-65658955', null, null);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_record
-- ----------------------------
