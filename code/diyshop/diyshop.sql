/*
Navicat MySQL Data Transfer

Source Server         : 192.168.0.177
Source Server Version : 50540
Source Host           : 192.168.0.177:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-10-27 15:56:40
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
  `area` varchar(200) DEFAULT NULL COMMENT '地区',
  `street` varchar(500) DEFAULT NULL COMMENT '街道',
  `is_default` tinyint(4) DEFAULT NULL COMMENT '是否默认的收货地址',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of delivery_address
-- ----------------------------
INSERT INTO `delivery_address` VALUES ('1', '1', null, null, '14000', 'jay', '020-8889898', '广州', '海珠区', '人人街', '1', '1468295387');

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
  `detail` text COMMENT '服饰详情',
  `shuo_ming` varchar(500) DEFAULT NULL COMMENT '服饰说明',
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
INSERT INTO `dress` VALUES ('1', '1', '1', '测试服饰1', '测试服饰1测试服饰1', '<p><a>服饰详情</a></p><p><img src=\"http://www.diyshop.com/static/data/dress/61/c6b962e5fe49b600c9c03c3e4cebfb88.jpeg\" style=\"max-width: 100%;\" _src=\"http://www.diyshop.com/static/data/dress/61/c6b962e5fe49b600c9c03c3e4cebfb88.jpeg\"></p><p><img src=\"http://www.diyshop.com/static/data/dress/87/8901e0f406c08dfffd0b0a2410149f8c.jpeg\" style=\"max-width: 100%;\" _src=\"http://www.diyshop.com/static/data/dress/87/8901e0f406c08dfffd0b0a2410149f8c.jpeg\"></p><p><a></a><br></p>', '服饰服饰服饰说说明明', '2', '50.00', '40.00', '[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"]', '{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]}', '0', '0', '1', '2', '1477364722', '1474507738');
INSERT INTO `dress` VALUES ('2', '2', '1', '韩式短袖衫', null, null, null, '1', '10.00', null, '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', '[]', '0', '0', null, '2', '1474507705', '1474507705');
INSERT INTO `dress` VALUES ('3', '2', '4', 'diy长裤', null, null, null, '1', '20.00', null, '[\"\\/static\\/data\\/dress\\/71\\/de9ff668f655a936c718ea0a60440da5.jpg\"]', '[]', '0', '0', null, '2', '1474507705', '1474507705');

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
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `detail_pics` text COMMENT '详细图片',
  `effect_pic` varchar(500) DEFAULT NULL COMMENT '效果图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_decoration
-- ----------------------------
INSERT INTO `dress_decoration` VALUES ('1', '围巾-女', '12.30', '[\"\\/static\\/data\\/dress\\/11\\/aa2a5dff46d4de2b537d04afe6c181cc.jpeg\",\"\\/static\\/data\\/dress\\/21\\/c2d1b06231aa7a01f7477d202cce7c5b.jpeg\"]', '/static/data/dress/66/b93ec4331ccb8faf0f7acda035084f91.jpeg', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_material
-- ----------------------------
INSERT INTO `dress_material` VALUES ('13', '0', '0', '纯棉');
INSERT INTO `dress_material` VALUES ('67', '1', '1', '尼龙');
INSERT INTO `dress_material` VALUES ('66', '1', '1', '麻布');
INSERT INTO `dress_material` VALUES ('15', '0', '0', '麻布');
INSERT INTO `dress_material` VALUES ('16', '0', '0', '尼龙');
INSERT INTO `dress_material` VALUES ('65', '1', '1', '纯棉');

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
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_size_color_count
-- ----------------------------
INSERT INTO `dress_size_color_count` VALUES ('119', '1', '1', 'L', '白', '5', '[\"\\/static\\/data\\/dress\\/68\\/65bf9fe0a8be893a950610da0a06964a.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('28', '2', '2', 'M', '黑', '44', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('27', '2', '2', 'S', '白', '620', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('29', '2', '3', 'S', '黑', '22', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('30', '2', '3', 'M', '白', '27', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('118', '1', '1', 'M', '黑', '91', '[\"\\/static\\/data\\/dress\\/46\\/528c7711fa59aa21b5c2aa5fd41d77aa.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('117', '1', '1', 'M', '白', '3', '[\"\\/static\\/data\\/dress\\/56\\/d968a747fb51ac389b98625d35134fd5.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('116', '1', '1', 'S', '黑', '2', '[\"\\/static\\/data\\/dress\\/44\\/3457b2c606824d7f2bbfa1cba0ec1c5e.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('115', '1', '1', 'S', '白', '1', '[\"\\/static\\/data\\/dress\\/50\\/47d87108a8ca8d399644ce81558c1c4f.jpeg\"]', '[\"\\/static\\/data\\/dress\\/49\\/6219e6bcfe1ad9340f3e8db510fe6753.jpeg\",\"\\/static\\/data\\/dress\\/51\\/3f5e612a20afbb10466ad847722e7bca.jpeg\"]');
INSERT INTO `dress_size_color_count` VALUES ('120', '1', '1', 'L', '黑', '6', '[\"\\/static\\/data\\/dress\\/19\\/70efe04af8aab3e7df75eec16c4495b7.jpeg\"]', '[\"\",\"\"]');

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
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_tag
-- ----------------------------
INSERT INTO `dress_tag` VALUES ('57', '1', '1', '秋冬');
INSERT INTO `dress_tag` VALUES ('56', '1', '1', '夹克');
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
INSERT INTO `manager_dress_match` VALUES ('1', '外套衣领白色', '7', '1', '34.00', '[\"\\/static\\/data\\/dress\\/60\\/a08b9288b91cf5b83b66659f210fbc17.jpeg\",\"\\/static\\/data\\/dress\\/58\\/f3b8141b87ee647b8f32d0300f8e2204.jpeg\"]', '1462852377');
INSERT INTO `manager_dress_match` VALUES ('3', '外套衣领黑色', '7', '1', null, '[\"\\/static\\/data\\/dress\\/46\\/3e06a296005af950c1461a8e5b7ddb64.jpeg\",\"\\/static\\/data\\/dress\\/73\\/4ba706b9b5159e64cf877064645dc411.jpeg\"]', '1462866961');

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
  `status` int(11) DEFAULT NULL COMMENT '订单状态:1待付款2待发货3待收货4申请退货5退换货6确认收货',
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
INSERT INTO `order` VALUES ('13', '0', '1', '1', 'fb7f451b8af93a52936cd7c9dd6aa536', '', '[{\"item_info\":{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"sex\":\"2\",\"price\":\"50.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":[\"1\"],\"status\":\"2\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"19\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"20\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"21\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"22\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"23\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"},{\"id\":\"24\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":\"\\/static\\/data\\/dress\\/97\\/3da9bf6cc93306924b471b7835309e1d.jpeg\"}],\"dress_tag\":[{\"id\":\"7\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"8\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/1\\/d845f884f76dc5916a316440caff76f7.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/1\\/a547ce501430d26a861fb5d3b6b3779c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/1\\/7086ce468e50c8214da6d5ee8daa16a5.jpeg\"],\"kefu_tel\":\"020-5656566\"},\"item_size_color_count_info\":{\"id\":\"22\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":91,\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]},\"item_count\":\"2\",\"item_price\":100,\"buyer_msg\":\"ff\",\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}}]', '2', '100.00', '1', null, '[]', '1472608158', '0', '0', '0');
INSERT INTO `order` VALUES ('14', '0', '1', '2', 'a83f1292e8ca7596dc88dff882a54821', '', '[{\"item_info\":{\"id\":\"2\",\"vender_id\":\"2\",\"catalog_id\":\"1\",\"name\":\"\\u97e9\\u5f0f\\u77ed\\u8896\\u886b\",\"sex\":\"1\",\"price\":\"10.00\",\"pics\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"dress_match_ids\":[],\"status\":\"2\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"27\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"620\",\"pic\":\"\\/static\\/data\\/dress\\/89\\/c5ae596da9449d6ac20288d5ce56fc05.jpg\"},{\"id\":\"28\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"44\",\"pic\":\"\\/static\\/data\\/dress\\/71\\/9a2eae6036f72c48e21dd1233155ffa4.jpg\"}],\"dress_tag\":[{\"id\":\"10\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"name\":\"\\u5e05\"}]},\"shop_info\":{\"id\":\"2\",\"name\":\"fsz\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/43\\/73e927d26448b5e1bb110bb58bcaca35.jpg\",\"description\":\"fszfszfsz\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"],\"kefu_tel\":\"020-65658955\"},\"item_size_color_count_info\":{\"id\":\"28\",\"vender_id\":\"2\",\"dress_id\":\"2\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":44,\"pic\":\"\\/static\\/data\\/dress\\/71\\/9a2eae6036f72c48e21dd1233155ffa4.jpg\"},\"item_count\":\"1\",\"item_price\":10,\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}},{\"item_info\":{\"id\":\"3\",\"vender_id\":\"2\",\"catalog_id\":\"4\",\"name\":\"diy\\u957f\\u88e4\",\"sex\":\"1\",\"price\":\"20.00\",\"pics\":[\"\\/static\\/data\\/dress\\/71\\/de9ff668f655a936c718ea0a60440da5.jpg\"],\"dress_match_ids\":[],\"status\":\"2\",\"catalog_name\":\"\\u7537\\u88c5\\u4e13\\u533a\",\"dress_size_color_count\":[{\"id\":\"29\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"22\",\"pic\":\"\\/static\\/data\\/dress\\/52\\/b94f283d2ba3e7acd83484b8d936d624.jpg\"},{\"id\":\"30\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"27\",\"pic\":\"\\/static\\/data\\/dress\\/40\\/d5d0eae5ab5b422ec7d45c43eeb0b8b8.jpg\"}],\"dress_tag\":[{\"id\":\"11\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"name\":\"\\u5e05\"}]},\"shop_info\":{\"id\":\"2\",\"name\":\"fsz\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/43\\/73e927d26448b5e1bb110bb58bcaca35.jpg\",\"description\":\"fszfszfsz\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"],\"kefu_tel\":\"020-65658955\"},\"item_size_color_count_info\":{\"id\":\"30\",\"vender_id\":\"2\",\"dress_id\":\"3\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":27,\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]},\"item_count\":\"1\",\"item_price\":20,\"buyer_msg\":\"gg\",\"delivery_address_info\":{\"id\":\"1\",\"user_id\":\"1\",\"province_id\":null,\"city_id\":null,\"area_id\":\"14000\",\"name\":\"jay\",\"contact\":\"020-8889898\",\"address\":\"\\u5e7f\\u5dde\",\"is_default\":\"1\",\"create_time\":\"1468295387\"}}]', '2', '30.00', '1', null, '[]', '1472608158', '0', '0', '0');
INSERT INTO `order` VALUES ('15', '1', '1', '0', '32bc4d435785c439bf01ab3a42f9fb6e', '', '[\"fb7f451b8af93a52936cd7c9dd6aa536\",\"a83f1292e8ca7596dc88dff882a54821\"]', '4', '130.00', '1', null, '[]', '1472608158', '0', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qiniu_pic_key_map
-- ----------------------------
INSERT INTO `qiniu_pic_key_map` VALUES ('1', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '2af74152575593044b72804d8e302ce0', '/static/data/advertisement_position_img/2af74152575593044b72804d8e302ce0.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('2', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'b75ca01e92a5a033bd7203306fcba525', '/static/data/advertisement_position_img/b75ca01e92a5a033bd7203306fcba525.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('3', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'e0f7e96f4ad080119284188c55b6b32c', '/static/data/advertisement_position_img/e0f7e96f4ad080119284188c55b6b32c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('4', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '33703c4ce330e1fe050c6643abba31ef', '/static/data/advertisement_position_img/33703c4ce330e1fe050c6643abba31ef.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('5', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'b0c42e00279d6f477fab2380a4c1eb1e', '/static/data/advertisement_position_img/b0c42e00279d6f477fab2380a4c1eb1e.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('6', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', '8b2bab9e7ed324881a994c72e4ef19c1', '/static/data/advertisement_position_img/8b2bab9e7ed324881a994c72e4ef19c1.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('7', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '08bb42d488452317dad108490cf76b8d', '/static/data/advertisement_position_img/08bb42d488452317dad108490cf76b8d.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('8', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'ae55a2d071be7b9b1b30d5e18661c915', '/static/data/advertisement_position_img/ae55a2d071be7b9b1b30d5e18661c915.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('9', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '335e2503c778735537f199ebf4e99c10', '/static/data/advertisement_position_img/335e2503c778735537f199ebf4e99c10.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('10', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '9b957316fd335d0b5cea21e06117c249', '/static/data/advertisement_position_img/9b957316fd335d0b5cea21e06117c249.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('11', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'b163f1423b89a0e3d0c573fd7a6702e0', '/static/data/advertisement_position_img/b163f1423b89a0e3d0c573fd7a6702e0.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('12', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'ad5d42f5d3f4bc969c82b6e9430dbf9c', '/static/data/advertisement_position_img/ad5d42f5d3f4bc969c82b6e9430dbf9c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('13', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'a08b9288b91cf5b83b66659f210fbc17', '/static/data/dress/60/a08b9288b91cf5b83b66659f210fbc17.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('14', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'f3b8141b87ee647b8f32d0300f8e2204', '/static/data/dress/58/f3b8141b87ee647b8f32d0300f8e2204.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('15', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '3e06a296005af950c1461a8e5b7ddb64', '/static/data/dress/46/3e06a296005af950c1461a8e5b7ddb64.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('16', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '4ba706b9b5159e64cf877064645dc411', '/static/data/dress/73/4ba706b9b5159e64cf877064645dc411.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('17', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'aa2a5dff46d4de2b537d04afe6c181cc', '/static/data/dress/11/aa2a5dff46d4de2b537d04afe6c181cc.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('18', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'c2d1b06231aa7a01f7477d202cce7c5b', '/static/data/dress/21/c2d1b06231aa7a01f7477d202cce7c5b.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('19', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', 'b93ec4331ccb8faf0f7acda035084f91', '/static/data/dress/66/b93ec4331ccb8faf0f7acda035084f91.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('20', 'FjQGcMS0xfseWaaGIQGMMiHEDKj7', '248b6afccb4b167de5e975390d664ce6', '/static/data/vender_shop_img/81/248b6afccb4b167de5e975390d664ce6.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('21', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'b0a607eea3104b09e93c1cf779c2852c', '/static/data/vender_shop_img/48/b0a607eea3104b09e93c1cf779c2852c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('22', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '7facb3b22e7544c5ab2586b4479360a0', '/static/data/vender_shop_img/90/7facb3b22e7544c5ab2586b4479360a0.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('23', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '47d87108a8ca8d399644ce81558c1c4f', '/static/data/dress/50/47d87108a8ca8d399644ce81558c1c4f.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('24', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '6219e6bcfe1ad9340f3e8db510fe6753', '/static/data/dress/49/6219e6bcfe1ad9340f3e8db510fe6753.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('25', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '3f5e612a20afbb10466ad847722e7bca', '/static/data/dress/51/3f5e612a20afbb10466ad847722e7bca.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('26', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '3457b2c606824d7f2bbfa1cba0ec1c5e', '/static/data/dress/44/3457b2c606824d7f2bbfa1cba0ec1c5e.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('27', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'd968a747fb51ac389b98625d35134fd5', '/static/data/dress/56/d968a747fb51ac389b98625d35134fd5.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('28', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '528c7711fa59aa21b5c2aa5fd41d77aa', '/static/data/dress/46/528c7711fa59aa21b5c2aa5fd41d77aa.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('29', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '65bf9fe0a8be893a950610da0a06964a', '/static/data/dress/68/65bf9fe0a8be893a950610da0a06964a.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('30', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '70efe04af8aab3e7df75eec16c4495b7', '/static/data/dress/19/70efe04af8aab3e7df75eec16c4495b7.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('31', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'c5d097fc714d9a03412274ab0c4f5493', '/static/data/dress/93/c5d097fc714d9a03412274ab0c4f5493.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('32', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'f1c50138543a0de32b265b36011d4e1c', '/static/data/dress/46/f1c50138543a0de32b265b36011d4e1c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('33', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'e1c149ed25011c3f5825465011b0d226', '/static/data/dress/67/e1c149ed25011c3f5825465011b0d226.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('34', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '66762f93e146a12e5ce72741da48f55d', '/static/data/dress/34/66762f93e146a12e5ce72741da48f55d.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('35', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '301fa0f5808f1d66fbafd18ff7ea9bd6', '/static/data/dress/62/301fa0f5808f1d66fbafd18ff7ea9bd6.jpeg');

-- ----------------------------
-- Table structure for `return_exchange`
-- ----------------------------
DROP TABLE IF EXISTS `return_exchange`;
CREATE TABLE `return_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增，退换货记录ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `vender_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `order_number` varchar(200) DEFAULT NULL COMMENT '订单号',
  `type` int(11) DEFAULT NULL COMMENT '退换货类型，1：退货退款，2：仅退款，3：仅换货',
  `reason` varchar(500) DEFAULT NULL COMMENT '原因',
  `desc` varchar(500) DEFAULT NULL COMMENT '描述',
  `pics` text COMMENT '图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of return_exchange
-- ----------------------------
INSERT INTO `return_exchange` VALUES ('1', '1', '1', 'fb7f451b8af93a52936cd7c9dd6aa536', '1', '不想要了', '不想要了!!!', '[\"\\/static\\/data\\/advertisement_position_img\\/6a94661a48f974e8bdf9c38d35b61400.jpeg\",\"\\/static\\/data\\/advertisement_position_img\\/6a94661a48f974e8bdf9c38d35b61400.jpeg\"]', '1476505487');

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `keystr` varchar(50) DEFAULT NULL COMMENT '键',
  `valuestr` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/6ef030fa9ae071bc7e2218a715efc5ef.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/08bb42d488452317dad108490cf76b8d.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\",\"pics\":[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/8b2bab9e7ed324881a994c72e4ef19c1.jpeg\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]}]');
INSERT INTO `setting` VALUES ('2', 'guess_like_config', '[{\"vender_id\":\"1\",\"dress_id\":1,\"pic_index\":1}]');
INSERT INTO `setting` VALUES ('3', 'discount_activity_config', '[]');
INSERT INTO `setting` VALUES ('5', 'bg_advertisement_config', '[\"\\/static\\/data\\/advertisement_position_img\\/e0f7e96f4ad080119284188c55b6b32c.jpeg\",\"\\/static\\/data\\/advertisement_position_img\\/33703c4ce330e1fe050c6643abba31ef.jpeg\"]');
INSERT INTO `setting` VALUES ('6', 'top_advertisement_config', '[\"\\/static\\/data\\/advertisement_position_img\\/2af74152575593044b72804d8e302ce0.jpeg\",\"\\/static\\/data\\/advertisement_position_img\\/b75ca01e92a5a033bd7203306fcba525.jpeg\"]');

-- ----------------------------
-- Table structure for `shopping_cart`
-- ----------------------------
DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增，购物车id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `dress_size_color_count_id` int(11) DEFAULT NULL COMMENT '服饰款式id',
  `count` int(11) DEFAULT NULL COMMENT '数量',
  `dress_info` text COMMENT '服饰信息',
  `size_color_info` text COMMENT '尺寸颜色信息',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopping_cart
-- ----------------------------
INSERT INTO `shopping_cart` VALUES ('1', '1', '1', '112', '2', '{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"desc\":\"\\u6d4b\\u8bd5\\u670d\\u99701\\u6d4b\\u8bd5\\u670d\\u99701\",\"sex\":\"2\",\"price\":\"50.00\",\"discount_price\":\"40.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1475294365\",\"create_time\":\"1474507738\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"109\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]},{\"id\":\"110\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"111\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"113\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"114\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u7eaf\\u68c9\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u9ebb\\u5e03\"},{\"id\":\"40\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}', '1475343144');
INSERT INTO `shopping_cart` VALUES ('2', '1', '1', '120', '4', '{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"desc\":\"\\u6d4b\\u8bd5\\u670d\\u99701\\u6d4b\\u8bd5\\u670d\\u99701\",\"shuo_ming\":\"\\u670d\\u9970\\u670d\\u9970\\u670d\\u9970\\u8bf4\\u8bf4\\u660e\\u660e\",\"sex\":\"2\",\"price\":\"50.00\",\"discount_price\":\"40.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1475981425\",\"create_time\":\"1474507738\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"115\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]},{\"id\":\"116\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"117\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"118\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"119\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"120\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"40\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"41\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"41\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u7eaf\\u68c9\"},{\"id\":\"42\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u9ebb\\u5e03\"},{\"id\":\"43\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"120\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}', '1476113605');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `type` varchar(50) DEFAULT NULL COMMENT '第三方用户类型',
  `uuid` varchar(100) DEFAULT NULL COMMENT '第三方用户唯一标识',
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
INSERT INTO `user` VALUES ('1', null, null, 'jay', null, '', null, 'e10adc3949ba59abbe56e057f20f883e', '8', '1', null, null, '1468226675');

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
-- Table structure for `user_dress_collection`
-- ----------------------------
DROP TABLE IF EXISTS `user_dress_collection`;
CREATE TABLE `user_dress_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增，收藏记录id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `create_time` int(11) DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_dress_collection
-- ----------------------------
INSERT INTO `user_dress_collection` VALUES ('2', '1', '2', '1475999459');
INSERT INTO `user_dress_collection` VALUES ('3', '1', '1', '1475999735');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender_dress_match
-- ----------------------------
INSERT INTO `vender_dress_match` VALUES ('1', '1', '外套衣领白色0001', '23.00', '1', '[\"\\/static\\/data\\/dress\\/93\\/c5d097fc714d9a03412274ab0c4f5493.jpeg\",\"\\/static\\/data\\/dress\\/46\\/f1c50138543a0de32b265b36011d4e1c.jpeg\"]', '[\"\\/static\\/data\\/dress\\/67\\/e1c149ed25011c3f5825465011b0d226.jpeg\",\"\\/static\\/data\\/dress\\/34\\/66762f93e146a12e5ce72741da48f55d.jpeg\"]', '1462935809');
INSERT INTO `vender_dress_match` VALUES ('2', '1', '图片1', '3.00', '3', '[\"\\/static\\/data\\/dress\\/62\\/301fa0f5808f1d66fbafd18ff7ea9bd6.jpeg\"]', '[]', '1477553878');

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
INSERT INTO `vender_shop` VALUES ('1', 'jack服饰商店', '/static/data/vender_shop_img/81/248b6afccb4b167de5e975390d664ce6.jpg', 'jack服饰商店说明jack服饰商店说明jack服饰商店说明', '[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"]', '020-5656566', '3243242342', 'vx34234');
INSERT INTO `vender_shop` VALUES ('2', 'fsz', '/static/data/vender_shop_img/43/73e927d26448b5e1bb110bb58bcaca35.jpg', 'fszfszfsz', '[\"\\/static\\/data\\/vender_shop_img\\/30\\/d3f7d320ffe9480b925b14b56d7f9921.jpg\"]', '020-65658955', null, null);

-- ----------------------------
-- Table structure for `vote`
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投票记录ID，自增',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰id',
  `identity` varchar(100) DEFAULT NULL COMMENT '投票标识',
  `name` varchar(200) DEFAULT NULL COMMENT '投票名称',
  `description` varchar(500) DEFAULT NULL COMMENT '投票描述',
  `onSalesNumber` varchar(100) DEFAULT NULL COMMENT '上架货号',
  `material` varchar(200) DEFAULT NULL COMMENT '材质',
  `aSize` text COMMENT '尺码',
  `onSalesDay` varchar(50) DEFAULT NULL COMMENT '上架日期',
  `pic` varchar(500) DEFAULT NULL COMMENT '投票图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote
-- ----------------------------
INSERT INTO `vote` VALUES ('3', '1', 'c4ca4238a0b923820dcc509a6f75849b', '1投票名称', '1投票说明', 'sdfsdfs', '棉', '[\"M\",\"L\"]', '2016-10-25', '/static/data/advertisement_position_img/b163f1423b89a0e3d0c573fd7a6702e0.jpeg', '1477364393');
INSERT INTO `vote` VALUES ('4', '2', 'c81e728d9d4c2f636f067f89cc14862c', '2投票名称', '2投票说明', 'gergerg', '布', '[\"M\",\"L\"]', '2016-10-25', '/static/data/advertisement_position_img/ad5d42f5d3f4bc969c82b6e9430dbf9c.jpeg', '1477364432');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_record
-- ----------------------------
