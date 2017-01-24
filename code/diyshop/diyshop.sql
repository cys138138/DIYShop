/*
Navicat MySQL Data Transfer

Source Server         : diy_shop
Source Server Version : 50552
Source Host           : 106.14.73.11:3306
Source Database       : diyshop

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2017-01-24 12:47:43
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of delivery_address
-- ----------------------------
INSERT INTO `delivery_address` VALUES ('1', '1', null, null, '14000', 'jay', '020-8889898', '广州', '海珠区', '人人街', '1', '1468295387');
INSERT INTO `delivery_address` VALUES ('2', '2', null, null, '0', 'asdfadsf', 'asdfadsf', 'Asdfadsfasdf', '北京北京', 'asdfasdf', '1', '1477745184');
INSERT INTO `delivery_address` VALUES ('10', '5', null, null, '0', '梁炜杰', '13560206881', '胡德堡', '广东广州', '石桥公园', '1', '1477983469');
INSERT INTO `delivery_address` VALUES ('11', '7', null, null, '0', '梁米杰', '13560206881', '哈哈哈', '广东广州', '巿桥易发街', '1', '1478056253');
INSERT INTO `delivery_address` VALUES ('13', '4', null, null, '0', '李咯哈', '12345678900', '呵呵呵呵IPO企业水蜜桃你', '广东广州', '番禺区', '1', '1478488703');
INSERT INTO `delivery_address` VALUES ('14', '3', null, null, '0', 'Richardhbgf', '18520220000', 'House abc', '江苏 南京', '鼓楼区', '1', '1478611535');
INSERT INTO `delivery_address` VALUES ('15', '9', null, null, '0', 'giiyt ', '13669855263', 'Rguh ', '广东广州', 'gtt ', '1', '1479128481');
INSERT INTO `delivery_address` VALUES ('16', '11', null, null, '0', 'zhuangjl', '15820259364', '293号 广东技术师范学院', '广东广州', '天河区中山大道', '1', '1479434373');
INSERT INTO `delivery_address` VALUES ('17', '13', null, null, '0', '到点', '15014191886', '第一天上学陈奕迅', '广东广州', '一首', '1', '1482600696');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress
-- ----------------------------
INSERT INTO `dress` VALUES ('16', '1', '241', '一字肩显瘦蕾丝裙（这星期内更新可选搭配和其它颜色）', '欧洲进口传统精制蕾丝', '<p><img src=\"http://unique.xdh-syy.com/static/data/dress/99/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/99/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/90/9f1e71db29ae94bd065f21b14b681440.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/90/9f1e71db29ae94bd065f21b14b681440.jpg\"></p><p><br></p>', '优质针织面料，柔软亲肤，配上欧洲进口的传统蕾丝，让你成为新的焦点', '2', '318.00', '0.01', '[]', '{\"vender\":[\"12\"]}', '4', '0', '1', '1', '1483950622', '1479372194');
INSERT INTO `dress` VALUES ('20', '1', '154', '修身超长款双面毛呢大衣', '精选超顺滑双面顺毛毛呢', '<p><img src=\"http://unique.xdh-syy.com/static/data/dress/34/c02900d248ed604fb68f56ada4682882.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/34/c02900d248ed604fb68f56ada4682882.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/48/9950828576147b54be4f53be7260ca9b.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/48/9950828576147b54be4f53be7260ca9b.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/46/866640273372ffe680f0839d7e110290.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/46/866640273372ffe680f0839d7e110290.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/98/3dfd61e11b81ea8da163e52b51344923.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/98/3dfd61e11b81ea8da163e52b51344923.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/88/6d2a2d2a4d6bcd92b4dc00a2c78f3915.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/88/6d2a2d2a4d6bcd92b4dc00a2c78f3915.jpg\"></p><p><img src=\"http://unique.xdh-syy.com/static/data/dress/91/de72624d6ee83720ec353090039344c1.jpg\" style=\"max-width: 100%;\" _src=\"http://unique.xdh-syy.com/static/data/dress/91/de72624d6ee83720ec353090039344c1.jpg\"></p><p><br></p>', '经典大翻领搭配超长修身下摆，让你成为万众焦点', '2', '872.00', '463.50', '[]', '{\"vender\":[\"12\",\"11\",\"13\",\"14\",\"15\",\"16\"]}', '0', '0', '1', '1', '1483950710', '1482918296');

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
) ENGINE=MyISAM AUTO_INCREMENT=328 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_catalog
-- ----------------------------
INSERT INTO `dress_catalog` VALUES ('1', '1', '翻驳尖领', '1');
INSERT INTO `dress_catalog` VALUES ('224', '196', ' 包臀前开叉中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('7', '1', '立领', '1');
INSERT INTO `dress_catalog` VALUES ('8', '1', '直筒袖口', '1');
INSERT INTO `dress_catalog` VALUES ('223', '196', '长裙里料下摆', '1');
INSERT INTO `dress_catalog` VALUES ('222', '196', '中长裙里料下摆', '1');
INSERT INTO `dress_catalog` VALUES ('221', '196', '短裙里料下摆', '1');
INSERT INTO `dress_catalog` VALUES ('220', '196', '蓬蓬长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('219', '196', '蓬蓬中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('218', '196', '蓬蓬短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('217', '196', '包臀后开叉长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('247', '196', '纽扣蓬蓬中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('216', '196', '包臀前开叉长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('215', '196', '包臀中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('214', '196', '包臀短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('213', '196', 'A型长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('212', '196', 'A型中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('211', '196', 'A型短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('210', '196', '束腰', '1');
INSERT INTO `dress_catalog` VALUES ('209', '202', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('208', '202', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('246', '196', '纽扣蓬蓬短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('245', '196', '纽扣束腰', '1');
INSERT INTO `dress_catalog` VALUES ('207', '202', '短袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('206', '202', '立领', '1');
INSERT INTO `dress_catalog` VALUES ('205', '202', '尖角领', '1');
INSERT INTO `dress_catalog` VALUES ('204', '202', '平方领', '1');
INSERT INTO `dress_catalog` VALUES ('203', '202', '斜方领', '1');
INSERT INTO `dress_catalog` VALUES ('202', '0', 'POLO衫', '1');
INSERT INTO `dress_catalog` VALUES ('201', '175', '海军领', '1');
INSERT INTO `dress_catalog` VALUES ('200', '175', '圆平领', '1');
INSERT INTO `dress_catalog` VALUES ('199', '175', '尖角平领', '1');
INSERT INTO `dress_catalog` VALUES ('198', '175', '鸡心领', '1');
INSERT INTO `dress_catalog` VALUES ('244', '196', '纽扣A型长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('243', '196', '纽扣A型中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('197', '175', '方领', '1');
INSERT INTO `dress_catalog` VALUES ('196', '0', '半裙', '1');
INSERT INTO `dress_catalog` VALUES ('195', '0', '外套', '1');
INSERT INTO `dress_catalog` VALUES ('194', '0', '裤', '1');
INSERT INTO `dress_catalog` VALUES ('193', '175', '过肩V领', '1');
INSERT INTO `dress_catalog` VALUES ('192', '175', '肩V领', '1');
INSERT INTO `dress_catalog` VALUES ('191', '175', '过肩一字领', '1');
INSERT INTO `dress_catalog` VALUES ('190', '175', '肩一字领', '1');
INSERT INTO `dress_catalog` VALUES ('189', '175', '一字领', '1');
INSERT INTO `dress_catalog` VALUES ('242', '196', '纽扣A型短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('241', '0', '连衣裙', '1');
INSERT INTO `dress_catalog` VALUES ('240', '175', '斜肩领', '1');
INSERT INTO `dress_catalog` VALUES ('238', '194', '女装七分裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('239', '194', '女装高腰裤裤头', '1');
INSERT INTO `dress_catalog` VALUES ('237', '194', '女装九分裙裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('188', '175', '宽V领', '1');
INSERT INTO `dress_catalog` VALUES ('187', '175', '深V领', '1');
INSERT INTO `dress_catalog` VALUES ('186', '175', 'V领', '1');
INSERT INTO `dress_catalog` VALUES ('185', '175', '大圆领', '1');
INSERT INTO `dress_catalog` VALUES ('184', '175', '圆领', '1');
INSERT INTO `dress_catalog` VALUES ('183', '175', '露脐下摆', '1');
INSERT INTO `dress_catalog` VALUES ('182', '175', '超长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('181', '175', '中长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('180', '175', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('179', '175', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('178', '175', '九分袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('177', '175', '七分袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('176', '175', '短袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('175', '0', '恤衫', '1');
INSERT INTO `dress_catalog` VALUES ('174', '170', '帽子', '1');
INSERT INTO `dress_catalog` VALUES ('267', '170', '宽V领', '1');
INSERT INTO `dress_catalog` VALUES ('173', '170', '帽接驳位', '1');
INSERT INTO `dress_catalog` VALUES ('172', '170', '袖口', '1');
INSERT INTO `dress_catalog` VALUES ('171', '170', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('170', '0', '卫衣', '1');
INSERT INTO `dress_catalog` VALUES ('169', '154', '超长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('167', '154', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('168', '154', '中长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('166', '154', '超长款戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('236', '194', '喇叭裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('235', '194', '女装长裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('233', '194', '女装七分裤小裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('226', '194', '男装裤头', '1');
INSERT INTO `dress_catalog` VALUES ('165', '154', '中长款戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('164', '154', '戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('163', '154', '葫芦领', '1');
INSERT INTO `dress_catalog` VALUES ('162', '154', '超长款翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('161', '154', '中长款翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('160', '154', '翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('159', '154', '翻领', '1');
INSERT INTO `dress_catalog` VALUES ('158', '154', '立领', '1');
INSERT INTO `dress_catalog` VALUES ('156', '154', '荷叶袖口', '1');
INSERT INTO `dress_catalog` VALUES ('155', '154', '直筒袖口', '1');
INSERT INTO `dress_catalog` VALUES ('153', '1', '翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('234', '194', '男装九分裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('232', '194', '女装九分裤小裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('231', '194', '女装长裤小裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('230', '194', '男装长裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('229', '194', '女装裤头', '1');
INSERT INTO `dress_catalog` VALUES ('228', '194', '女装短裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('227', '194', '男装短裤裤脚', '1');
INSERT INTO `dress_catalog` VALUES ('225', '196', '包臀后开叉中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('154', '0', '大衣', '1');
INSERT INTO `dress_catalog` VALUES ('248', '196', '纽扣蓬蓬长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('265', '196', '高腰纽扣束腰', '1');
INSERT INTO `dress_catalog` VALUES ('264', '196', '高腰束腰', '1');
INSERT INTO `dress_catalog` VALUES ('252', '0', '风衣', '1');
INSERT INTO `dress_catalog` VALUES ('253', '0', '开衫', '1');
INSERT INTO `dress_catalog` VALUES ('254', '0', '衬衫', '1');
INSERT INTO `dress_catalog` VALUES ('273', '241', '包臀下摆', '1');
INSERT INTO `dress_catalog` VALUES ('257', '170', '圆领', '1');
INSERT INTO `dress_catalog` VALUES ('258', '170', '高领', '1');
INSERT INTO `dress_catalog` VALUES ('259', '170', 'V领', '1');
INSERT INTO `dress_catalog` VALUES ('260', '170', '大圆领', '1');
INSERT INTO `dress_catalog` VALUES ('261', '196', '短裙束腰下摆', '1');
INSERT INTO `dress_catalog` VALUES ('262', '196', '中长款束腰下摆', '1');
INSERT INTO `dress_catalog` VALUES ('263', '196', '长裙束腰下摆', '1');
INSERT INTO `dress_catalog` VALUES ('266', '196', '纽扣束腰下摆', '1');
INSERT INTO `dress_catalog` VALUES ('268', '170', '一字领', '1');
INSERT INTO `dress_catalog` VALUES ('269', '252', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('270', '252', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('271', '252', '中长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('272', '252', '超长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('274', '241', '包臀前开叉中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('275', '241', '包臀前开叉长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('276', '0', '毛衣', '1');
INSERT INTO `dress_catalog` VALUES ('277', '276', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('278', '276', '下摆', '1');
INSERT INTO `dress_catalog` VALUES ('279', '276', '中长款下摆', '1');
INSERT INTO `dress_catalog` VALUES ('280', '276', '高领', '1');
INSERT INTO `dress_catalog` VALUES ('281', '276', '圆领', '1');
INSERT INTO `dress_catalog` VALUES ('282', '276', 'V领', '1');
INSERT INTO `dress_catalog` VALUES ('283', '276', '大圆领', '1');
INSERT INTO `dress_catalog` VALUES ('284', '276', '宽V领', '1');
INSERT INTO `dress_catalog` VALUES ('285', '241', '束腰', '1');
INSERT INTO `dress_catalog` VALUES ('286', '241', 'A型短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('287', '241', 'A型中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('288', '241', 'A型长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('289', '241', '蓬蓬短裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('290', '241', '蓬蓬中长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('291', '241', '蓬蓬长裙下摆', '1');
INSERT INTO `dress_catalog` VALUES ('292', '241', '短袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('293', '241', '无袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('294', '241', '七分袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('295', '241', '九分袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('296', '241', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('297', '241', '肩一字领', '1');
INSERT INTO `dress_catalog` VALUES ('298', '241', '一字领', '1');
INSERT INTO `dress_catalog` VALUES ('299', '241', '过肩一字领', '1');
INSERT INTO `dress_catalog` VALUES ('300', '241', '圆领', '1');
INSERT INTO `dress_catalog` VALUES ('301', '241', '大圆领', '1');
INSERT INTO `dress_catalog` VALUES ('302', '241', 'V领', '1');
INSERT INTO `dress_catalog` VALUES ('303', '241', '宽V领', '1');
INSERT INTO `dress_catalog` VALUES ('304', '241', '方领', '1');
INSERT INTO `dress_catalog` VALUES ('305', '241', '鸡心领', '1');
INSERT INTO `dress_catalog` VALUES ('306', '241', '水手领', '1');
INSERT INTO `dress_catalog` VALUES ('307', '241', '翻领', '1');
INSERT INTO `dress_catalog` VALUES ('308', '276', '大翻领', '1');
INSERT INTO `dress_catalog` VALUES ('309', '276', '高翻领', '1');
INSERT INTO `dress_catalog` VALUES ('310', '252', '立领', '1');
INSERT INTO `dress_catalog` VALUES ('311', '252', '翻领', '1');
INSERT INTO `dress_catalog` VALUES ('312', '252', '翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('313', '252', '中长款翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('314', '252', '超长款翻驳领', '1');
INSERT INTO `dress_catalog` VALUES ('315', '252', '戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('316', '252', '中长款戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('317', '252', '超长款戗驳领', '1');
INSERT INTO `dress_catalog` VALUES ('318', '254', '立领', '1');
INSERT INTO `dress_catalog` VALUES ('319', '254', '尖角领', '1');
INSERT INTO `dress_catalog` VALUES ('320', '254', '平方领', '1');
INSERT INTO `dress_catalog` VALUES ('321', '254', '斜方领', '1');
INSERT INTO `dress_catalog` VALUES ('322', '254', '长袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('323', '254', '短袖袖口', '1');
INSERT INTO `dress_catalog` VALUES ('324', '252', '里布', '1');
INSERT INTO `dress_catalog` VALUES ('325', '154', '里布', '1');
INSERT INTO `dress_catalog` VALUES ('326', '241', '里布', '1');
INSERT INTO `dress_catalog` VALUES ('327', '154', '换纽扣', '1');

-- ----------------------------
-- Table structure for `dress_comment`
-- ----------------------------
DROP TABLE IF EXISTS `dress_comment`;
CREATE TABLE `dress_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '服饰评论ID，自增',
  `order_number` varchar(200) DEFAULT NULL COMMENT '订单号',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `desc_point` int(11) DEFAULT NULL COMMENT '描述评分',
  `delivery_point` int(11) DEFAULT NULL COMMENT '物流服务评分',
  `service_point` int(11) DEFAULT NULL COMMENT '服务态度评分',
  `comment` text COMMENT '评论内容',
  `pics` text COMMENT '图片',
  `is_anonymous` tinyint(4) DEFAULT NULL COMMENT '是否匿名',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_comment
-- ----------------------------
INSERT INTO `dress_comment` VALUES ('1', null, '1', '1', '2', '3', '4', '好看', null, null, '1472548865');
INSERT INTO `dress_comment` VALUES ('2', null, '1', '1', '2', '3', '4', '好看', null, null, '1477876688');
INSERT INTO `dress_comment` VALUES ('3', '24f5537b4db873a1b67508c6af9fbf0b', '2', '2', '2', '3', '4', '好看', null, null, '1477876688');
INSERT INTO `dress_comment` VALUES ('4', null, '9', '3', '4', '4', '4', '', null, null, '1478530786');
INSERT INTO `dress_comment` VALUES ('5', null, '9', '3', '4', '5', '3', '', null, null, '1478531596');
INSERT INTO `dress_comment` VALUES ('6', null, '9', '3', '3', '2', '2', '', null, null, '1478533452');
INSERT INTO `dress_comment` VALUES ('7', null, '9', '3', '3', '2', '0', 'Safsdfsad', null, null, '1478533569');
INSERT INTO `dress_comment` VALUES ('8', '29b687546d188aad9fed3c7e1ab63c6e', '9', '3', '4', '3', '4', '测试评价评价啊啊啊 ', '\"\"', '1', '1478609653');
INSERT INTO `dress_comment` VALUES ('9', '85b9053ef10a249cec5e50b76b4ca5ed', '12', '3', '4', '3', '4', '测试评价评价啊啊啊 ', '[\"http:\\/\\/ww3.sinaimg.cn\\/large\\/006tNc79gw1f9l12jzf2oj30h408uab6.jpg\"]', '1', '1478612262');
INSERT INTO `dress_comment` VALUES ('10', '85b9053ef10a249cec5e50b76b4ca5ed', '12', '3', '4', '3', '4', '测试评价评价啊啊啊 ', '[\"Fggs3T0BRs3me-qxgu-HBWmYUO6Q\",\"Fggs3T0BRs3me-qxgu-HBWmYUO6Q\",\"Fggs3T0BRs3me-qxgu-HBWmYUO6Q\"]', '1', '1478612820');
INSERT INTO `dress_comment` VALUES ('11', 'ff80ebf6f48131b7639bf2e3d569dfaf', '9', '4', '4', '3', '2', '我饿了', '[\"d13bb050b81ba0feb06cfe577c4c187e1478676996\"]', '1', '1478677777');
INSERT INTO `dress_comment` VALUES ('12', '893e75d8c829ef4e47b28cd455920c39', '1', '3', '3', '4', '2', '不得不说是', '[\"51e16c8b5ee224cbda3b6d5ea9ec83d91478679645\"]', '0', '1478679653');
INSERT INTO `dress_comment` VALUES ('13', '893e75d8c829ef4e47b28cd455920c39', '5', '3', '0', '0', '0', '南山南', '[\"51e16c8b5ee224cbda3b6d5ea9ec83d91478679650\"]', '0', '1478679653');
INSERT INTO `dress_comment` VALUES ('14', 'ace23317daab07abce4d2d020602e3c5', '12', '4', '4', '4', '3', '啦啦啦', '[\"42b8aac0452ce45b1337c57652d466ae1478745935\"]', '1', '1478745771');
INSERT INTO `dress_comment` VALUES ('15', 'ace23317daab07abce4d2d020602e3c5', '12', '4', '2', '3', '4', '，哦。n', '[\"42b8aac0452ce45b1337c57652d466ae1478746017\"]', '1', '1478745864');
INSERT INTO `dress_comment` VALUES ('16', '8f894af301677db1d4ff3e683ca7c8c1', '12', '7', '0', '0', '0', '我爱何诗琪', '[\"f6c70f7ab472aeced3d46536715244341478746031\"]', '0', '1478746036');
INSERT INTO `dress_comment` VALUES ('17', '796116c9f2ede53ca707f01e84e9a62c', '9', '3', '5', '3', '0', '哈哈哈哈', '[\"51e16c8b5ee224cbda3b6d5ea9ec83d91478755260\"]', '0', '1478755275');
INSERT INTO `dress_comment` VALUES ('18', 'd732132801c674091da12d50cce4a998', '9', '3', '4', '4', '3', '我要砍老板', '[\"51e16c8b5ee224cbda3b6d5ea9ec83d91478755662\"]', '1', '1478755669');
INSERT INTO `dress_comment` VALUES ('19', '84931dbdb9bb68a5000f604cc4b67852', '9', '3', '4', '2', '2', '呵呵呵呵我好', '[\"51e16c8b5ee224cbda3b6d5ea9ec83d91478755757\",\"51e16c8b5ee224cbda3b6d5ea9ec83d91478755767\",\"51e16c8b5ee224cbda3b6d5ea9ec83d91478755782\"]', '0', '1478755792');
INSERT INTO `dress_comment` VALUES ('20', '5f9f945f310af6d610775b2f6fc41fb2', '1', '4', '3', '3', '0', '爸比回来', '[\"5c09bad77aa993519d8506e63f1bfa0a1478942431\"]', '1', '1478942277');
INSERT INTO `dress_comment` VALUES ('21', '31cbcbeda5048a6180ed81610807523f', '1', '2', '2', '3', '4', '好看', '[]', '0', '1478957476');
INSERT INTO `dress_comment` VALUES ('22', '7e078574bb0f3e71deced031f1e80505', '9', '4', '5', '4', '3', '会哭死哭死', '[\"700f88ccf5f231a589b7d92c0eca2ddc1479191761\"]', '1', '1479191590');
INSERT INTO `dress_comment` VALUES ('23', '208e0cd760db5955026864d722dbb84d', '9', '3', '5', '3', '0', '哈哈哈哈哈', '[]', '0', '1479261413');
INSERT INTO `dress_comment` VALUES ('24', '1479112377834299', '13', '7', '5', '5', '5', '我爱何诗琪', '[]', '0', '1479268414');

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_decoration
-- ----------------------------
INSERT INTO `dress_decoration` VALUES ('6', '兔子可爱风小饰件', '4.80', '[\"\\/static\\/data\\/dress\\/20\\/204eeaa92c6eba75e7b779c601dbde67.jpg\"]', '/static/data/dress/21/3809dd30ceeb0e814deb6640cff9188d.png', null);
INSERT INTO `dress_decoration` VALUES ('9', '图章2', '6.20', '[\"\\/static\\/data\\/dress\\/94\\/00e3ec59c914ac3363b0a346c19f2ecb.jpg\"]', '/static/data/dress/34/fcd443e60a28a6f3b37ba02a3cf5f3ca.png', null);
INSERT INTO `dress_decoration` VALUES ('8', '图章1', '6.20', '[\"\\/static\\/data\\/dress\\/71\\/0b7ef4ac69fac19a3958748087622a74.jpg\"]', '/static/data/dress/24/968a1162a13976b22932b88049a78421.png', null);
INSERT INTO `dress_decoration` VALUES ('5', '少女心型织物小饰件', '5.00', '[\"\\/static\\/data\\/dress\\/26\\/33c7517cc272b0052d3b62f6c1dbc5db.jpg\"]', '/static/data/dress/57/cbe547afce9d61de75a2d2ce5cc3372c.png', null);
INSERT INTO `dress_decoration` VALUES ('10', '图章3', '6.80', '[\"\\/static\\/data\\/dress\\/79\\/c2d46fcfda4dbf6d2a30363d9d3b5d2c.jpg\"]', '/static/data/dress/47/e794c76755a1765446931a520fb5914d.png', null);
INSERT INTO `dress_decoration` VALUES ('11', '图章4', '6.80', '[\"\\/static\\/data\\/dress\\/45\\/db01b453f0000eda9e2aca9386df3c99.jpg\"]', '/static/data/dress/26/c2c7976c676eee958f6664fb7557ba38.png', null);
INSERT INTO `dress_decoration` VALUES ('12', '图章5', '6.80', '[\"\\/static\\/data\\/dress\\/78\\/d53899e2ce09b35e5d912e3425199b7a.jpg\"]', '/static/data/dress/27/c76ce310e3d97be7f3685fa87534e940.png', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_material
-- ----------------------------
INSERT INTO `dress_material` VALUES ('13', '0', '0', '纯棉');
INSERT INTO `dress_material` VALUES ('67', '1', '1', '尼龙');
INSERT INTO `dress_material` VALUES ('66', '1', '1', '麻布');
INSERT INTO `dress_material` VALUES ('96', '0', '0', '法兰绒');
INSERT INTO `dress_material` VALUES ('162', '1', '12', '蕾丝');
INSERT INTO `dress_material` VALUES ('65', '1', '1', '纯棉');
INSERT INTO `dress_material` VALUES ('69', '1', '4', '纯棉');
INSERT INTO `dress_material` VALUES ('76', '1', '5', '纯棉');
INSERT INTO `dress_material` VALUES ('78', '1', '6', '蕾丝');
INSERT INTO `dress_material` VALUES ('79', '1', '7', '纯棉');
INSERT INTO `dress_material` VALUES ('80', '1', '8', '蕾丝');
INSERT INTO `dress_material` VALUES ('173', '1', '9', '传统蕾丝');
INSERT INTO `dress_material` VALUES ('84', '1', '10', '尼龙');
INSERT INTO `dress_material` VALUES ('85', '2', '11', '尼龙');
INSERT INTO `dress_material` VALUES ('97', '0', '0', '牛仔布');
INSERT INTO `dress_material` VALUES ('98', '0', '0', '呢绒');
INSERT INTO `dress_material` VALUES ('99', '0', '0', '华达呢');
INSERT INTO `dress_material` VALUES ('100', '0', '0', '传统蕾丝');
INSERT INTO `dress_material` VALUES ('101', '0', '0', '大众蕾丝');
INSERT INTO `dress_material` VALUES ('102', '0', '0', '金属织物');
INSERT INTO `dress_material` VALUES ('103', '0', '0', '麦尔登呢');
INSERT INTO `dress_material` VALUES ('104', '0', '0', '天鹅绒');
INSERT INTO `dress_material` VALUES ('105', '0', '0', '毛巾布');
INSERT INTO `dress_material` VALUES ('106', '0', '0', '罗纹布');
INSERT INTO `dress_material` VALUES ('107', '0', '0', '灯芯绒');
INSERT INTO `dress_material` VALUES ('108', '0', '0', '网眼针织物');
INSERT INTO `dress_material` VALUES ('193', '1', '13', '羊毛混纺');
INSERT INTO `dress_material` VALUES ('171', '1', '14', '蕾丝');
INSERT INTO `dress_material` VALUES ('176', '1', '15', '传统蕾丝');
INSERT INTO `dress_material` VALUES ('253', '1', '16', '优质针织里料');
INSERT INTO `dress_material` VALUES ('214', '1', '17', '传统蕾丝');
INSERT INTO `dress_material` VALUES ('252', '1', '16', '传统蕾丝');
INSERT INTO `dress_material` VALUES ('222', '1', '18', '精梳棉');
INSERT INTO `dress_material` VALUES ('226', '1', '19', '双面顺毛毛呢');
INSERT INTO `dress_material` VALUES ('254', '1', '20', '双面顺毛毛呢');

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
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_size_color_count
-- ----------------------------
INSERT INTO `dress_size_color_count` VALUES ('119', '1', '1', 'L', '白', '1', '[\"\\/static\\/data\\/dress\\/68\\/65bf9fe0a8be893a950610da0a06964a.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('28', '2', '2', 'M', '黑', '44', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('27', '2', '2', 'S', '白', '620', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('29', '2', '3', 'S', '黑', '22', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('30', '2', '3', 'M', '白', '27', '[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"]', null);
INSERT INTO `dress_size_color_count` VALUES ('118', '1', '1', 'M', '黑', '91', '[\"\\/static\\/data\\/dress\\/46\\/528c7711fa59aa21b5c2aa5fd41d77aa.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('117', '1', '1', 'M', '白', '3', '[\"\\/static\\/data\\/dress\\/56\\/d968a747fb51ac389b98625d35134fd5.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('116', '1', '1', 'S', '黑', '2', '[\"\\/static\\/data\\/dress\\/44\\/3457b2c606824d7f2bbfa1cba0ec1c5e.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('115', '1', '1', 'S', '白', '0', '[\"\\/static\\/data\\/dress\\/50\\/47d87108a8ca8d399644ce81558c1c4f.jpeg\"]', '[\"\\/static\\/data\\/dress\\/49\\/6219e6bcfe1ad9340f3e8db510fe6753.jpeg\",\"\\/static\\/data\\/dress\\/51\\/3f5e612a20afbb10466ad847722e7bca.jpeg\"]');
INSERT INTO `dress_size_color_count` VALUES ('120', '1', '1', 'L', '黑', '6', '[\"\\/static\\/data\\/dress\\/19\\/70efe04af8aab3e7df75eec16c4495b7.jpeg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('123', '1', '4', 'L', '黑', '55', '[\"\\/static\\/data\\/dress\\/19\\/70efe04af8aab3e7df75eec16c4495b7.jpeg\"]', '[\"\\/static\\/data\\/dress\\/12\\/d2a39c09b0117460865d6ce3e95bcee4.jpg\",\"\\/static\\/data\\/dress\\/41\\/6c7f524bd8326ba2fef09f91608d7b7e.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('124', '1', '5', 'L', '白', '51', '[\"\\/static\\/data\\/dress\\/19\\/70efe04af8aab3e7df75eec16c4495b7.jpeg\",\"\\/static\\/data\\/dress\\/79\\/6daf9ac1319af4f811135955bc7fb4cf.jpeg\"]', '[\"\\/static\\/data\\/dress\\/70\\/e7eb12a5c2d2b637558f4c49402d6b63.jpg\",\"\\/static\\/data\\/dress\\/87\\/de602c056f78d80855adffb5fdd84696.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('125', '1', '6', 'M', '白', '12', '[\"\\/static\\/data\\/dress\\/38\\/d46239aa1f49d5282eedd194a73e9593.jpg\"]', '[\"\\/static\\/data\\/dress\\/90\\/cb2f612fc9ce6e325a5079f410b626af.jpg\",\"\\/static\\/data\\/dress\\/57\\/000d4f90ae4d85c58bd4f6796b4d5c6c.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('126', '1', '7', 'L', '白', '1', '[]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('127', '1', '8', 'M', '白', '2321', '[\"\\/static\\/data\\/dress\\/23\\/bd05ad88652fc12ac591db58e687b17c.jpg\"]', '[\"\\/static\\/data\\/dress\\/24\\/71381724b2c5e6580729b367bac4a7b3.jpg\",\"\\/static\\/data\\/dress\\/90\\/c6b879342c27d896311fd572b41d4155.png\"]');
INSERT INTO `dress_size_color_count` VALUES ('128', '1', '9', 'M', '白', '1147', '[\"\\/static\\/data\\/dress\\/19\\/0771c736ecf33814aa8002f16bb60331.jpg\"]', '[\"\\/static\\/data\\/dress\\/97\\/7c6cde75c539b742cee10be253e68790.jpg\",\"\\/static\\/data\\/dress\\/62\\/a1bca823cc9e3624dfd8f48e613a5ada.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('129', '1', '10', 'M', '白', '131', '[\"\\/static\\/data\\/dress\\/60\\/e72c47099a52a0f44b7791f96ff2ea4c.jpg\"]', '[\"\\/static\\/data\\/dress\\/39\\/e9727d8eb34221ab39960559de50a928.jpg\",\"\\/static\\/data\\/dress\\/56\\/f326f3a4a2094ffff394e5ce0be5f2e6.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('130', '2', '11', 'M', '黑', '3123', '[\"\\/static\\/data\\/dress\\/32\\/c18de84a98a8137d5ee5efaa87369a69.jpg\"]', '[\"\\/static\\/data\\/dress\\/92\\/8ff49d4543023c426240111bc419b448.jpg\",\"\\/static\\/data\\/dress\\/10\\/e79bf2ee5d98f2cee41e0e7254e3f74c.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('131', '1', '12', 'S', '黑', '1177', '[\"\\/static\\/data\\/dress\\/73\\/6a149f9a8638b4cecafa0efaed961444.jpg\"]', '[\"\\/static\\/data\\/dress\\/76\\/0ca81ee06b12bf56280832c6ed587665.jpg\",\"\\/static\\/data\\/dress\\/57\\/214d52161179889c2d986a67f1dac8ac.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('132', '1', '13', 'M', '黑', '1288', '[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"]', '[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('133', '1', '13', 'L', '灰', '222', '[\"\\/static\\/data\\/dress\\/83\\/36b40c7f3a7d73416f10caac1016c74b.jpg\"]', '[\"\\/static\\/data\\/dress\\/74\\/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg\",\"\\/static\\/data\\/dress\\/64\\/267f488379812966df56196b44ab457f.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('134', '1', '14', 'M', '黑', '1111', '[\"\\/static\\/data\\/dress\\/79\\/6c4d63b69de90e9af41f1b60d0e766cc.jpg\",\"\\/static\\/data\\/dress\\/39\\/8018676e4848e7919b981d12a387bafd.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('135', '1', '14', 'L', '黑', '1231', '[\"\\/static\\/data\\/dress\\/61\\/799a7bca269e616e9e9a43b0287b060c.jpg\",\"\\/static\\/data\\/dress\\/11\\/e2815efe4c917b335cc16a6f2e653c4c.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('136', '1', '15', 'L', '白', '131', '[\"\\/static\\/data\\/dress\\/44\\/86a08265d41e657f2e7b5938fb390991.jpg\",\"\\/static\\/data\\/dress\\/43\\/c835ddd17c82e8fe202d8e8e31772362.jpg\"]', '[\"\\/static\\/data\\/dress\\/95\\/a15375836ecd8029e38bb526dd6f86db.jpg\",\"\\/static\\/data\\/dress\\/41\\/566d2a2eb74e2b95222ca997c7e0a833.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('137', '1', '16', 'M', '白', '17', '[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"]', '[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('138', '1', '16', 'L', '白', '21', '[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"]', '[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]');
INSERT INTO `dress_size_color_count` VALUES ('139', '1', '17', 'L', '黑', '101', '[\"\\/static\\/data\\/dress\\/68\\/11083b65e2359c80dd141ac7d757588c.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('140', '1', '17', 'XL', '黑', '108', '[\"\\/static\\/data\\/dress\\/91\\/388cb762fdd2314c498316f99798e5a8.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('142', '1', '18', 'M', '靛蓝', '20', '[\"\\/static\\/data\\/dress\\/52\\/bd34750d88c3f236a4de22930e2ee062.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('143', '1', '18', 'L', '靛蓝', '20', '[\"\\/static\\/data\\/dress\\/74\\/b7f63b717abefe86777c8f91018efd07.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('144', '1', '18', 'XL', '靛蓝', '20', '[\"\\/static\\/data\\/dress\\/52\\/f100e9a4c37b0e7e04b014a40637c606.jpg\"]', '[\"\",\"\"]');
INSERT INTO `dress_size_color_count` VALUES ('145', '1', '19', 'S', '淡粉色', '20', '[\"\\/static\\/data\\/dress\\/73\\/3847af6504d583da154d58645773c24d.png\"]', '[\"\\/static\\/data\\/dress\\/34\\/acc5a097c4590436489fb7ff13e72fee.png\",\"\\/static\\/data\\/dress\\/72\\/b300f932f16aac2674771b8eaeed253e.png\"]');
INSERT INTO `dress_size_color_count` VALUES ('146', '1', '19', 'M', '淡粉色', '20', '[\"\\/static\\/data\\/dress\\/53\\/906fda996c5baa08f344075c06c079e2.png\"]', '[\"\\/static\\/data\\/dress\\/16\\/1260eab1f98580aaaeeba41ea3dae14b.png\",\"\\/static\\/data\\/dress\\/72\\/887133a4ffdba9fec3528dbd75f1ae58.png\"]');
INSERT INTO `dress_size_color_count` VALUES ('147', '1', '19', 'L', '淡粉色', '10', '[\"\\/static\\/data\\/dress\\/20\\/27cd8fc9b645f8390063ff3499af1ea3.png\"]', '[\"\\/static\\/data\\/dress\\/71\\/e10d09fe0f3948bcc83db1ba8e5da77e.png\",\"\\/static\\/data\\/dress\\/42\\/9cce75da41e8b9899acb000bf4703703.png\"]');
INSERT INTO `dress_size_color_count` VALUES ('148', '1', '20', 'S', '杏色', '15', '[\"\\/static\\/data\\/dress\\/26\\/26535cf7298ff9b4d0a03404c8a62d1f.jpg\",\"\\/static\\/data\\/dress\\/54\\/2b6fe561d37f234851e2f66cad522ccd.jpg\"]', '[\"\\/static\\/data\\/dress\\/23\\/259b0900c76878f1eefd2667d00e384d.png\",\"\\/static\\/data\\/dress\\/10\\/63f9ba374757979b0ec6efcba88a1fbc.png\"]');
INSERT INTO `dress_size_color_count` VALUES ('149', '1', '20', 'M', '杏色', '15', '[\"\\/static\\/data\\/dress\\/42\\/6569c81cae8b779cb613b19c459e261f.jpg\",\"\\/static\\/data\\/dress\\/88\\/180d75a4a78c103ca850d44cac57279d.jpg\"]', '[\"\\/static\\/data\\/dress\\/77\\/f86721fb1a704323106a7e44e5e06262.png\",\"\\/static\\/data\\/dress\\/17\\/48f120fd3c20e51c3caab86876ee3a18.png\"]');

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
) ENGINE=MyISAM AUTO_INCREMENT=333 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dress_tag
-- ----------------------------
INSERT INTO `dress_tag` VALUES ('57', '1', '1', '秋冬');
INSERT INTO `dress_tag` VALUES ('56', '1', '1', '夹克');
INSERT INTO `dress_tag` VALUES ('10', '2', '2', '帅');
INSERT INTO `dress_tag` VALUES ('11', '2', '3', '帅');
INSERT INTO `dress_tag` VALUES ('59', '1', '4', 'T恤');
INSERT INTO `dress_tag` VALUES ('66', '1', '5', 'T恤');
INSERT INTO `dress_tag` VALUES ('68', '1', '6', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('69', '1', '7', '秋冬');
INSERT INTO `dress_tag` VALUES ('70', '1', '8', '夹克');
INSERT INTO `dress_tag` VALUES ('167', '1', '9', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('74', '1', '10', '夹克');
INSERT INTO `dress_tag` VALUES ('75', '2', '11', '帅');
INSERT INTO `dress_tag` VALUES ('146', '1', '12', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('207', '1', '13', '秋冬');
INSERT INTO `dress_tag` VALUES ('206', '1', '13', 'T恤');
INSERT INTO `dress_tag` VALUES ('164', '1', '14', '秋冬');
INSERT INTO `dress_tag` VALUES ('163', '1', '14', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('172', '1', '15', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('173', '1', '15', '秋冬');
INSERT INTO `dress_tag` VALUES ('329', '1', '16', '可爱');
INSERT INTO `dress_tag` VALUES ('249', '1', '17', '秋冬');
INSERT INTO `dress_tag` VALUES ('248', '1', '17', '蕾丝裙');
INSERT INTO `dress_tag` VALUES ('328', '1', '16', '修身');
INSERT INTO `dress_tag` VALUES ('262', '1', '18', '衬衣');
INSERT INTO `dress_tag` VALUES ('263', '1', '18', '商务');
INSERT INTO `dress_tag` VALUES ('275', '1', '19', '大衣');
INSERT INTO `dress_tag` VALUES ('274', '1', '19', '修身');
INSERT INTO `dress_tag` VALUES ('273', '1', '19', '秋冬');
INSERT INTO `dress_tag` VALUES ('332', '1', '20', '修身');
INSERT INTO `dress_tag` VALUES ('331', '1', '20', '大衣');
INSERT INTO `dress_tag` VALUES ('330', '1', '20', '秋冬');
INSERT INTO `dress_tag` VALUES ('327', '1', '16', '蕾丝裙');

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
  `zhen_pic` varchar(500) DEFAULT NULL COMMENT '正面图片',
  `fan_pic` varchar(500) DEFAULT NULL COMMENT '反面图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager_dress_match
-- ----------------------------
INSERT INTO `manager_dress_match` VALUES ('4', '雪纺皱褶下摆', '289', '2', '0.01', '[]', '/static/data/dress/15/0d7ceab1027e10557bf9787c579b6ab9.png', '/static/data/dress/54/18d3a88dd937c3f0530fbeb53e8ee70c.png', '1478056395');

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
INSERT INTO `mark` VALUES ('3', '10', '1', '20170102');
INSERT INTO `mark` VALUES ('4', '12', '1', '20170103');
INSERT INTO `mark` VALUES ('7', '6', '1', '20170102');
INSERT INTO `mark` VALUES ('9', '3', '1', '20161121');
INSERT INTO `mark` VALUES ('13', '2', '1', '20170103');
INSERT INTO `mark` VALUES ('16', '1', '1', '20170116');
INSERT INTO `mark` VALUES ('17', '1', '1', '20170120');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mobile_verify
-- ----------------------------
INSERT INTO `mobile_verify` VALUES ('1', '15014191886', '729199', '1481868996');
INSERT INTO `mobile_verify` VALUES ('2', '13318780833', '992462', '1477745128');
INSERT INTO `mobile_verify` VALUES ('3', '13480244366', '137003', '1477883569');
INSERT INTO `mobile_verify` VALUES ('4', '18520229661', '352038', '1481771809');
INSERT INTO `mobile_verify` VALUES ('5', '13560203881', '555594', '1477929089');
INSERT INTO `mobile_verify` VALUES ('6', '13560206881', '787353', '1479196308');
INSERT INTO `mobile_verify` VALUES ('7', '13697499159', '461133', '1483530056');
INSERT INTO `mobile_verify` VALUES ('8', '13318780828', '452622', '1478397044');
INSERT INTO `mobile_verify` VALUES ('9', '15820259364', '264280', '1482377864');
INSERT INTO `mobile_verify` VALUES ('10', '13711044106', '244287', '1480559183');
INSERT INTO `mobile_verify` VALUES ('11', '13711044109', '918620', '1480559235');
INSERT INTO `mobile_verify` VALUES ('12', '18611664684', '890600', '1482406551');
INSERT INTO `mobile_verify` VALUES ('13', '15807657230', '666240', '1484531265');

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
  `status` int(11) DEFAULT NULL COMMENT '订单状态:1待付款2待发货3待收货6确认收货7失效8交易关闭9退货处理中10退货成功11退货关闭12退款处理中13退款成功14退款关闭15退货退款处理中16退货退款成功17退货退款关闭',
  `buyer_msg` varchar(500) DEFAULT NULL COMMENT '买家留言',
  `express_info` text COMMENT '快递信息',
  `is_comment` tinyint(4) DEFAULT '0' COMMENT '是否已评价',
  `is_use_discount` tinyint(4) DEFAULT NULL COMMENT '是否使用金币折扣',
  `create_time` int(11) DEFAULT NULL COMMENT '确认订单时间',
  `pay_type` tinyint(4) DEFAULT NULL COMMENT '1:支付宝2:微信',
  `pay_money` decimal(10,2) DEFAULT NULL COMMENT '实际付款金额',
  `pay_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `deliver_time` int(11) DEFAULT NULL COMMENT '发货时间',
  `end_time` int(11) DEFAULT NULL COMMENT '确认收货时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100004 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('258', '0', '3', '1', '1482200026311596', '', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u522b\\u62cd\\uff0c\\u53c2\\u8003\\u7528\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u539f\\u6765\\u539f\\u6765\\u4f60\\u662f\\u6211\\u7684\\u4e3b\\u6253\\u6b4c\",\"sex\":\"2\",\"price\":\"581.00\",\"discount_price\":\"99999.00\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1481860485\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"118\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"212\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"254\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"255\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"217\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":212,\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]},\"item_count\":\"1\",\"item_price\":99999,\"delivery_address_info\":{\"id\":\"14\",\"user_id\":\"3\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"Richard\",\"contact\":\"18520220000\",\"address\":\"House abc\",\"area\":\"\\u6d59\\u6c5f\\u676d\\u5dde\",\"street\":\"street1\",\"is_default\":\"1\",\"create_time\":\"1478611535\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '99999.00', '7', '', '[]', '0', '0', '1482200026', '0', '99999.00', '0', '0', '0');
INSERT INTO `order` VALUES ('257', '0', '3', '1', '1482199993341910', '', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u522b\\u62cd\\uff0c\\u53c2\\u8003\\u7528\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u539f\\u6765\\u539f\\u6765\\u4f60\\u662f\\u6211\\u7684\\u4e3b\\u6253\\u6b4c\",\"sex\":\"2\",\"price\":\"581.00\",\"discount_price\":\"99999.00\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1481860485\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"118\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"213\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"254\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"255\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"217\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":118,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":99999,\"delivery_address_info\":{\"id\":\"14\",\"user_id\":\"3\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"Richard\",\"contact\":\"18520220000\",\"address\":\"House abc\",\"area\":\"\\u6d59\\u6c5f\\u676d\\u5dde\",\"street\":\"street1\",\"is_default\":\"1\",\"create_time\":\"1478611535\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '99999.00', '7', '', '[]', '0', '0', '1482199993', '0', '99999.00', '0', '0', '0');
INSERT INTO `order` VALUES ('259', '0', '3', '1', '1482305822942056', '', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u8fd9\\u661f\\u671f\\u5185\\u66f4\\u65b0\\u53ef\\u9009\\u642d\\u914d\\u548c\\u5176\\u5b83\\u989c\\u8272\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u7cbe\\u5236\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u9762\\u6599\\uff0c\\u67d4\\u8f6f\\u4eb2\\u80a4\\uff0c\\u914d\\u4e0a\\u6b27\\u6d32\\u8fdb\\u53e3\\u7684\\u4f20\\u7edf\\u857e\\u4e1d\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u65b0\\u7684\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"318.00\",\"discount_price\":\"186.20\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1482220701\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"19\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"20\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"259\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"260\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"261\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u53ef\\u7231\"}],\"dress_material\":[{\"id\":\"220\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"},{\"id\":\"221\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u91cc\\u6599\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":19,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":186.2,\"delivery_address_info\":{\"id\":\"14\",\"user_id\":\"3\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"Richard\",\"contact\":\"18520220000\",\"address\":\"House abc\",\"area\":\"\\u6d59\\u6c5f\\u676d\\u5dde\",\"street\":\"street1\",\"is_default\":\"1\",\"create_time\":\"1478611535\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '186.20', '15', '', '{\"express_type\":\"tiantian\",\"express_number\":\"550527614980\",\"express_name\":\"\\u5929\\u5929\\u5feb\\u9012\"}', '0', '0', '1482305822', '0', '186.20', '0', '1482374697', '0');
INSERT INTO `order` VALUES ('100000', '0', '13', '1', '2016122417100000', '', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u8fd9\\u661f\\u671f\\u5185\\u66f4\\u65b0\\u53ef\\u9009\\u642d\\u914d\\u548c\\u5176\\u5b83\\u989c\\u8272\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u7cbe\\u5236\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u9762\\u6599\\uff0c\\u67d4\\u8f6f\\u4eb2\\u80a4\\uff0c\\u914d\\u4e0a\\u6b27\\u6d32\\u8fdb\\u53e3\\u7684\\u4f20\\u7edf\\u857e\\u4e1d\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u65b0\\u7684\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"318.00\",\"discount_price\":\"186.20\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1482220701\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"19\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"21\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"259\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"260\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"261\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u53ef\\u7231\"}],\"dress_material\":[{\"id\":\"220\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"},{\"id\":\"221\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u91cc\\u6599\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":19,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":186.2,\"delivery_address_info\":{\"id\":\"17\",\"user_id\":\"13\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"\\u5230\\u70b9\",\"contact\":\"15014191886\",\"address\":\"\\u7b2c\\u4e00\\u5929\\u4e0a\\u5b66\\u9648\\u5955\\u8fc5\",\"area\":\"\\u5e7f\\u4e1c\\u5e7f\\u5dde\",\"street\":\"\\u4e00\\u9996\",\"is_default\":\"1\",\"create_time\":\"1482600696\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '186.20', '7', '', '[]', '0', '0', '1482600881', '0', '186.20', '0', '0', '0');
INSERT INTO `order` VALUES ('100001', '0', '9', '1', '2016122714100001', '', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u8fd9\\u661f\\u671f\\u5185\\u66f4\\u65b0\\u53ef\\u9009\\u642d\\u914d\\u548c\\u5176\\u5b83\\u989c\\u8272\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u7cbe\\u5236\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u9762\\u6599\\uff0c\\u67d4\\u8f6f\\u4eb2\\u80a4\\uff0c\\u914d\\u4e0a\\u6b27\\u6d32\\u8fdb\\u53e3\\u7684\\u4f20\\u7edf\\u857e\\u4e1d\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u65b0\\u7684\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"318.00\",\"discount_price\":\"186.20\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1482220701\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"18\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"21\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"259\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"260\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"261\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u53ef\\u7231\"}],\"dress_material\":[{\"id\":\"220\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"},{\"id\":\"221\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u91cc\\u6599\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":18,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":186.2,\"delivery_address_info\":{\"id\":\"15\",\"user_id\":\"9\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"giiyt \",\"contact\":\"13669855263\",\"address\":\"Rguh \",\"area\":\"\\u5e7f\\u4e1c\\u5e7f\\u5dde\",\"street\":\"gtt \",\"is_default\":\"1\",\"create_time\":\"1479128481\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '186.20', '7', '', '[]', '0', '0', '1482849966', '0', '186.20', '0', '0', '0');
INSERT INTO `order` VALUES ('100002', '0', '3', '1', '2017010206100002', '4003282001201701024888921494', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u8fd9\\u661f\\u671f\\u5185\\u66f4\\u65b0\\u53ef\\u9009\\u642d\\u914d\\u548c\\u5176\\u5b83\\u989c\\u8272\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u7cbe\\u5236\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u9762\\u6599\\uff0c\\u67d4\\u8f6f\\u4eb2\\u80a4\\uff0c\\u914d\\u4e0a\\u6b27\\u6d32\\u8fdb\\u53e3\\u7684\\u4f20\\u7edf\\u857e\\u4e1d\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u65b0\\u7684\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"318.00\",\"discount_price\":\"0.01\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"12\"]},\"sale_count\":\"2\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1483338086\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"18\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"21\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"324\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"325\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"326\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u53ef\\u7231\"}],\"dress_material\":[{\"id\":\"250\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"},{\"id\":\"251\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u91cc\\u6599\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":18,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":0.01,\"delivery_address_info\":{\"id\":\"14\",\"user_id\":\"3\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"Richardhbgf\",\"contact\":\"18520220000\",\"address\":\"House abc\",\"area\":\"\\u6c5f\\u82cf \\u5357\\u4eac\",\"street\":\"\\u9f13\\u697c\\u533a\",\"is_default\":\"1\",\"create_time\":\"1478611535\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\\u53fc\\u4f60\\u5481\\u8d35\"}]', '1', '0.01', '6', '叼你咁贵', '{\"express_type\":\"yuantong\",\"express_number\":\"883954451363266388\",\"express_name\":\"\\u5706\\u901a\\u901f\\u9012\"}', '0', '0', '1483338119', '2', '0.01', '1483338133', '1483339621', '1483606853');
INSERT INTO `order` VALUES ('100003', '0', '3', '1', '2017010402100003', '2017010421001004480223324315', '[{\"item_info\":{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\\uff08\\u8fd9\\u661f\\u671f\\u5185\\u66f4\\u65b0\\u53ef\\u9009\\u642d\\u914d\\u548c\\u5176\\u5b83\\u989c\\u8272\\uff09\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u7cbe\\u5236\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/99\\/ba6a8a73e8bb8e0413d60309ed21cf40.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/90\\/9f1e71db29ae94bd065f21b14b681440.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u9762\\u6599\\uff0c\\u67d4\\u8f6f\\u4eb2\\u80a4\\uff0c\\u914d\\u4e0a\\u6b27\\u6d32\\u8fdb\\u53e3\\u7684\\u4f20\\u7edf\\u857e\\u4e1d\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u65b0\\u7684\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"318.00\",\"discount_price\":\"0.01\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"12\"]},\"sale_count\":\"3\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1483338086\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"17\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"21\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"324\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"325\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"326\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u53ef\\u7231\"}],\"dress_material\":[{\"id\":\"250\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"},{\"id\":\"251\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f18\\u8d28\\u9488\\u7ec7\\u91cc\\u6599\"}]},\"shop_info\":{\"id\":\"1\",\"name\":\"jack\\u670d\\u9970\\u5546\\u5e97\",\"logo\":\"\\/static\\/data\\/vender_shop_img\\/81\\/248b6afccb4b167de5e975390d664ce6.jpg\",\"description\":\"jack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660ejack\\u670d\\u9970\\u5546\\u5e97\\u8bf4\\u660e\",\"pics\":[\"\\/static\\/data\\/vender_shop_img\\/48\\/b0a607eea3104b09e93c1cf779c2852c.jpeg\",\"\\/static\\/data\\/vender_shop_img\\/90\\/7facb3b22e7544c5ab2586b4479360a0.jpeg\"],\"kefu_tel\":\"020-5656566\",\"qq\":\"3243242342\",\"weixin\":\"vx34234\"},\"item_size_color_count_info\":{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":17,\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},\"item_count\":\"1\",\"item_price\":0.01,\"delivery_address_info\":{\"id\":\"14\",\"user_id\":\"3\",\"province_id\":null,\"city_id\":null,\"area_id\":\"0\",\"name\":\"Richardhbgf\",\"contact\":\"18520220000\",\"address\":\"House abc\",\"area\":\"\\u6c5f\\u82cf \\u5357\\u4eac\",\"street\":\"\\u9f13\\u697c\\u533a\",\"is_default\":\"1\",\"create_time\":\"1478611535\"},\"decoration_ids\":[],\"diy_pics\":[],\"dress_match\":[],\"dress_decoration_info\":[],\"dress_match_info\":[],\"buyer_msg\":\"\"}]', '1', '0.01', '12', '', '[]', '0', '0', '1483496519', '1', '0.01', '1483496532', '0', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=393 DEFAULT CHARSET=utf8;

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
INSERT INTO `qiniu_pic_key_map` VALUES ('36', 'FuN_3rohsUf_TNaM_2nH9l3pZx_k', '3d4297d5b1ac469c11fc0d880b7a7331', '/static/data/dress/70/3d4297d5b1ac469c11fc0d880b7a7331.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('37', 'FuN_3rohsUf_TNaM_2nH9l3pZx_k', '172d5b5c4a7948cd9bfacf5a4871f710', '/static/data/dress/61/172d5b5c4a7948cd9bfacf5a4871f710.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('38', 'FoTJ1XS8_mXohp4H17KuG8OdWwFz', '31316886baba38412c56d9509605a380', '/static/data/dress/32/31316886baba38412c56d9509605a380.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('39', 'FoTJ1XS8_mXohp4H17KuG8OdWwFz', '80cc8132a9bf5d84044352dcba0a58ce', '/static/data/dress/20/80cc8132a9bf5d84044352dcba0a58ce.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('40', 'Fs7jMTw4YDG5lDYV8jWsYEo1Ea3s', 'd877fecc7b029bc9c6fbcb1bc9995e42', '/static/data/dress/33/d877fecc7b029bc9c6fbcb1bc9995e42.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('41', 'Fs7jMTw4YDG5lDYV8jWsYEo1Ea3s', 'c4680400c29f044dab12c9cedef329a3', '/static/data/dress/68/c4680400c29f044dab12c9cedef329a3.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('42', 'Fu3-tSHrJ-h9QsIP4Smdi4mz6VmW', 'f579adf6a31c91600001424d8fc09bf2', '/static/data/advertisement_position_img/f579adf6a31c91600001424d8fc09bf2.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('43', 'FmikPBXcO9CAKkrAiEvDJaA0Z5dp', 'd47360af4e98fabee77b7d77a9cd6f87', '/static/data/advertisement_position_img/d47360af4e98fabee77b7d77a9cd6f87.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('44', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', '452f0ed52bbdfc8ffb57c80edba7c99c', '/static/data/dress/67/452f0ed52bbdfc8ffb57c80edba7c99c.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('45', 'Fvm115fGj39FcaMZ7Wq5U1GaMMUk', 'b18b8c6da3850c0dfce22f96f4db9d30', '/static/data/dress/87/b18b8c6da3850c0dfce22f96f4db9d30.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('46', 'Fp-TJR0_7_ILiRB9Qu6pp-gRPhbu', 'ee8bc2c9b1e543a17778ed90b02ff1be', '/static/data/dress/75/ee8bc2c9b1e543a17778ed90b02ff1be.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('47', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'b5e283005918869db76eb8061c19c95d', '/static/data/dress/93/b5e283005918869db76eb8061c19c95d.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('48', 'FnZgRguez-irYHAAzVcgCnUgugFm', '09d603e65d190974d3cb630c74852632', '/static/data/dress/31/09d603e65d190974d3cb630c74852632.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('49', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'faa508c66ba75768317791c016e64dc9', '/static/data/dress/90/faa508c66ba75768317791c016e64dc9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('50', 'FvLWHhqaOh8opH7HUht--9ypmJSz', '71d7b847213b72f6533f76f0ce8ff12d', '/static/data/dress/95/71d7b847213b72f6533f76f0ce8ff12d.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('51', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'f1ea9dbb684a509a863ba4befd076cd2', '/static/data/dress/87/f1ea9dbb684a509a863ba4befd076cd2.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('52', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'd15ea0b67944fa10dc3afcd0d5728c08', '/static/data/dress/21/d15ea0b67944fa10dc3afcd0d5728c08.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('53', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'da97a78fbe2c55abf2927133443c73e0', '/static/data/dress/63/da97a78fbe2c55abf2927133443c73e0.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('54', 'FnZgRguez-irYHAAzVcgCnUgugFm', '1f356f5cedf3d703e286f643c61b04d2', '/static/data/dress/57/1f356f5cedf3d703e286f643c61b04d2.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('55', 'FvLWHhqaOh8opH7HUht--9ypmJSz', '7f6bfc39289f37907c74cd263c1b93a3', '/static/data/dress/19/7f6bfc39289f37907c74cd263c1b93a3.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('56', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'f04455deda87906c9da2a106f1d061b9', '/static/data/dress/78/f04455deda87906c9da2a106f1d061b9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('57', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'e798e33e0bb79ce7f8a6088d36f91fe9', '/static/data/dress/17/e798e33e0bb79ce7f8a6088d36f91fe9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('58', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'f0548f14ca76a8c85f566db2c4f36646', '/static/data/dress/93/f0548f14ca76a8c85f566db2c4f36646.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('59', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'f7847519eb536f5115ff0a6bc2bf67bc', '/static/data/dress/41/f7847519eb536f5115ff0a6bc2bf67bc.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('60', 'FnZgRguez-irYHAAzVcgCnUgugFm', '07886b9530ce664620ba962e914bd6dc', '/static/data/dress/85/07886b9530ce664620ba962e914bd6dc.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('61', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'c014f9c011b800753e55b45fae9b88db', '/static/data/dress/59/c014f9c011b800753e55b45fae9b88db.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('62', 'FnZgRguez-irYHAAzVcgCnUgugFm', '8e1370cbb19f868f04aa46d48a9990c8', '/static/data/dress/95/8e1370cbb19f868f04aa46d48a9990c8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('63', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'd991e02569a541913b084a4eabc97883', '/static/data/dress/14/d991e02569a541913b084a4eabc97883.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('64', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'd2a39c09b0117460865d6ce3e95bcee4', '/static/data/dress/12/d2a39c09b0117460865d6ce3e95bcee4.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('65', 'FnZgRguez-irYHAAzVcgCnUgugFm', '609f3937ff972a1f48af67ecf5f5dff7', '/static/data/dress/78/609f3937ff972a1f48af67ecf5f5dff7.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('66', 'FvLWHhqaOh8opH7HUht--9ypmJSz', '6c7f524bd8326ba2fef09f91608d7b7e', '/static/data/dress/41/6c7f524bd8326ba2fef09f91608d7b7e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('67', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', 'f430058d5a3f147a5b542f389163a7f4', '/static/data/dress/84/f430058d5a3f147a5b542f389163a7f4.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('68', 'FvkzCRZdOXbfpPC2W-fWrcPM3CmS', '9f855ee0e4b340e18769c1dc27db24a5', '/static/data/dress/18/9f855ee0e4b340e18769c1dc27db24a5.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('69', 'FpA98Sk2eiW9LmiTYzVo5bEOC_y2', '6e5056a327e954b4763de4d045cbd0c7', '/static/data/dress/59/6e5056a327e954b4763de4d045cbd0c7.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('70', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', 'b83e70222783102d1f07477111cf40d3', '/static/data/dress/18/b83e70222783102d1f07477111cf40d3.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('71', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', 'e7eb12a5c2d2b637558f4c49402d6b63', '/static/data/dress/70/e7eb12a5c2d2b637558f4c49402d6b63.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('72', 'FmWMFc5JdojHEAcSUE4ZWrc8eUF8', 'de602c056f78d80855adffb5fdd84696', '/static/data/dress/87/de602c056f78d80855adffb5fdd84696.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('73', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'a46bd2f445cf4e5263f0b045c38e8b4b', '/static/data/dress/37/a46bd2f445cf4e5263f0b045c38e8b4b.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('74', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '12d5217b32cf41b107426088c3d17986', '/static/data/dress/33/12d5217b32cf41b107426088c3d17986.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('75', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '6daf9ac1319af4f811135955bc7fb4cf', '/static/data/dress/79/6daf9ac1319af4f811135955bc7fb4cf.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('76', 'Fo0DQs_bz7QXYXgQGSC6lnJuQAnX', '502bd20bc6f0eeccba929b9f7a3ad96a', '/static/data/advertisement_position_img/502bd20bc6f0eeccba929b9f7a3ad96a.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('77', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '399c61cd570ebb2111a4ecf8fa03710a', '/static/data/dress/13/399c61cd570ebb2111a4ecf8fa03710a.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('78', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '7057b1597fcc78acf4cb8dfd1900a3ca', '/static/data/dress/59/7057b1597fcc78acf4cb8dfd1900a3ca.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('79', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '9dd80270d7df8fe2442d1d972aeca69b', '/static/data/dress/17/9dd80270d7df8fe2442d1d972aeca69b.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('80', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '1ef8782d41efe22def7b6e46afa13362', '/static/data/dress/90/1ef8782d41efe22def7b6e46afa13362.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('81', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'd46239aa1f49d5282eedd194a73e9593', '/static/data/dress/38/d46239aa1f49d5282eedd194a73e9593.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('82', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'cb2f612fc9ce6e325a5079f410b626af', '/static/data/dress/90/cb2f612fc9ce6e325a5079f410b626af.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('83', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '000d4f90ae4d85c58bd4f6796b4d5c6c', '/static/data/dress/57/000d4f90ae4d85c58bd4f6796b4d5c6c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('84', 'FuLjTfs8KTm8SSSB1dvUTS3ac3I-', '79f862607eed57b7ffb83364d9609432', '/static/data/advertisement_position_img/79f862607eed57b7ffb83364d9609432.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('85', 'FuLjTfs8KTm8SSSB1dvUTS3ac3I-', '23e60076cea456112d328adc2e2fce63', '/static/data/advertisement_position_img/23e60076cea456112d328adc2e2fce63.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('86', 'FifEuJvuVsFWddeqDSZaILtiaW1H', '0acdbfbe153b97bcdc472732784510bd', '/static/data/advertisement_position_img/0acdbfbe153b97bcdc472732784510bd.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('87', 'Fi4CaehW1_OzWu4riN3zkw38Wf_v', 'bd05ad88652fc12ac591db58e687b17c', '/static/data/dress/23/bd05ad88652fc12ac591db58e687b17c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('88', 'FgUlM03OJgr058yIpv307RLbQYge', '03cf4443600b766ab311b3643310f766', '/static/data/dress/30/03cf4443600b766ab311b3643310f766.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('89', 'FlXMwAVyD2UFkY-cfLCWSCTFJeMs', 'b78c2da430f0eae3ff844cb9cebe2660', '/static/data/dress/93/b78c2da430f0eae3ff844cb9cebe2660.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('90', 'FpfiauTFzgpVK-Sf4L3-6o1Mz4jU', 'c6b879342c27d896311fd572b41d4155', '/static/data/dress/90/c6b879342c27d896311fd572b41d4155.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('91', 'FpfiauTFzgpVK-Sf4L3-6o1Mz4jU', '8e10628bb1da39c87773617d304b22ea', '/static/data/dress/49/8e10628bb1da39c87773617d304b22ea.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('92', 'FlXMwAVyD2UFkY-cfLCWSCTFJeMs', '71381724b2c5e6580729b367bac4a7b3', '/static/data/dress/24/71381724b2c5e6580729b367bac4a7b3.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('93', 'Fi4CaehW1_OzWu4riN3zkw38Wf_v', '135d73b6e1da8d84b63af51ab1048f88', '/static/data/dress/68/135d73b6e1da8d84b63af51ab1048f88.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('94', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '0771c736ecf33814aa8002f16bb60331', '/static/data/dress/19/0771c736ecf33814aa8002f16bb60331.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('95', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'bc865ebdd9347a99b2085ef5446ad501', '/static/data/dress/92/bc865ebdd9347a99b2085ef5446ad501.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('96', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '8257ae69c5ce1e472ce1a2d8c0d37c3e', '/static/data/dress/78/8257ae69c5ce1e472ce1a2d8c0d37c3e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('97', 'Fi4CaehW1_OzWu4riN3zkw38Wf_v', 'e72c47099a52a0f44b7791f96ff2ea4c', '/static/data/dress/60/e72c47099a52a0f44b7791f96ff2ea4c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('98', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', 'e9727d8eb34221ab39960559de50a928', '/static/data/dress/39/e9727d8eb34221ab39960559de50a928.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('99', 'FifEuJvuVsFWddeqDSZaILtiaW1H', 'f326f3a4a2094ffff394e5ce0be5f2e6', '/static/data/dress/56/f326f3a4a2094ffff394e5ce0be5f2e6.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('100', 'FifEuJvuVsFWddeqDSZaILtiaW1H', 'c18de84a98a8137d5ee5efaa87369a69', '/static/data/dress/32/c18de84a98a8137d5ee5efaa87369a69.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('101', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', '8ff49d4543023c426240111bc419b448', '/static/data/dress/92/8ff49d4543023c426240111bc419b448.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('102', 'Fi4CaehW1_OzWu4riN3zkw38Wf_v', 'e79bf2ee5d98f2cee41e0e7254e3f74c', '/static/data/dress/10/e79bf2ee5d98f2cee41e0e7254e3f74c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('103', 'FifEuJvuVsFWddeqDSZaILtiaW1H', '1766095a3c693cbcd0e72aade2a3a70d', '/static/data/advertisement_position_img/1766095a3c693cbcd0e72aade2a3a70d.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('104', 'Fi4CaehW1_OzWu4riN3zkw38Wf_v', '40e63417389acdfdcb2d7280cd00b437', '/static/data/dress/99/40e63417389acdfdcb2d7280cd00b437.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('105', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', 'fd7f0f3584ca7ceaeae1641c28156487', '/static/data/dress/32/fd7f0f3584ca7ceaeae1641c28156487.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('106', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '1947ea9c56ea143d5122f3315f1be521', '/static/data/dress/13/1947ea9c56ea143d5122f3315f1be521.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('107', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '791562443d4c792c6193d4fc6ca79f2c', '/static/data/dress/63/791562443d4c792c6193d4fc6ca79f2c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('108', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', 'f9109819040269e65ab15227053b9383', '/static/data/dress/30/f9109819040269e65ab15227053b9383.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('109', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', '6a149f9a8638b4cecafa0efaed961444', '/static/data/dress/73/6a149f9a8638b4cecafa0efaed961444.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('110', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '0ca81ee06b12bf56280832c6ed587665', '/static/data/dress/76/0ca81ee06b12bf56280832c6ed587665.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('111', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '214d52161179889c2d986a67f1dac8ac', '/static/data/dress/57/214d52161179889c2d986a67f1dac8ac.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('112', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '7c6cde75c539b742cee10be253e68790', '/static/data/dress/97/7c6cde75c539b742cee10be253e68790.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('113', 'Frs94xVP96qX805-fDCF2hd-dpIr', '1ea19c0ef316ecf99db004c2f638bd7f', '/static/data/dress/91/1ea19c0ef316ecf99db004c2f638bd7f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('114', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '025c96ea57cde9db36cf09949e8458b1', '/static/data/dress/25/025c96ea57cde9db36cf09949e8458b1.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('115', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '06b38118ac4373814188e7b53187271f', '/static/data/dress/80/06b38118ac4373814188e7b53187271f.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('116', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '145f40b376fcb2adff4b8fb241cbb9f1', '/static/data/dress/94/145f40b376fcb2adff4b8fb241cbb9f1.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('117', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'c5f2a19269c9089799a2228471e262ab', '/static/data/dress/38/c5f2a19269c9089799a2228471e262ab.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('118', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', 'fabb73c2c974322ec7a29f40d2eb13b6', '/static/data/dress/72/fabb73c2c974322ec7a29f40d2eb13b6.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('119', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'ffc38b434ee56add80c5b0b3e96de544', '/static/data/dress/77/ffc38b434ee56add80c5b0b3e96de544.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('120', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '4104434a9bf84c6514da8443c18307ab', '/static/data/dress/68/4104434a9bf84c6514da8443c18307ab.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('121', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'a1bca823cc9e3624dfd8f48e613a5ada', '/static/data/dress/62/a1bca823cc9e3624dfd8f48e613a5ada.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('122', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '7e45aae149c18c2e3107ba4c9eae6b99', '/static/data/dress/87/7e45aae149c18c2e3107ba4c9eae6b99.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('123', 'FlsTIA4eZit1fBSS9pRKterixCaV', '17df4a630d361f70bac240ecf9826a0c', '/static/data/dress/66/17df4a630d361f70bac240ecf9826a0c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('124', 'FmQE43FIWt9I1L4mWocQF423Wenx', '8f77f9f445f15c159e60d818fb7f2f0c', '/static/data/advertisement_position_img/8f77f9f445f15c159e60d818fb7f2f0c.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('125', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', '92e0a5800fff0835d4362ca3920c1bec', '/static/data/advertisement_position_img/92e0a5800fff0835d4362ca3920c1bec.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('126', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', 'f61a101fb402cb0d0fee7ca90718deb1', '/static/data/advertisement_position_img/f61a101fb402cb0d0fee7ca90718deb1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('127', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', 'bffc88a76584389456b704736e9e0c73', '/static/data/advertisement_position_img/bffc88a76584389456b704736e9e0c73.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('128', 'Fg7CleZqMu6jdTvq7rwmgjoGwfcD', 'b3d28113d0a6cca1ca8a1d6782b10602', '/static/data/advertisement_position_img/b3d28113d0a6cca1ca8a1d6782b10602.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('129', 'FpvpjItmlSdrGn38cA-GojSSbVM0', 'a81c3a99c36b4c41875c25e46acd08e0', '/static/data/dress/54/a81c3a99c36b4c41875c25e46acd08e0.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('130', 'FiIGGLrccQwv8MWOfuJYmxcV-6m4', 'f1d55fc83582c6648cafa1475faae0d0', '/static/data/dress/76/f1d55fc83582c6648cafa1475faae0d0.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('131', 'FmQ8V9Mq8uQBibteQ7voaS8hfXwY', 'd3dc1e90fce50b2a42c6bff4d16c6768', '/static/data/dress/43/d3dc1e90fce50b2a42c6bff4d16c6768.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('132', 'FkXMhcIrdbltx8DE751kFS5PhT92', '2aed582532e3e82f9fcae9a3cc49eeae', '/static/data/dress/95/2aed582532e3e82f9fcae9a3cc49eeae.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('133', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '21b0e95e46133500c02c81d7d2119117', '/static/data/dress/86/21b0e95e46133500c02c81d7d2119117.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('134', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '774409884c780897c15e8deb990e899a', '/static/data/dress/94/774409884c780897c15e8deb990e899a.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('135', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '94fdca25f841d5210335f438bb072918', '/static/data/dress/96/94fdca25f841d5210335f438bb072918.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('136', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '0f1f28808aa6f43e8a0778597edceb89', '/static/data/dress/62/0f1f28808aa6f43e8a0778597edceb89.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('137', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'f200954aaa96894cd053156a46dceec4', '/static/data/dress/23/f200954aaa96894cd053156a46dceec4.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('138', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '116e1b0078cfebde4e44000196817aa6', '/static/data/dress/56/116e1b0078cfebde4e44000196817aa6.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('139', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '42c244a5819bab89c49e4e1a0d081fa8', '/static/data/dress/68/42c244a5819bab89c49e4e1a0d081fa8.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('140', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', '3efc33d3f025124ab127c4201cf85e38', '/static/data/dress/78/3efc33d3f025124ab127c4201cf85e38.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('141', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '4f99be248770ae3a1658e849b58dbe8b', '/static/data/dress/62/4f99be248770ae3a1658e849b58dbe8b.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('142', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'd17ca661fa6c50b5d08fad107a286e8c', '/static/data/dress/20/d17ca661fa6c50b5d08fad107a286e8c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('143', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '93d43af1d98a370f0b3c14460ca208f7', '/static/data/dress/56/93d43af1d98a370f0b3c14460ca208f7.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('144', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '9408bde67c6f0b9e13589bd5a493630c', '/static/data/dress/62/9408bde67c6f0b9e13589bd5a493630c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('145', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'd81edb5fd9d93d1b8b450c52d37ed1dd', '/static/data/dress/49/d81edb5fd9d93d1b8b450c52d37ed1dd.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('146', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '6a4c605d6c5f8436c0c1fe81a4b258dc', '/static/data/dress/92/6a4c605d6c5f8436c0c1fe81a4b258dc.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('147', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'afcb54b82d74ef69e19d6774acb5a067', '/static/data/dress/85/afcb54b82d74ef69e19d6774acb5a067.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('148', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '3e2135aaeb4ad70b0bf8896428467102', '/static/data/dress/59/3e2135aaeb4ad70b0bf8896428467102.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('149', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '1fa91b4a25683b45bc6b321fc8cf588a', '/static/data/dress/50/1fa91b4a25683b45bc6b321fc8cf588a.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('150', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '324e18a7b8821ae51412f2b7dfd2d937', '/static/data/dress/88/324e18a7b8821ae51412f2b7dfd2d937.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('151', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'b3a6af045e2087b6e33abfc32e0647f3', '/static/data/dress/96/b3a6af045e2087b6e33abfc32e0647f3.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('152', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'bce7f3cbacd260dc40e9d29d214d64cf', '/static/data/dress/39/bce7f3cbacd260dc40e9d29d214d64cf.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('153', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '28eef3ccf582bb1587df03426d8c1c1b', '/static/data/dress/12/28eef3ccf582bb1587df03426d8c1c1b.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('154', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'a08a8578395fd155d503b2e73aff8f44', '/static/data/dress/26/a08a8578395fd155d503b2e73aff8f44.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('155', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '5daf02417677b2bdfa96296ec06393f2', '/static/data/dress/59/5daf02417677b2bdfa96296ec06393f2.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('156', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'aa5005c77d5f158165dea4c525006edb', '/static/data/dress/68/aa5005c77d5f158165dea4c525006edb.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('157', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', '2ad3b04c29b80273bd4e8d9ce13b046d', '/static/data/dress/24/2ad3b04c29b80273bd4e8d9ce13b046d.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('158', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '0bbd411931b75f6ef8665414a6d5146e', '/static/data/dress/53/0bbd411931b75f6ef8665414a6d5146e.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('159', 'FqT4J_q2zZnC1mlnjWksTxDzOYVE', '3d5cb104c01ab01bd80ec3596cfe3b58', '/static/data/dress/51/3d5cb104c01ab01bd80ec3596cfe3b58.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('160', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '5582dcce2f37fbd22744fd6f85fa0909', '/static/data/dress/54/5582dcce2f37fbd22744fd6f85fa0909.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('161', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'b7bd8f840e6fd9cf959cc1880be2410a', '/static/data/dress/55/b7bd8f840e6fd9cf959cc1880be2410a.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('162', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '274f6946a10949777d8912489c9aae40', '/static/data/dress/62/274f6946a10949777d8912489c9aae40.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('163', 'FjQGcMS0xfseWaaGIQGMMiHEDKj7', '3b8b307093dbe9c846fd103e66f1e135', '/static/data/dress/86/3b8b307093dbe9c846fd103e66f1e135.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('164', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', '369e37978fbb649224b90dba70b722b0', '/static/data/dress/64/369e37978fbb649224b90dba70b722b0.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('165', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '1e4aa98813e7cc4423b9ac2661cd08e3', '/static/data/dress/43/1e4aa98813e7cc4423b9ac2661cd08e3.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('166', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '0d7ceab1027e10557bf9787c579b6ab9', '/static/data/dress/15/0d7ceab1027e10557bf9787c579b6ab9.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('167', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', 'ccd6f1cfdc97f158c574f2ad22880f96', '/static/data/dress/46/ccd6f1cfdc97f158c574f2ad22880f96.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('168', 'Fvm115fGj39FcaMZ7Wq5U1GaMMUk', '221c9054690a87d3899541d6940a648f', '/static/data/dress/34/221c9054690a87d3899541d6940a648f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('169', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', 'ce1eb7f4624b92045e5a046377a5bb6b', '/static/data/dress/67/ce1eb7f4624b92045e5a046377a5bb6b.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('170', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '18d3a88dd937c3f0530fbeb53e8ee70c', '/static/data/dress/54/18d3a88dd937c3f0530fbeb53e8ee70c.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('171', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'd82828449792d065ee8df8ef170fd185', '/static/data/dress/26/d82828449792d065ee8df8ef170fd185.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('172', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', 'd26f22c80c6e6716921cac6e2d89436c', '/static/data/dress/69/d26f22c80c6e6716921cac6e2d89436c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('173', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', 'fa72daaf3e48d155a4e72bc6ee65330b', '/static/data/dress/28/fa72daaf3e48d155a4e72bc6ee65330b.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('174', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', '72dde024f130736a64474077682170aa', '/static/data/dress/85/72dde024f130736a64474077682170aa.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('175', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '02db6e3329b34e3663b04af54d2f46d0', '/static/data/dress/73/02db6e3329b34e3663b04af54d2f46d0.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('176', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'c78e304233921863e3e2c8931c4b2db7', '/static/data/dress/13/c78e304233921863e3e2c8931c4b2db7.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('177', 'Fnww4vxqNM088izN8TIF4LJLCybz', '6b99189bb34824ba0b1e9d270911a280', '/static/data/dress/35/6b99189bb34824ba0b1e9d270911a280.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('178', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', '8388f18bffee561cf1375e56c0df6b97', '/static/data/dress/28/8388f18bffee561cf1375e56c0df6b97.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('179', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '574bcbb4deae8ccc2475671e1df6dc4f', '/static/data/dress/77/574bcbb4deae8ccc2475671e1df6dc4f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('180', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', 'e1d159e7add9ab4b0ace997d09c5a81e', '/static/data/dress/62/e1d159e7add9ab4b0ace997d09c5a81e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('181', 'Fvm115fGj39FcaMZ7Wq5U1GaMMUk', '178f74ed96376542dedc902fecede9ce', '/static/data/dress/17/178f74ed96376542dedc902fecede9ce.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('182', 'FvkzCRZdOXbfpPC2W-fWrcPM3CmS', '1d4b9fdebf2d41df3c37a0bcb8a8c0a6', '/static/data/dress/18/1d4b9fdebf2d41df3c37a0bcb8a8c0a6.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('183', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', '26a34291f82768baa6d4724b56ca2975', '/static/data/dress/23/26a34291f82768baa6d4724b56ca2975.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('184', 'Fvm115fGj39FcaMZ7Wq5U1GaMMUk', 'ef25470d0bb294cd6cb9665153ca956f', '/static/data/dress/28/ef25470d0bb294cd6cb9665153ca956f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('185', 'FvkzCRZdOXbfpPC2W-fWrcPM3CmS', 'a9ffe4c8d42ee843062533ad97fa6d76', '/static/data/dress/78/a9ffe4c8d42ee843062533ad97fa6d76.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('186', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', '0afb7bf492ad811f539bc142a2c310e6', '/static/data/dress/61/0afb7bf492ad811f539bc142a2c310e6.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('187', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', 'bbf966b70ab769ac2525e44e9fdc66c3', '/static/data/dress/70/bbf966b70ab769ac2525e44e9fdc66c3.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('188', 'FnZgCd6SOCHe7K11ByLToLXpO0BI', '9da32d7b474c48a415bd637d5bd0eeb5', '/static/data/dress/18/9da32d7b474c48a415bd637d5bd0eeb5.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('189', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', '205091de664220dc3813fb41c483c7de', '/static/data/dress/15/205091de664220dc3813fb41c483c7de.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('190', 'FszZPOXS5ET2tAGdZ4l_vT_F9kwc', 'fd706773096b730ca53a2f51d862a6fc', '/static/data/dress/92/fd706773096b730ca53a2f51d862a6fc.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('191', 'FnZgCd6SOCHe7K11ByLToLXpO0BI', '2ab1a38b2db6420105ba66f9fd449576', '/static/data/dress/27/2ab1a38b2db6420105ba66f9fd449576.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('192', 'FpFI3ffeqcpjDpd3x_6Z3SSHlXAn', 'a89b61562119d4297e2121156faba8c1', '/static/data/dress/32/a89b61562119d4297e2121156faba8c1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('193', 'FnZgCd6SOCHe7K11ByLToLXpO0BI', '0d2ff0adb1282085ac23fe8afaf556b8', '/static/data/dress/85/0d2ff0adb1282085ac23fe8afaf556b8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('194', 'FnZgCd6SOCHe7K11ByLToLXpO0BI', 'd64ad7cd57ce8edb2834d2655fb342ba', '/static/data/dress/85/d64ad7cd57ce8edb2834d2655fb342ba.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('195', 'FnZgCd6SOCHe7K11ByLToLXpO0BI', '6f2e70963b076d344a118c861301dd14', '/static/data/dress/55/6f2e70963b076d344a118c861301dd14.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('196', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '34ed9e332da5b917ad27af492b66af5d', '/static/data/dress/25/34ed9e332da5b917ad27af492b66af5d.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('197', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '1d7eb877371b646b3fba7f7c095b4dd9', '/static/data/dress/23/1d7eb877371b646b3fba7f7c095b4dd9.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('198', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '5f9ed689280ac01685cc1f27a5a60389', '/static/data/dress/51/5f9ed689280ac01685cc1f27a5a60389.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('199', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'c0e071c58966705edb1d16c146f46e4f', '/static/data/dress/75/c0e071c58966705edb1d16c146f46e4f.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('200', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'dcbc5728a35ed952a18d0c997a0964a1', '/static/data/dress/63/dcbc5728a35ed952a18d0c997a0964a1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('201', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'b61d9127dc274a19f5b69f19831eb609', '/static/data/advertisement_position_img/b61d9127dc274a19f5b69f19831eb609.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('202', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '153dc73ce8fa85b588e3358cce6df4da', '/static/data/advertisement_position_img/153dc73ce8fa85b588e3358cce6df4da.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('203', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'a49521ece34376ef3cebc190f16e19fb', '/static/data/dress/25/a49521ece34376ef3cebc190f16e19fb.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('204', 'FnZgRguez-irYHAAzVcgCnUgugFm', '81e99bbec4b6331ca34615ed41390054', '/static/data/dress/88/81e99bbec4b6331ca34615ed41390054.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('205', 'FvLWHhqaOh8opH7HUht--9ypmJSz', 'b0c4342a3105248afb439d354dd44f9e', '/static/data/dress/83/b0c4342a3105248afb439d354dd44f9e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('206', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', '36b40c7f3a7d73416f10caac1016c74b', '/static/data/dress/83/36b40c7f3a7d73416f10caac1016c74b.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('207', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', '6f1fe5baf9eb4f0f1f3ea296e2eccc23', '/static/data/dress/74/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('208', 'FmWMFc5JdojHEAcSUE4ZWrc8eUF8', '267f488379812966df56196b44ab457f', '/static/data/dress/64/267f488379812966df56196b44ab457f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('209', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '0a840df19dfa69ca30eb9c946195a510', '/static/data/dress/55/0a840df19dfa69ca30eb9c946195a510.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('210', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '650b7118ae39a571e35040e2b6277632', '/static/data/dress/88/650b7118ae39a571e35040e2b6277632.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('211', 'Fggs3T0BRs3me-qxgu-HBWmYUO6Q', '3c5f6089d0a106d431378bc3bae2c2b9', '/static/data/dress/67/3c5f6089d0a106d431378bc3bae2c2b9.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('212', 'FnZgRguez-irYHAAzVcgCnUgugFm', '19a5b916f03d955f87729653de777c74', '/static/data/advertisement_position_img/19a5b916f03d955f87729653de777c74.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('213', 'Frd2IFJe51BYaKYMp2WNWtC6FjQt', '17861c44cb251c44667a6afbf82169c7', '/static/data/advertisement_position_img/17861c44cb251c44667a6afbf82169c7.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('214', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '7871a1ef11cd0619add93a0176622e70', '/static/data/dress/37/7871a1ef11cd0619add93a0176622e70.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('215', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', 'bc31bbf94c3d4aefbb684f77e5586efd', '/static/data/dress/17/bc31bbf94c3d4aefbb684f77e5586efd.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('216', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'aafd64e1a394ea12172b62314db85a49', '/static/data/dress/86/aafd64e1a394ea12172b62314db85a49.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('217', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '87bccd0a49e2ee174f6a1cafa87dddf1', '/static/data/dress/33/87bccd0a49e2ee174f6a1cafa87dddf1.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('218', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'ece7550a5210f6365f80ac70b89c5473', '/static/data/dress/41/ece7550a5210f6365f80ac70b89c5473.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('219', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '0fe2223c0ac8485d0d1260929f63a76c', '/static/data/dress/17/0fe2223c0ac8485d0d1260929f63a76c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('220', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', '3c15a1aa096939a6a3f27260bc413d9c', '/static/data/dress/26/3c15a1aa096939a6a3f27260bc413d9c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('221', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', '1407ba68d797cb63b43f575180114aef', '/static/data/dress/67/1407ba68d797cb63b43f575180114aef.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('222', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'd986567af45257fef9906ab2f758fda6', '/static/data/dress/21/d986567af45257fef9906ab2f758fda6.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('223', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '9c97c0979baebcc91280a121ea4532f3', '/static/data/dress/25/9c97c0979baebcc91280a121ea4532f3.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('224', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', '16182d5f60031a601864ad90dd7e8663', '/static/data/dress/37/16182d5f60031a601864ad90dd7e8663.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('225', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', 'e2a566f118cc631e9ffb16368407f496', '/static/data/dress/30/e2a566f118cc631e9ffb16368407f496.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('226', 'Fnww4vxqNM088izN8TIF4LJLCybz', '67ef1ca1c711d0d0c33aad3b84b52802', '/static/data/dress/24/67ef1ca1c711d0d0c33aad3b84b52802.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('227', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '7ad50961b75dc52e43f5504612379865', '/static/data/dress/17/7ad50961b75dc52e43f5504612379865.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('228', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'b61d7ac9f09cb45eec7690dd4db29c58', '/static/data/dress/32/b61d7ac9f09cb45eec7690dd4db29c58.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('229', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', '192f2001421119d32ef3e0bf83b49858', '/static/data/dress/42/192f2001421119d32ef3e0bf83b49858.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('230', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '4d4aefb3147d5b6e338d9446605b7218', '/static/data/dress/15/4d4aefb3147d5b6e338d9446605b7218.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('231', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', 'cc80ba547e907f3f74b2b7972c035466', '/static/data/dress/35/cc80ba547e907f3f74b2b7972c035466.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('232', 'Fiq4pZoc_TcfWBLgMfKly9VGQkQA', '5bcb070674ba730cd8055fb35b64f997', '/static/data/dress/96/5bcb070674ba730cd8055fb35b64f997.gif');
INSERT INTO `qiniu_pic_key_map` VALUES ('233', 'Fnww4vxqNM088izN8TIF4LJLCybz', '795159557e19f3acc9bc1c10cf4e3275', '/static/data/dress/45/795159557e19f3acc9bc1c10cf4e3275.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('234', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', 'f40a310f7deb29c49deb2c05903a3b27', '/static/data/dress/94/f40a310f7deb29c49deb2c05903a3b27.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('235', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', 'e819cf2b6cf1f80625536ad6e704b9de', '/static/data/dress/84/e819cf2b6cf1f80625536ad6e704b9de.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('236', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', 'e5f7b7e046b8429100ba4feda94a5e76', '/static/data/dress/73/e5f7b7e046b8429100ba4feda94a5e76.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('237', 'FjrjCnxSErDRN0J8VP_4ujWCqdx4', 'b847464fa4fbaed14653daa602717b85', '/static/data/dress/14/b847464fa4fbaed14653daa602717b85.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('238', 'Fo_Mq614bwWeobPji-YI-nHyak5j', '0d46ef91e611172e224456745e27f9f5', '/static/data/dress/65/0d46ef91e611172e224456745e27f9f5.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('239', 'Fnww4vxqNM088izN8TIF4LJLCybz', '5203e4feeb37a9464e4e486e6143ca3a', '/static/data/dress/39/5203e4feeb37a9464e4e486e6143ca3a.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('240', 'Fo_Mq614bwWeobPji-YI-nHyak5j', '0ea77e1ef4b53ca4f2e39b52093903b7', '/static/data/dress/20/0ea77e1ef4b53ca4f2e39b52093903b7.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('241', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'e26aa197b213579be2f62f2655ce6a58', '/static/data/dress/86/e26aa197b213579be2f62f2655ce6a58.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('242', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'e03f601f54cf37318824630b31efdf59', '/static/data/dress/48/e03f601f54cf37318824630b31efdf59.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('243', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '8ae67464194240b59703c81588f1e6e7', '/static/data/dress/19/8ae67464194240b59703c81588f1e6e7.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('244', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'f815394643cb780f274b3bd6c5090375', '/static/data/dress/32/f815394643cb780f274b3bd6c5090375.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('245', 'FukX3TpaF1ty2C5bbjtqPy2hbNh3', '0cffb8b5d62a18f8525754bbe5928c88', '/static/data/advertisement_position_img/0cffb8b5d62a18f8525754bbe5928c88.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('246', 'FnZgRguez-irYHAAzVcgCnUgugFm', 'd58c9b69d5e04f7c0cebc833ddd86663', '/static/data/advertisement_position_img/d58c9b69d5e04f7c0cebc833ddd86663.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('247', 'FvJOQRdq55jRwl1K4IXyBS9L_PW-', 'a90722caf91d61936f06d014b1502d94', '/static/data/advertisement_position_img/a90722caf91d61936f06d014b1502d94.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('248', 'FnZgRguez-irYHAAzVcgCnUgugFm', '25070aecdf158f15bebefffadb9bdac8', '/static/data/advertisement_position_img/25070aecdf158f15bebefffadb9bdac8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('249', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', '289c6fe77ebd8822f40b879d9e029bf2', '/static/data/dress/65/289c6fe77ebd8822f40b879d9e029bf2.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('250', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', 'ef05f1d2cfae00676576e71c95bc8c3f', '/static/data/dress/77/ef05f1d2cfae00676576e71c95bc8c3f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('251', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', '6c4d63b69de90e9af41f1b60d0e766cc', '/static/data/dress/79/6c4d63b69de90e9af41f1b60d0e766cc.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('252', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '8018676e4848e7919b981d12a387bafd', '/static/data/dress/39/8018676e4848e7919b981d12a387bafd.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('253', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', '799a7bca269e616e9e9a43b0287b060c', '/static/data/dress/61/799a7bca269e616e9e9a43b0287b060c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('254', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', 'e2815efe4c917b335cc16a6f2e653c4c', '/static/data/dress/11/e2815efe4c917b335cc16a6f2e653c4c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('255', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', 'd1dad33fc0085ab593130c2ffb98080f', '/static/data/advertisement_position_img/d1dad33fc0085ab593130c2ffb98080f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('256', 'Fnww4vxqNM088izN8TIF4LJLCybz', '9d7f63a9b0efe3601352a04fda7e882a', '/static/data/dress/20/9d7f63a9b0efe3601352a04fda7e882a.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('257', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', 'c0a5764606e70121d3f3c56698084dbf', '/static/data/dress/21/c0a5764606e70121d3f3c56698084dbf.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('258', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', '8bbbbdc273966a54149f94c92f840d73', '/static/data/dress/67/8bbbbdc273966a54149f94c92f840d73.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('259', 'Fnww4vxqNM088izN8TIF4LJLCybz', '86a08265d41e657f2e7b5938fb390991', '/static/data/dress/44/86a08265d41e657f2e7b5938fb390991.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('260', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'c835ddd17c82e8fe202d8e8e31772362', '/static/data/dress/43/c835ddd17c82e8fe202d8e8e31772362.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('261', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'a15375836ecd8029e38bb526dd6f86db', '/static/data/dress/95/a15375836ecd8029e38bb526dd6f86db.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('262', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '566d2a2eb74e2b95222ca997c7e0a833', '/static/data/dress/41/566d2a2eb74e2b95222ca997c7e0a833.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('263', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '999602dcba5a9db2fb979c068507aea4', '/static/data/advertisement_position_img/999602dcba5a9db2fb979c068507aea4.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('264', 'Fnww4vxqNM088izN8TIF4LJLCybz', 'b09cd707caf60d9ff2c836e87acda631', '/static/data/dress/33/b09cd707caf60d9ff2c836e87acda631.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('265', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', 'd3069f0734d5947937e098c526a9a9dc', '/static/data/dress/91/d3069f0734d5947937e098c526a9a9dc.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('266', 'FkBSrit4Gc_iWjpwh4xC3uQkPuSP', '76e80c92f28ea710c7543fcb7f27b93e', '/static/data/dress/35/76e80c92f28ea710c7543fcb7f27b93e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('267', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '490b51ef1da0feb9b4f30ddd42ff7627', '/static/data/dress/23/490b51ef1da0feb9b4f30ddd42ff7627.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('268', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '383e5e1061e0fe58b8d3d69cfdc9d24c', '/static/data/dress/35/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('269', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '5fb5f6541c9a69d06485b61a064b2413', '/static/data/dress/13/5fb5f6541c9a69d06485b61a064b2413.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('270', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '735e8e0574fb7155c99b4fdcd5391f1c', '/static/data/dress/80/735e8e0574fb7155c99b4fdcd5391f1c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('271', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', 'd51c7439e0090253e5209fe1378b9e42', '/static/data/advertisement_position_img/d51c7439e0090253e5209fe1378b9e42.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('272', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '4c2e4330caef3e41e131937f5f47e7a9', '/static/data/dress/65/4c2e4330caef3e41e131937f5f47e7a9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('273', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'b916f6ca4f9647a92efd00a9552b5a24', '/static/data/dress/43/b916f6ca4f9647a92efd00a9552b5a24.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('274', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'e8da04c2a4fd5870e96b9d7409f2ec0b', '/static/data/dress/32/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('275', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '55585735bd64de0d20187a779a3bdde8', '/static/data/dress/88/55585735bd64de0d20187a779a3bdde8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('276', 'FmWW5YKqJbqYxmCXpXzh5mbpyVRu', '28265f39beec061f3a384ddd2b8d8712', '/static/data/advertisement_position_img/28265f39beec061f3a384ddd2b8d8712.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('277', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '7380b1e6a83e0f46c3c26db9d504fcf9', '/static/data/dress/71/7380b1e6a83e0f46c3c26db9d504fcf9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('278', 'FvODK5J7_KH-h9MTDfoPEHAX3zBw', '11083b65e2359c80dd141ac7d757588c', '/static/data/dress/68/11083b65e2359c80dd141ac7d757588c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('279', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '388cb762fdd2314c498316f99798e5a8', '/static/data/dress/91/388cb762fdd2314c498316f99798e5a8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('280', 'FjowCvIHoB-SxGQkqeLkJMz8fKRo', '52df3f50b1b5e647b512978db02bf3af', '/static/data/advertisement_position_img/52df3f50b1b5e647b512978db02bf3af.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('281', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '89ade6cf822826cf6bb3cd3342c7af00', '/static/data/advertisement_position_img/89ade6cf822826cf6bb3cd3342c7af00.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('282', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', 'b17086083c2a566fdb456cb839b43412', '/static/data/advertisement_position_img/b17086083c2a566fdb456cb839b43412.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('283', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '38005ddba6e614bc5efb930ff0adab13', '/static/data/advertisement_position_img/38005ddba6e614bc5efb930ff0adab13.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('284', 'FlkG8J-ECCPnFMJ0Cb9QcIOHXgSl', '770b4ecdd5ec120b07c1351477c8077c', '/static/data/advertisement_position_img/770b4ecdd5ec120b07c1351477c8077c.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('285', 'FtVSJrgSxFgDKvG3T-oYTpkiGlOh', '5e1cb8b3fb04fc6439503305f6e5f672', '/static/data/advertisement_position_img/5e1cb8b3fb04fc6439503305f6e5f672.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('286', 'Fp35z5TtN_m0ysTrdB06NZzJ-QeL', '3ce39f88737136385195c7b53adc6781', '/static/data/advertisement_position_img/3ce39f88737136385195c7b53adc6781.jpeg');
INSERT INTO `qiniu_pic_key_map` VALUES ('287', 'FifEuJvuVsFWddeqDSZaILtiaW1H', 'efdf243b33a53c42d977f99f02030be9', '/static/data/advertisement_position_img/efdf243b33a53c42d977f99f02030be9.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('288', 'FuLjTfs8KTm8SSSB1dvUTS3ac3I-', '8db9a1ebc43a55a1625ee00a1c36bef3', '/static/data/advertisement_position_img/8db9a1ebc43a55a1625ee00a1c36bef3.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('289', 'FovolRI77St5cPb8tcq_6lwShEvl', 'c5dd13e6972f9b4fa278b292c56f6614', '/static/data/advertisement_position_img/c5dd13e6972f9b4fa278b292c56f6614.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('290', 'FltsOdepftuMlCF6Bhuxo_0InCOH', 'fd4df4b02bf255ab52970cd5991b28f4', '/static/data/advertisement_position_img/fd4df4b02bf255ab52970cd5991b28f4.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('291', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '2e844f1931e22a470b64974cd732e538', '/static/data/dress/15/2e844f1931e22a470b64974cd732e538.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('292', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '91d1777a7e1d7c027d936827c7354660', '/static/data/advertisement_position_img/91d1777a7e1d7c027d936827c7354660.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('293', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', '91430dd23095b209b5152a1a44b6cbe1', '/static/data/dress/47/91430dd23095b209b5152a1a44b6cbe1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('294', 'FgICrSO9wHMODAdAVSXCu7f3vn2N', 'ba6a8a73e8bb8e0413d60309ed21cf40', '/static/data/dress/99/ba6a8a73e8bb8e0413d60309ed21cf40.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('295', 'FkmxCRXTfSxCS_BQ0cSTCIi1vkHz', '9f1e71db29ae94bd065f21b14b681440', '/static/data/dress/90/9f1e71db29ae94bd065f21b14b681440.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('296', 'Fp7G1oeFkGxzESzhPjY1-C4IOTBi', '59100fde2a32f483f1165a1342e99c1e', '/static/data/dress/50/59100fde2a32f483f1165a1342e99c1e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('297', 'FsP_lkPRGyLMp59bqcIH-2h_y-je', '3e9c03647b742a4eac3abe6777084945', '/static/data/dress/99/3e9c03647b742a4eac3abe6777084945.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('298', 'Fp7G1oeFkGxzESzhPjY1-C4IOTBi', 'bd34750d88c3f236a4de22930e2ee062', '/static/data/dress/52/bd34750d88c3f236a4de22930e2ee062.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('299', 'Fp7G1oeFkGxzESzhPjY1-C4IOTBi', 'b7f63b717abefe86777c8f91018efd07', '/static/data/dress/74/b7f63b717abefe86777c8f91018efd07.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('300', 'Fp7G1oeFkGxzESzhPjY1-C4IOTBi', 'f100e9a4c37b0e7e04b014a40637c606', '/static/data/dress/52/f100e9a4c37b0e7e04b014a40637c606.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('301', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'a033f0ce5abff860a6f1b291d358338f', '/static/data/dress/93/a033f0ce5abff860a6f1b291d358338f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('302', 'Fp7G1oeFkGxzESzhPjY1-C4IOTBi', 'f451dbc14d5607c2c1a5b544c4a15ea0', '/static/data/dress/28/f451dbc14d5607c2c1a5b544c4a15ea0.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('303', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '6e480137d95102d85f3fb75caa0303a5', '/static/data/dress/20/6e480137d95102d85f3fb75caa0303a5.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('304', 'FiTXgsxyx7luEtEhCONJrWaINOtH', 'c8146de163e44a861bb4a662ab1d5b27', '/static/data/dress/88/c8146de163e44a861bb4a662ab1d5b27.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('305', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'd497e23916e75a8d589960b7b1a844c7', '/static/data/dress/53/d497e23916e75a8d589960b7b1a844c7.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('306', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '2cdeab29829ae953d5b678925cd13dec', '/static/data/dress/72/2cdeab29829ae953d5b678925cd13dec.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('307', 'FiTXgsxyx7luEtEhCONJrWaINOtH', 'c1e0fafdf086f80d4b121ddcd596b37f', '/static/data/dress/39/c1e0fafdf086f80d4b121ddcd596b37f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('308', 'FiTXgsxyx7luEtEhCONJrWaINOtH', 'a6abbbd2f44bb875f6b7760afecef6d7', '/static/data/dress/90/a6abbbd2f44bb875f6b7760afecef6d7.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('309', 'FiTXgsxyx7luEtEhCONJrWaINOtH', '097982bd0dd6e9ecfcb9d393f443b317', '/static/data/dress/69/097982bd0dd6e9ecfcb9d393f443b317.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('310', 'FiTXgsxyx7luEtEhCONJrWaINOtH', '984655ea76df25c08cfa7af3e7898aba', '/static/data/dress/62/984655ea76df25c08cfa7af3e7898aba.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('311', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'af6e79845d1deb220c04ccecc1cc109b', '/static/data/dress/12/af6e79845d1deb220c04ccecc1cc109b.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('312', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'eee0a9f2715762ca678c4684b0026635', '/static/data/dress/12/eee0a9f2715762ca678c4684b0026635.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('313', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '3ea5ad3ce3d11715e40d944db7ecb152', '/static/data/dress/97/3ea5ad3ce3d11715e40d944db7ecb152.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('314', 'FiTXgsxyx7luEtEhCONJrWaINOtH', 'ca8ebb08b845354d0b89811e49a750fd', '/static/data/dress/49/ca8ebb08b845354d0b89811e49a750fd.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('315', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'acc5a097c4590436489fb7ff13e72fee', '/static/data/dress/34/acc5a097c4590436489fb7ff13e72fee.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('316', 'FiTXgsxyx7luEtEhCONJrWaINOtH', 'b300f932f16aac2674771b8eaeed253e', '/static/data/dress/72/b300f932f16aac2674771b8eaeed253e.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('317', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '1260eab1f98580aaaeeba41ea3dae14b', '/static/data/dress/16/1260eab1f98580aaaeeba41ea3dae14b.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('318', 'FiTXgsxyx7luEtEhCONJrWaINOtH', '887133a4ffdba9fec3528dbd75f1ae58', '/static/data/dress/72/887133a4ffdba9fec3528dbd75f1ae58.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('319', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', 'e10d09fe0f3948bcc83db1ba8e5da77e', '/static/data/dress/71/e10d09fe0f3948bcc83db1ba8e5da77e.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('320', 'FiTXgsxyx7luEtEhCONJrWaINOtH', '9cce75da41e8b9899acb000bf4703703', '/static/data/dress/42/9cce75da41e8b9899acb000bf4703703.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('321', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '3847af6504d583da154d58645773c24d', '/static/data/dress/73/3847af6504d583da154d58645773c24d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('322', 'FiTXgsxyx7luEtEhCONJrWaINOtH', '906fda996c5baa08f344075c06c079e2', '/static/data/dress/53/906fda996c5baa08f344075c06c079e2.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('323', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '27cd8fc9b645f8390063ff3499af1ea3', '/static/data/dress/20/27cd8fc9b645f8390063ff3499af1ea3.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('324', 'Fs2-XiD5z0eRi6YeXj8zh_YkrBs0', '97400a54d53310df51c711773f5ad82d', '/static/data/dress/18/97400a54d53310df51c711773f5ad82d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('325', 'FgBcPRrCOswTlWo-5aRe5s8LiUbk', '0ce3d99d7acd88b36c5edb64b4ae2b1e', '/static/data/dress/74/0ce3d99d7acd88b36c5edb64b4ae2b1e.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('326', 'FsP_lkPRGyLMp59bqcIH-2h_y-je', '62dd4894e535475667cb871a1bdbf127', '/static/data/dress/83/62dd4894e535475667cb871a1bdbf127.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('327', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '05dd378f410cb9e4611bd13469239381', '/static/data/dress/13/05dd378f410cb9e4611bd13469239381.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('328', 'FtbOj2VVcNMGwZLWtRMrZPUvvSea', 'b1228afa471ecde060e974b9873390ad', '/static/data/dress/22/b1228afa471ecde060e974b9873390ad.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('329', 'FmCCMR5qsPHvbW39XR_3ehUJMQKa', '37aceb4e84bc67e93b8777ad341700ff', '/static/data/dress/47/37aceb4e84bc67e93b8777ad341700ff.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('330', 'FoOQqe6HH_xFPMsugxvcCiZZRljG', '14dbfb522f4da85d26d455ee54cba60f', '/static/data/dress/31/14dbfb522f4da85d26d455ee54cba60f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('331', 'FoOQqe6HH_xFPMsugxvcCiZZRljG', 'cbe547afce9d61de75a2d2ce5cc3372c', '/static/data/dress/57/cbe547afce9d61de75a2d2ce5cc3372c.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('332', 'FsL3mpdR1yTaEG_2qe2u5dek4X3v', '2127a0dafa189bf566f2b9b577d25c8a', '/static/data/dress/51/2127a0dafa189bf566f2b9b577d25c8a.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('333', 'FsL3mpdR1yTaEG_2qe2u5dek4X3v', '3809dd30ceeb0e814deb6640cff9188d', '/static/data/dress/21/3809dd30ceeb0e814deb6640cff9188d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('334', 'FmLnG9WUEqilq25jYgvOpzTz9IXb', '3c6fd4e67f7fe4b02fbcbabfb74fee64', '/static/data/dress/72/3c6fd4e67f7fe4b02fbcbabfb74fee64.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('335', 'FmLnG9WUEqilq25jYgvOpzTz9IXb', '02d65e3daac84a3872773f73c9462135', '/static/data/dress/93/02d65e3daac84a3872773f73c9462135.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('336', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', '1c41eb166d0a98ca5afc4d86c73638c0', '/static/data/dress/19/1c41eb166d0a98ca5afc4d86c73638c0.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('337', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', '259b0900c76878f1eefd2667d00e384d', '/static/data/dress/23/259b0900c76878f1eefd2667d00e384d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('338', 'Fm_oRpsGUKVnqF-qk0Ct-noSphWS', '63f9ba374757979b0ec6efcba88a1fbc', '/static/data/dress/10/63f9ba374757979b0ec6efcba88a1fbc.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('339', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', '80c0ca8bb7c09371a0ff69011d503f6e', '/static/data/dress/23/80c0ca8bb7c09371a0ff69011d503f6e.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('340', 'FpHHXzJwtglUNJ9QpYF5puuRuWlQ', 'fb11716d271560687c1f0531487fdd7f', '/static/data/dress/35/fb11716d271560687c1f0531487fdd7f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('341', 'FpHHXzJwtglUNJ9QpYF5puuRuWlQ', '968a1162a13976b22932b88049a78421', '/static/data/dress/24/968a1162a13976b22932b88049a78421.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('342', 'FocsZhW7Av-VrpGym95d5vCkn6n_', 'f7bf2d0f8d36cdae6141ca0225bb97c5', '/static/data/dress/58/f7bf2d0f8d36cdae6141ca0225bb97c5.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('343', 'FocsZhW7Av-VrpGym95d5vCkn6n_', 'fcd443e60a28a6f3b37ba02a3cf5f3ca', '/static/data/dress/34/fcd443e60a28a6f3b37ba02a3cf5f3ca.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('344', 'FlcryJEWRTd12esh8phpsunsHno5', '27745f99d37633727a54ae5842fa59dc', '/static/data/dress/40/27745f99d37633727a54ae5842fa59dc.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('345', 'FlcryJEWRTd12esh8phpsunsHno5', 'e794c76755a1765446931a520fb5914d', '/static/data/dress/47/e794c76755a1765446931a520fb5914d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('346', 'FvzKHGT3V3XS9CKmZo1RhuLw6aoc', '98afaf6ae791e153f7a5d9e59cf64935', '/static/data/dress/58/98afaf6ae791e153f7a5d9e59cf64935.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('347', 'FvzKHGT3V3XS9CKmZo1RhuLw6aoc', 'c2c7976c676eee958f6664fb7557ba38', '/static/data/dress/26/c2c7976c676eee958f6664fb7557ba38.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('348', 'FosfYuk-QAAvHoGFAfMtbnGktUkV', 'e8108555fcb48ca1ff060aef0983bd0d', '/static/data/dress/65/e8108555fcb48ca1ff060aef0983bd0d.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('349', 'FosfYuk-QAAvHoGFAfMtbnGktUkV', 'c76ce310e3d97be7f3685fa87534e940', '/static/data/dress/27/c76ce310e3d97be7f3685fa87534e940.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('350', 'FqhJOfNiitp2yAqe7nhy65OQS7s7', '1019f4384d3763f906f383c5ac4828e8', '/static/data/dress/58/1019f4384d3763f906f383c5ac4828e8.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('351', 'FhTiVQF8JFWDd-N1wJ0-gapNagzM', '8ec2f42685373e5710e602e6e0327f5f', '/static/data/dress/49/8ec2f42685373e5710e602e6e0327f5f.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('352', 'FhTiVQF8JFWDd-N1wJ0-gapNagzM', '1b4dfb43af02980dfcf84f8d25574080', '/static/data/dress/58/1b4dfb43af02980dfcf84f8d25574080.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('353', 'FuNlYf2z9IU30thCM6TvofA-iR8P', 'eb960d6cc040d34648a4890ebc560cc8', '/static/data/dress/26/eb960d6cc040d34648a4890ebc560cc8.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('354', 'FuNlYf2z9IU30thCM6TvofA-iR8P', '53124d59c6c69eddfa3d9a2c4215b4b4', '/static/data/dress/12/53124d59c6c69eddfa3d9a2c4215b4b4.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('355', 'FuLbn_smN-mMRnr2MzIj4rC2hw30', 'da0748c693483deddeada3d01182a7b7', '/static/data/dress/19/da0748c693483deddeada3d01182a7b7.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('356', 'FpLaN3pFqX8WD8ZySCbQDBupmL7N', 'f3b75b07349bcfa7fad89f021884a403', '/static/data/dress/49/f3b75b07349bcfa7fad89f021884a403.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('357', 'Fqb5tS8H3CLS5mnmy-j8PWYykrkD', '36d8c30f46f5cf0a4733d818bbbe8b7e', '/static/data/dress/45/36d8c30f46f5cf0a4733d818bbbe8b7e.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('358', 'FuNlYf2z9IU30thCM6TvofA-iR8P', 'cacb17711e9fdfd89187322db886f5ff', '/static/data/dress/27/cacb17711e9fdfd89187322db886f5ff.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('359', 'FuNlYf2z9IU30thCM6TvofA-iR8P', '8f0b661e5a24bc13310d7312db1512e6', '/static/data/dress/55/8f0b661e5a24bc13310d7312db1512e6.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('360', 'FuNlYf2z9IU30thCM6TvofA-iR8P', 'ab0a0abe6afce8c06d5a7939502d39be', '/static/data/dress/10/ab0a0abe6afce8c06d5a7939502d39be.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('361', 'FuLbn_smN-mMRnr2MzIj4rC2hw30', '7be4c9c1bd21f4a8bac917edde7cb157', '/static/data/dress/96/7be4c9c1bd21f4a8bac917edde7cb157.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('362', 'FuNlYf2z9IU30thCM6TvofA-iR8P', '36dfdbc5c8632cf26bc51b3ab49713d9', '/static/data/dress/20/36dfdbc5c8632cf26bc51b3ab49713d9.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('363', 'FuLbn_smN-mMRnr2MzIj4rC2hw30', '0c37bc225add8917de764a08e2f5a991', '/static/data/dress/25/0c37bc225add8917de764a08e2f5a991.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('364', 'FlduRVcgSUtDf8gGksPd1KmCeu6_', 'c02900d248ed604fb68f56ada4682882', '/static/data/dress/34/c02900d248ed604fb68f56ada4682882.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('365', 'FvhwtsuA4_Ct9P47UXfBRFImqJSz', '9950828576147b54be4f53be7260ca9b', '/static/data/dress/48/9950828576147b54be4f53be7260ca9b.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('366', 'FisDkjsSrrGnikQbZnmPZbQ81-4-', '866640273372ffe680f0839d7e110290', '/static/data/dress/46/866640273372ffe680f0839d7e110290.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('367', 'Fj7DdXr-rviFB15aMBg0y08eJJzU', '3dfd61e11b81ea8da163e52b51344923', '/static/data/dress/98/3dfd61e11b81ea8da163e52b51344923.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('368', 'Fvptv4pdUsP-3fdss_nGkzIbf5P5', '6d2a2d2a4d6bcd92b4dc00a2c78f3915', '/static/data/dress/88/6d2a2d2a4d6bcd92b4dc00a2c78f3915.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('369', 'Fumy1Gh296j_f3IZ0I9k0GswqE8A', 'de72624d6ee83720ec353090039344c1', '/static/data/dress/91/de72624d6ee83720ec353090039344c1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('370', 'Fq1aIeB6e8CsJRBz37_XL0H6bU9U', '26535cf7298ff9b4d0a03404c8a62d1f', '/static/data/dress/26/26535cf7298ff9b4d0a03404c8a62d1f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('371', 'Fr6C7a-i0KCs6dqjKNjR9JiTOrBS', 'b269ceb96a51c5b850ce69182e5a0fff', '/static/data/dress/52/b269ceb96a51c5b850ce69182e5a0fff.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('372', 'Fr6C7a-i0KCs6dqjKNjR9JiTOrBS', '2b6fe561d37f234851e2f66cad522ccd', '/static/data/dress/54/2b6fe561d37f234851e2f66cad522ccd.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('373', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', '296a2f17d2285904535ee9aaef11f6f2', '/static/data/dress/29/296a2f17d2285904535ee9aaef11f6f2.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('374', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', '30a510c869acc3d273f2633e6a18f80a', '/static/data/dress/27/30a510c869acc3d273f2633e6a18f80a.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('375', 'Fq1aIeB6e8CsJRBz37_XL0H6bU9U', '6569c81cae8b779cb613b19c459e261f', '/static/data/dress/42/6569c81cae8b779cb613b19c459e261f.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('376', 'FpIjY7RwsIgg0dZIy461sMTKSdJo', 'f86721fb1a704323106a7e44e5e06262', '/static/data/dress/77/f86721fb1a704323106a7e44e5e06262.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('377', 'Fm_oRpsGUKVnqF-qk0Ct-noSphWS', '48f120fd3c20e51c3caab86876ee3a18', '/static/data/dress/17/48f120fd3c20e51c3caab86876ee3a18.png');
INSERT INTO `qiniu_pic_key_map` VALUES ('378', 'Fr6C7a-i0KCs6dqjKNjR9JiTOrBS', '180d75a4a78c103ca850d44cac57279d', '/static/data/dress/88/180d75a4a78c103ca850d44cac57279d.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('379', 'FqS4caHPtIxZaKuizSlMO1ex4iR3', '40743fe3137327a75a5a6a40dea07dcb', '/static/data/dress/21/40743fe3137327a75a5a6a40dea07dcb.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('380', 'FpNfZRxpE3teEVPbfSWkNTFvNi57', 'cfe1c03a1453f998cb777b1c56a01814', '/static/data/dress/34/cfe1c03a1453f998cb777b1c56a01814.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('381', 'Fv3NeLl9DxsANACI-U8NN5_2c-AS', '2e05d3b453982ca5eb1c1b8e8576f1ae', '/static/data/dress/43/2e05d3b453982ca5eb1c1b8e8576f1ae.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('382', 'Fp3KFd1wpcWjCZF-EHAsDPhaHii2', '204eeaa92c6eba75e7b779c601dbde67', '/static/data/dress/20/204eeaa92c6eba75e7b779c601dbde67.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('383', 'Fpm2AS1WdXjeboNB0xwgDnvBa-qK', '00e3ec59c914ac3363b0a346c19f2ecb', '/static/data/dress/94/00e3ec59c914ac3363b0a346c19f2ecb.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('384', 'FtxBPDAz-MhEFn2hlT7o_Fz7yTCB', '0b7ef4ac69fac19a3958748087622a74', '/static/data/dress/71/0b7ef4ac69fac19a3958748087622a74.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('385', 'FpUn78A71ImZKGJPDYcWKTP_B9hG', '33c7517cc272b0052d3b62f6c1dbc5db', '/static/data/dress/26/33c7517cc272b0052d3b62f6c1dbc5db.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('386', 'FvBLV9DtpKCjoPrSfyBYqGZIJmib', 'c2d46fcfda4dbf6d2a30363d9d3b5d2c', '/static/data/dress/79/c2d46fcfda4dbf6d2a30363d9d3b5d2c.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('387', 'Flqml7qdqwTL2erhZLXVEg9PnVIn', 'db01b453f0000eda9e2aca9386df3c99', '/static/data/dress/45/db01b453f0000eda9e2aca9386df3c99.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('388', 'FlKFJ_zUpGzS8biKmYIWVVhlcOLE', 'd53899e2ce09b35e5d912e3425199b7a', '/static/data/dress/78/d53899e2ce09b35e5d912e3425199b7a.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('389', 'FsNt_8bCnuny6lyDIcukazp4uQHe', 'a25ce4c6fcab5de0cb6ed33c02dc58f1', '/static/data/dress/18/a25ce4c6fcab5de0cb6ed33c02dc58f1.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('390', 'FrHr4QYAMs5K6SWO9yZDHAuu01Nf', '7ac87b2676bf466a8c3509a6874f7e57', '/static/data/dress/93/7ac87b2676bf466a8c3509a6874f7e57.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('391', 'FuRqn5XwiQbGXyMbE2zHTAxW3Fvl', '5eaf39bd9b86f6f2a08cff310092458d', '/static/data/dress/32/5eaf39bd9b86f6f2a08cff310092458d.jpg');
INSERT INTO `qiniu_pic_key_map` VALUES ('392', 'Fq1aIeB6e8CsJRBz37_XL0H6bU9U', '0b5bfa17f8d1ebe720abed0cb97b15f7', '/static/data/advertisement_position_img/0b5bfa17f8d1ebe720abed0cb97b15f7.jpg');

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
  `handle_reason` varchar(500) DEFAULT NULL COMMENT '处理原因',
  `refund_money` decimal(10,2) DEFAULT NULL COMMENT '退款金额',
  `refund_time` int(11) DEFAULT NULL COMMENT '退款时间',
  `is_handle` tinyint(4) DEFAULT '0' COMMENT '是否已处理',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of return_exchange
-- ----------------------------
INSERT INTO `return_exchange` VALUES ('14', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '2', '未收到货', '', '[]', null, '0.00', '0', '1', '1477841075');
INSERT INTO `return_exchange` VALUES ('15', '3', '1', 'a005526146b4b7914c868062f677d2f1', '1', '颜色/款色/图案与描述不符', '不是不是不是不是', '[]', 'ata', '0.00', '0', '1', '1477884968');
INSERT INTO `return_exchange` VALUES ('13', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '3', '大小尺寸与商品描述不符', 'Asfadsfadsfadsfdsfads', '[]', null, '0.00', '0', '0', '1477840008');
INSERT INTO `return_exchange` VALUES ('12', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '2', '未收到货', 'Sdfasdfasdf', '[]', null, '0.00', '0', '0', '1477839985');
INSERT INTO `return_exchange` VALUES ('11', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '1', '大小尺寸与商品描述不符', 'Asdfadsfasdf', '[]', null, '0.00', '0', '0', '1477839963');
INSERT INTO `return_exchange` VALUES ('10', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '1', '卖家发错货', 'Asdfasdfasdfads', '[]', null, '0.00', '0', '0', '1477839849');
INSERT INTO `return_exchange` VALUES ('9', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '1', '尺码拍错/素材选错/设计出错', 'Asdfadsfadsfadsfasfasfdsaf', '[]', null, '0.00', '0', '0', '1477839369');
INSERT INTO `return_exchange` VALUES ('8', '2', '1', '24f5537b4db873a1b67508c6af9fbf0b', '1', '尺码拍错/素材选错/设计出错', 'Jsdifjaisfjoiasdjfoiadjsfiojasfadsfasdfsfadsf', '[]', null, '0.00', '0', '0', '1477839324');
INSERT INTO `return_exchange` VALUES ('16', '3', '1', '893e75d8c829ef4e47b28cd455920c39', '2', '未收到货', '哈哈哈哈哈', '[]', null, '0.00', '0', '0', '1477885009');
INSERT INTO `return_exchange` VALUES ('17', '3', '1', 'c35d67686c1c8a22b24bd449b7df41cd', '2', '已收到货', '哈哈哈哈哈哈哈', '[]', null, '0.00', '0', '0', '1477886311');
INSERT INTO `return_exchange` VALUES ('18', '3', '1', 'e5d25c169dc98522219f9e023236371b', '1', '大小尺寸与商品描述不符', '黑乌乌', '[]', null, '0.00', '0', '0', '1477886336');
INSERT INTO `return_exchange` VALUES ('19', '3', '1', '85b9053ef10a249cec5e50b76b4ca5ed', '2', '未收到货', 'Sadfsfasdfsdafsdf', '[]', null, '0.00', '0', '0', '1478611845');
INSERT INTO `return_exchange` VALUES ('20', '4', '1', '32d9a672f92abaeb56cb39a4876cb630', '1', '大小尺寸与商品描述不符', '饿了', '[]', null, '0.00', '0', '1', '1478683506');
INSERT INTO `return_exchange` VALUES ('21', '7', '1', '83584af387954a885739eef843b4c7c6', '1', '尺码拍错/素材选错/设计出错', '我爱何诗琪不爱你了', '[]', null, '0.00', '0', '1', '1478773640');
INSERT INTO `return_exchange` VALUES ('22', '7', '1', '1479094319542389', '2', '未收到货', '', '[]', null, '0.00', '0', '1', '1479094562');
INSERT INTO `return_exchange` VALUES ('23', '7', '1', '1479107840997637', '2', '未收到货', '', '[\"811490eeb5ba69988f91066bc9cb6abe1479108536\"]', null, '0.00', '0', '1', '1479108538');
INSERT INTO `return_exchange` VALUES ('24', '3', '1', '1479219528043673', '1', '大小尺寸与商品描述不符', '啊哈哈宝贝', '[]', null, '0.00', '0', '0', '1479219577');
INSERT INTO `return_exchange` VALUES ('25', '3', '1', '1479221598410475', '1', '大小尺寸与商品描述不符', '', '[]', null, '0.00', '0', '0', '1479223465');
INSERT INTO `return_exchange` VALUES ('26', '3', '1', '1479221579405862', '2', '未收到货', '', '[]', null, '0.00', '0', '0', '1479223485');
INSERT INTO `return_exchange` VALUES ('27', '3', '1', '1479221493403182', '3', '大小尺寸与商品描述不符', '', '[]', null, '0.00', '0', '0', '1479223498');
INSERT INTO `return_exchange` VALUES ('28', '7', '1', '1479260300165266', '1', '已收到货', '', '[\"8f64efd839d155951f7bf7224676587e1479260653\"]', null, '0.00', '0', '0', '1479260660');
INSERT INTO `return_exchange` VALUES ('29', '7', '1', '1479265576376821', '3', '尺码拍错/素材选错/设计出错', '叼你何诗琪', '[\"8f64efd839d155951f7bf7224676587e1479267153\"]', null, '0.00', '0', '0', '1479267155');
INSERT INTO `return_exchange` VALUES ('30', '4', '1', '1479622558094581', '2', '未收到货', '', '[\"6712821196887682e513eeb39c4e97071479624001.489666\"]', '退你麻痹', '0.00', '0', '1', '1479623807');
INSERT INTO `return_exchange` VALUES ('31', '4', '1', '1479609202799238', '2', '未收到货', '', '[\"6712821196887682e513eeb39c4e97071479624034.300397\"]', '你真J8麻烦', '0.00', '0', '1', '1479623829');
INSERT INTO `return_exchange` VALUES ('32', '7', '1', '1479651237120215', '2', '未收到货', '', '[\"8d8520045d8da66334e886c77b30b23c1479651341\"]', '', '0.00', '0', '1', '1479651398');
INSERT INTO `return_exchange` VALUES ('33', '4', '1', '1479609186141059', '2', '未收到货', '', '[]', '退你麻痹', '0.00', '0', '1', '1479651874');
INSERT INTO `return_exchange` VALUES ('34', '7', '1', '1479651919377254', '2', '已收到货', '', '[]', '退你麻痹', '0.00', '0', '1', '1479651953');
INSERT INTO `return_exchange` VALUES ('35', '3', '1', '1482305822942056', '1', '大小尺寸与商品描述不符', '肥肥肥', '[\"db4f3f07c69aadf8f5dd73af09a607101483320118.788997\"]', null, null, null, '0', '1483320128');
INSERT INTO `return_exchange` VALUES ('36', '3', '1', '2017010402100003', '2', '未收到货', '哈哈哈哈哈', '[\"01205888d14dbf6931f425e21ecd61a51483670194.849180\"]', null, '0.00', '0', '0', '1483670197');

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `keystr` varchar(50) DEFAULT NULL COMMENT '键',
  `valuestr` text COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('1', 'advertisement_catalog_config', '[{\"id\":\"1\",\"name\":\"\\u4e3b\\u754c\\u9762\"},{\"id\":\"2\",\"name\":\"\\u54c1\\u724c\"},{\"id\":\"3\",\"name\":\"\\u81ea\\u8425\"}]');
INSERT INTO `setting` VALUES ('2', 'guess_like_config', '[{\"vender_id\":\"1\",\"dress_id\":1,\"pic_index\":1},{\"vender_id\":\"1\",\"dress_id\":9}]');
INSERT INTO `setting` VALUES ('3', 'discount_activity_config', '[]');
INSERT INTO `setting` VALUES ('5', 'bg_advertisement_config', '[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/f579adf6a31c91600001424d8fc09bf2.jpg\",\"url\":\"https:\\/\\/www.du.com\\/\"},{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/d47360af4e98fabee77b7d77a9cd6f87.jpg\",\"url\":\"https:\\/\\/www.bai.com\\/\"}]');
INSERT INTO `setting` VALUES ('6', 'top_advertisement_config', '[{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/c5dd13e6972f9b4fa278b292c56f6614.png\",\"url\":\"https:\\/\\/www.aaa.com\\/\"},{\"pic\":\"\\/static\\/data\\/advertisement_position_img\\/fd4df4b02bf255ab52970cd5991b28f4.png\",\"url\":\"https:\\/\\/www.baidu.com\\/\"}]');
INSERT INTO `setting` VALUES ('7', 'is_show_advertisement', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopping_cart
-- ----------------------------
INSERT INTO `shopping_cart` VALUES ('1', '1', '1', '112', '2', '{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"desc\":\"\\u6d4b\\u8bd5\\u670d\\u99701\\u6d4b\\u8bd5\\u670d\\u99701\",\"sex\":\"2\",\"price\":\"50.00\",\"discount_price\":\"40.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1475294365\",\"create_time\":\"1474507738\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"109\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]},{\"id\":\"110\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"111\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"113\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"114\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"38\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u7eaf\\u68c9\"},{\"id\":\"39\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u9ebb\\u5e03\"},{\"id\":\"40\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"112\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}', '1475343144');
INSERT INTO `shopping_cart` VALUES ('2', '1', '1', '120', '4', '{\"id\":\"1\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u6d4b\\u8bd5\\u670d\\u99701\",\"desc\":\"\\u6d4b\\u8bd5\\u670d\\u99701\\u6d4b\\u8bd5\\u670d\\u99701\",\"shuo_ming\":\"\\u670d\\u9970\\u670d\\u9970\\u670d\\u9970\\u8bf4\\u8bf4\\u660e\\u660e\",\"sex\":\"2\",\"price\":\"50.00\",\"discount_price\":\"40.00\",\"pics\":[\"\\/static\\/data\\/dress\\/48\\/7ea7a7c4e8d0a986a34d1bec0b85b88c.jpeg\",\"\\/static\\/data\\/dress\\/67\\/863840619527ceecba13b58b9b8a8186.jpeg\"],\"dress_match_ids\":{\"vender\":[\"1\"],\"manager\":[\"1\",\"3\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1475981425\",\"create_time\":\"1474507738\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"115\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u767d\",\"stock\":\"1\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\",\"\\/static\\/data\\/dress\\/79\\/5b5cd70b82bf6bfc9eaad686fd8476b6.jpeg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/cfdc487e322a5ae1bb7cd18bb6895a79.jpeg\",\"\\/static\\/data\\/dress\\/40\\/371ca615cabbcca7bd57b726918d4519.jpeg\"]},{\"id\":\"116\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"S\",\"color_name\":\"\\u9ed1\",\"stock\":\"2\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"117\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"3\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"118\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"91\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"119\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"5\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"120\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"40\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5939\\u514b\"},{\"id\":\"41\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"41\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u7eaf\\u68c9\"},{\"id\":\"42\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u9ebb\\u5e03\"},{\"id\":\"43\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"120\",\"vender_id\":\"1\",\"dress_id\":\"1\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"6\",\"pic\":[\"\\/static\\/data\\/dress\\/64\\/f6c621c1b97aef976a5eaeb7498c84c2.jpg\"],\"pics\":[\"\",\"\"]}', '1476113605');
INSERT INTO `shopping_cart` VALUES ('28', '3', '13', '133', '2', '{\"id\":\"13\",\"vender_id\":\"1\",\"catalog_id\":\"175\",\"name\":\"\\u4fdd\\u6696\\u6253\\u5e95\\u6064\\u886b\",\"desc\":\"\\u51ac\\u65e5\\u5fc5\\u5907\\u5355\\u54c1\",\"detail\":\"<p><br><\\/p>\",\"shuo_ming\":\"\\u91c7\\u7528\\u7f8a\\u6bdb\\u6df7\\u7eba\\u9762\\u6599\\uff0c\\u4fdd\\u6696\\u53c8\\u8212\\u9002\",\"sex\":\"1\",\"price\":\"1000.00\",\"discount_price\":\"20000.00\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"4\"]},\"sale_count\":\"9\",\"like_count\":\"0\",\"is_hot\":\"0\",\"status\":\"2\",\"update_time\":\"1479352582\",\"create_time\":\"1479112264\",\"catalog_name\":\"\\u6064\\u886b\",\"dress_size_color_count\":[{\"id\":\"132\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"1297\",\"pic\":[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]},{\"id\":\"133\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"L\",\"color_name\":\"\\u7070\",\"stock\":\"221\",\"pic\":[\"\\/static\\/data\\/dress\\/83\\/36b40c7f3a7d73416f10caac1016c74b.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/74\\/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg\",\"\\/static\\/data\\/dress\\/64\\/267f488379812966df56196b44ab457f.jpg\"]}],\"dress_tag\":[{\"id\":\"161\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"T\\u6064\"},{\"id\":\"162\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"170\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u7f8a\\u6bdb\\u6df7\\u7eba\"}]}', '{\"id\":\"133\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"L\",\"color_name\":\"\\u7070\",\"stock\":\"221\",\"pic\":[\"\\/static\\/data\\/dress\\/83\\/36b40c7f3a7d73416f10caac1016c74b.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/74\\/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg\",\"\\/static\\/data\\/dress\\/64\\/267f488379812966df56196b44ab457f.jpg\"]}', '1479368464');
INSERT INTO `shopping_cart` VALUES ('29', '3', '17', '139', '1', '{\"id\":\"17\",\"vender_id\":\"1\",\"catalog_id\":\"196\",\"name\":\"\\u9ed1\\u8272\\u8584\\u7eb1\\u857e\\u4e1d\\u534a\\u8eab\\u88d9\",\"desc\":\"\\u6c34\\u6eb6\\u6027\\u857e\\u4e1d\\u52a0\\u4e00\\u5c42\\u67d4\\u8f6f\\u8584\\u7eb1\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/71\\/7380b1e6a83e0f46c3c26db9d504fcf9.jpg\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/71\\/7380b1e6a83e0f46c3c26db9d504fcf9.jpg\\\" style=\\\"max-width: 100%;\\\"><\\/p>\",\"shuo_ming\":\"\",\"sex\":\"2\",\"price\":\"999.00\",\"discount_price\":\"0.01\",\"pics\":[],\"dress_match_ids\":[],\"sale_count\":\"9\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1479651896\",\"create_time\":\"1479564596\",\"catalog_name\":\"\\u534a\\u88d9\",\"dress_size_color_count\":[{\"id\":\"139\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"98\",\"pic\":[\"\\/static\\/data\\/dress\\/68\\/11083b65e2359c80dd141ac7d757588c.jpg\"],\"pics\":[\"\",\"\"]},{\"id\":\"140\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"size_name\":\"XL\",\"color_name\":\"\\u9ed1\",\"stock\":\"108\",\"pic\":[\"\\/static\\/data\\/dress\\/91\\/388cb762fdd2314c498316f99798e5a8.jpg\"],\"pics\":[\"\",\"\"]}],\"dress_tag\":[{\"id\":\"248\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"249\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"214\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"}]}', '{\"id\":\"139\",\"vender_id\":\"1\",\"dress_id\":\"17\",\"size_name\":\"L\",\"color_name\":\"\\u9ed1\",\"stock\":\"98\",\"pic\":[\"\\/static\\/data\\/dress\\/68\\/11083b65e2359c80dd141ac7d757588c.jpg\"],\"pics\":[\"\",\"\"]}', '1480650558');
INSERT INTO `shopping_cart` VALUES ('9', '5', '9', '128', '1', '{\"id\":\"9\",\"vender_id\":\"1\",\"catalog_id\":\"1\",\"name\":\"\\u857e\\u4e1d\\u88d9\",\"desc\":\"\\u53ef\\u7231\\u857e\\u4e1d\\u88d9\",\"detail\":\"\",\"shuo_ming\":\"\\u6765\\u554a\\uff0c\\u65e5\\u6211\\u554a\",\"sex\":\"2\",\"price\":\"13412.00\",\"discount_price\":\"1.00\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"5\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"0\",\"status\":\"1\",\"update_time\":\"1477973348\",\"create_time\":\"1477970235\",\"catalog_name\":\"\\u5916\\u5957\",\"dress_size_color_count\":[{\"id\":\"128\",\"vender_id\":\"1\",\"dress_id\":\"9\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"1213\",\"pic\":[\"\\/static\\/data\\/dress\\/19\\/0771c736ecf33814aa8002f16bb60331.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/92\\/bc865ebdd9347a99b2085ef5446ad501.jpg\",\"\\/static\\/data\\/dress\\/78\\/8257ae69c5ce1e472ce1a2d8c0d37c3e.jpg\"]}],\"dress_tag\":[{\"id\":\"76\",\"vender_id\":\"1\",\"dress_id\":\"9\",\"name\":\"\\u857e\\u4e1d\\u88d9\"}],\"dress_material\":[{\"id\":\"86\",\"vender_id\":\"1\",\"dress_id\":\"9\",\"name\":\"\\u5c3c\\u9f99\"}]}', '{\"id\":\"128\",\"vender_id\":\"1\",\"dress_id\":\"9\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"1213\",\"pic\":[\"\\/static\\/data\\/dress\\/19\\/0771c736ecf33814aa8002f16bb60331.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/92\\/bc865ebdd9347a99b2085ef5446ad501.jpg\",\"\\/static\\/data\\/dress\\/78\\/8257ae69c5ce1e472ce1a2d8c0d37c3e.jpg\"]}', '1477983725');
INSERT INTO `shopping_cart` VALUES ('27', '4', '13', '132', '1', '{\"id\":\"13\",\"vender_id\":\"1\",\"catalog_id\":\"175\",\"name\":\"\\u4fdd\\u6696\\u6253\\u5e95\\u6064\\u886b\",\"desc\":\"\\u51ac\\u65e5\\u5fc5\\u5907\\u5355\\u54c1\",\"detail\":\"<p><br><\\/p>\",\"shuo_ming\":\"\\u91c7\\u7528\\u7f8a\\u6bdb\\u6df7\\u7eba\\u9762\\u6599\\uff0c\\u4fdd\\u6696\\u53c8\\u8212\\u9002\",\"sex\":\"1\",\"price\":\"1000.00\",\"discount_price\":\"20000.00\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"4\"]},\"sale_count\":\"9\",\"like_count\":\"0\",\"is_hot\":\"0\",\"status\":\"2\",\"update_time\":\"1479352582\",\"create_time\":\"1479112264\",\"catalog_name\":\"\\u6064\\u886b\",\"dress_size_color_count\":[{\"id\":\"132\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"1297\",\"pic\":[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]},{\"id\":\"133\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"L\",\"color_name\":\"\\u7070\",\"stock\":\"221\",\"pic\":[\"\\/static\\/data\\/dress\\/83\\/36b40c7f3a7d73416f10caac1016c74b.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/74\\/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg\",\"\\/static\\/data\\/dress\\/64\\/267f488379812966df56196b44ab457f.jpg\"]}],\"dress_tag\":[{\"id\":\"161\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"T\\u6064\"},{\"id\":\"162\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"170\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u7f8a\\u6bdb\\u6df7\\u7eba\"}]}', '{\"id\":\"132\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"1297\",\"pic\":[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]}', '1479366464');
INSERT INTO `shopping_cart` VALUES ('26', '3', '13', '132', '2', '{\"id\":\"13\",\"vender_id\":\"1\",\"catalog_id\":\"175\",\"name\":\"\\u4fdd\\u6696\\u6253\\u5e95\\u6064\\u886b\",\"desc\":\"\\u51ac\\u65e5\\u5fc5\\u5907\\u5355\\u54c1\",\"detail\":\"<p><br><\\/p>\",\"shuo_ming\":\"\\u91c7\\u7528\\u7f8a\\u6bdb\\u6df7\\u7eba\\u9762\\u6599\\uff0c\\u4fdd\\u6696\\u53c8\\u8212\\u9002\",\"sex\":\"1\",\"price\":\"1000.00\",\"discount_price\":\"0.01\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"4\"]},\"sale_count\":\"8\",\"like_count\":\"0\",\"is_hot\":\"0\",\"status\":\"2\",\"update_time\":\"1479293319\",\"create_time\":\"1479112264\",\"catalog_name\":\"\\u6064\\u886b\",\"dress_size_color_count\":[{\"id\":\"132\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"1304\",\"pic\":[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]},{\"id\":\"133\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"L\",\"color_name\":\"\\u7070\",\"stock\":\"221\",\"pic\":[\"\\/static\\/data\\/dress\\/83\\/36b40c7f3a7d73416f10caac1016c74b.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/74\\/6f1fe5baf9eb4f0f1f3ea296e2eccc23.jpg\",\"\\/static\\/data\\/dress\\/64\\/267f488379812966df56196b44ab457f.jpg\"]}],\"dress_tag\":[{\"id\":\"157\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"T\\u6064\"},{\"id\":\"158\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"168\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"name\":\"\\u7f8a\\u6bdb\\u6df7\\u7eba\"}]}', '{\"id\":\"132\",\"vender_id\":\"1\",\"dress_id\":\"13\",\"size_name\":\"M\",\"color_name\":\"\\u9ed1\",\"stock\":\"1304\",\"pic\":[\"\\/static\\/data\\/dress\\/25\\/a49521ece34376ef3cebc190f16e19fb.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/88\\/81e99bbec4b6331ca34615ed41390054.jpg\",\"\\/static\\/data\\/dress\\/83\\/b0c4342a3105248afb439d354dd44f9e.jpg\"]}', '1479351884');
INSERT INTO `shopping_cart` VALUES ('30', '3', '16', '137', '1', '{\"id\":\"16\",\"vender_id\":\"1\",\"catalog_id\":\"241\",\"name\":\"\\u4e00\\u5b57\\u80a9\\u663e\\u7626\\u857e\\u4e1d\\u88d9\",\"desc\":\"\\u6b27\\u6d32\\u8fdb\\u53e3\\u4f20\\u7edf\\u857e\\u4e1d\",\"detail\":\"<p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/33\\/b09cd707caf60d9ff2c836e87acda631.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/91\\/d3069f0734d5947937e098c526a9a9dc.jpg\\\"><\\/p><p><img src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\" style=\\\"max-width: 100%;\\\" _src=\\\"http:\\/\\/unique.xdh-syy.com\\/static\\/data\\/dress\\/35\\/76e80c92f28ea710c7543fcb7f27b93e.jpg\\\"><\\/p><p><br><\\/p>\",\"shuo_ming\":\"\\u539f\\u6765\\u539f\\u6765\\u4f60\\u662f\\u6211\\u7684\\u4e3b\\u6253\\u6b4c\",\"sex\":\"2\",\"price\":\"581.00\",\"discount_price\":\"0.02\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"4\",\"9\"]},\"sale_count\":\"1\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1479651834\",\"create_time\":\"1479372194\",\"catalog_name\":\"\\u8fde\\u8863\\u88d9\",\"dress_size_color_count\":[{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"119\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]},{\"id\":\"138\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"L\",\"color_name\":\"\\u767d\",\"stock\":\"212\",\"pic\":[\"\\/static\\/data\\/dress\\/88\\/55585735bd64de0d20187a779a3bdde8.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/43\\/b916f6ca4f9647a92efd00a9552b5a24.jpg\",\"\\/static\\/data\\/dress\\/32\\/e8da04c2a4fd5870e96b9d7409f2ec0b.jpg\"]}],\"dress_tag\":[{\"id\":\"244\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u857e\\u4e1d\\u88d9\"},{\"id\":\"245\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u79cb\\u51ac\"}],\"dress_material\":[{\"id\":\"212\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"name\":\"\\u4f20\\u7edf\\u857e\\u4e1d\"}]}', '{\"id\":\"137\",\"vender_id\":\"1\",\"dress_id\":\"16\",\"size_name\":\"M\",\"color_name\":\"\\u767d\",\"stock\":\"119\",\"pic\":[\"\\/static\\/data\\/dress\\/23\\/490b51ef1da0feb9b4f30ddd42ff7627.jpg\",\"\\/static\\/data\\/dress\\/35\\/383e5e1061e0fe58b8d3d69cfdc9d24c.jpg\"],\"pics\":[\"\\/static\\/data\\/dress\\/13\\/5fb5f6541c9a69d06485b61a064b2413.jpg\",\"\\/static\\/data\\/dress\\/80\\/735e8e0574fb7155c99b4fdcd5391f1c.jpg\"]}', '1480650565');
INSERT INTO `shopping_cart` VALUES ('31', '7', '19', '146', '1', '{\"id\":\"19\",\"vender_id\":\"1\",\"catalog_id\":\"154\",\"name\":\"\\u4fee\\u8eab\\u8d85\\u957f\\u6b3e\\u53cc\\u9762\\u6bdb\\u5462\\u5927\\u8863\",\"desc\":\"\\u7cbe\\u9009\\u8d85\\u987a\\u6ed1\\u53cc\\u9762\\u987a\\u6bdb\\u6bdb\\u5462\",\"detail\":\"<p><br><\\/p>\",\"shuo_ming\":\"\\u7ecf\\u5178\\u5927\\u7ffb\\u9886\\u642d\\u914d\\u8d85\\u957f\\u4fee\\u8eab\\u4e0b\\u6446\\uff0c\\u8ba9\\u4f60\\u6210\\u4e3a\\u4e07\\u4f17\\u7126\\u70b9\",\"sex\":\"2\",\"price\":\"872.00\",\"discount_price\":\"463.50\",\"pics\":[],\"dress_match_ids\":{\"vender\":[\"9\"]},\"sale_count\":\"0\",\"like_count\":\"0\",\"is_hot\":\"1\",\"status\":\"2\",\"update_time\":\"1482898905\",\"create_time\":\"1482897206\",\"catalog_name\":\"\\u5927\\u8863\",\"dress_size_color_count\":[{\"id\":\"145\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"size_name\":\"S\",\"color_name\":\"\\u6de1\\u7c89\\u8272\",\"stock\":\"20\",\"pic\":[\"\\/static\\/data\\/dress\\/73\\/3847af6504d583da154d58645773c24d.png\"],\"pics\":[\"\\/static\\/data\\/dress\\/34\\/acc5a097c4590436489fb7ff13e72fee.png\",\"\\/static\\/data\\/dress\\/72\\/b300f932f16aac2674771b8eaeed253e.png\"]},{\"id\":\"146\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"size_name\":\"M\",\"color_name\":\"\\u6de1\\u7c89\\u8272\",\"stock\":\"20\",\"pic\":[\"\\/static\\/data\\/dress\\/53\\/906fda996c5baa08f344075c06c079e2.png\"],\"pics\":[\"\\/static\\/data\\/dress\\/16\\/1260eab1f98580aaaeeba41ea3dae14b.png\",\"\\/static\\/data\\/dress\\/72\\/887133a4ffdba9fec3528dbd75f1ae58.png\"]},{\"id\":\"147\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"size_name\":\"L\",\"color_name\":\"\\u6de1\\u7c89\\u8272\",\"stock\":\"10\",\"pic\":[\"\\/static\\/data\\/dress\\/20\\/27cd8fc9b645f8390063ff3499af1ea3.png\"],\"pics\":[\"\\/static\\/data\\/dress\\/71\\/e10d09fe0f3948bcc83db1ba8e5da77e.png\",\"\\/static\\/data\\/dress\\/42\\/9cce75da41e8b9899acb000bf4703703.png\"]}],\"dress_tag\":[{\"id\":\"273\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"name\":\"\\u79cb\\u51ac\"},{\"id\":\"274\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"name\":\"\\u4fee\\u8eab\"},{\"id\":\"275\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"name\":\"\\u5927\\u8863\"}],\"dress_material\":[{\"id\":\"226\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"name\":\"\\u53cc\\u9762\\u987a\\u6bdb\\u6bdb\\u5462\"}]}', '{\"id\":\"146\",\"vender_id\":\"1\",\"dress_id\":\"19\",\"size_name\":\"M\",\"color_name\":\"\\u6de1\\u7c89\\u8272\",\"stock\":\"20\",\"pic\":[\"\\/static\\/data\\/dress\\/53\\/906fda996c5baa08f344075c06c079e2.png\"],\"pics\":[\"\\/static\\/data\\/dress\\/16\\/1260eab1f98580aaaeeba41ea3dae14b.png\",\"\\/static\\/data\\/dress\\/72\\/887133a4ffdba9fec3528dbd75f1ae58.png\"]}', '1482909857');

-- ----------------------------
-- Table structure for `system_sns`
-- ----------------------------
DROP TABLE IF EXISTS `system_sns`;
CREATE TABLE `system_sns` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `type` int(11) NOT NULL COMMENT '通知类型：0后台管理员通知1已添加喜爱的新服饰上架提示2付款通知3发货通知',
  `content` varchar(500) NOT NULL COMMENT '内容',
  `data_id` int(11) NOT NULL COMMENT '数据记录id',
  `create_time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_sns
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('8', '2', 'F0F988FD0E5B2D6D3A4AE0208FEDB901', null, 'Richard.', null, null, null, '100', null, 'http://qzapp.qlogo.cn/qzapp/1105733634/F0F988FD0E5B2D6D3A4AE0208FEDB901/100', null, '1477989847');
INSERT INTO `user` VALUES ('2', null, null, null, null, '13318780833', null, 'e10adc3949ba59abbe56e057f20f883e', '100', null, null, null, '1477745148');
INSERT INTO `user` VALUES ('3', '1', 'oh9VRwZca1kv76Cfhmcf7-wu6jqY', 'Richard', 'Richard', '18520229661', null, 'e10adc3949ba59abbe56e057f20f883e', '10', '2', 'http://wx.qlogo.cn/mmopen/yuksLibQcy84Qls58FaCC04kOYZldUVyu1uhOaq0rIbIXibnXjcRZUBxBGIP8Lknfn1jhuNM6Fty3icnSCkpibNuxniaf1wPkZeiae/0', '患得患失。 ', '1477760566');
INSERT INTO `user` VALUES ('4', '1', 'oh9VRwXCuoOtgRQtNpkk083aOAZo', '来啊来啊互相伤害啊', 'Bean', '13480244366', null, null, '115', '2', 'http://static.xdh-syy.com/d9b58b91f1405d91b9863241ea0d8a191479369117', '啦啦啦啦他', '1477795787');
INSERT INTO `user` VALUES ('7', '1', 'oh9VRwdPRwrCOvef54P2QUNfgG8w', 'Leslie', 'XDH.Leslie Yiang', '13560206881', null, '4e4926fad52f67410b39a821598b77e4', '56', '1', 'http://static.xdh-syy.com/8f64efd839d155951f7bf7224676587e1479261257', 'Bilibala', '1477987300');
INSERT INTO `user` VALUES ('12', '1', 'oh9VRweHZReVaUyy_H964GFEI3Ww', null, 'Arthas', '13711044109', null, null, '100', null, 'http://wx.qlogo.cn/mmopen/yuksLibQcy84H812ou7vd6sZCRkX9BmcMUEnV25ichiaelONqZTEg4dMwOTzp1oK6mJicmHwmRhQYgUOo78oB7ZJGd0y2KG0xJPs/0', null, '1480559173');
INSERT INTO `user` VALUES ('11', null, null, null, null, '15820259364', null, 'aba1fa67e912df3a560542012b348021', '100', null, null, null, '1479433457');
INSERT INTO `user` VALUES ('9', null, null, null, null, '13697499159', null, 'e10adc3949ba59abbe56e057f20f883e', '103', null, 'http://static.xdh-syy.com/4aafe2ef40194eabb29b6c43da6801811484488595.976126', null, '1478266749');
INSERT INTO `user` VALUES ('10', '1', 'oh9VRwUH6mNkJqxmRxg1__N-W890', null, '秋秋', '13318780828', null, null, '100', null, 'http://wx.qlogo.cn/mmopen/MqN4d1hLfxPBQE6DymXOy8hd17KZ4vnUMRJI5dJgMZB7INRD67MS2omuGJ3TsplV3FPHbWUPypNlc5vZfaVtTpa7NMXcAiaIG/0', null, '1478397033');
INSERT INTO `user` VALUES ('13', null, null, null, null, '15014191886', null, '01e481f378f913e5eaa2b1cb09a0c19e', '102', null, null, null, '1481869015');
INSERT INTO `user` VALUES ('14', null, null, null, null, '18611664684', null, '66469970d89f61d834c9a77bbb510f56', '100', null, null, null, '1482406568');
INSERT INTO `user` VALUES ('15', '1', 'oh9VRwUZkDZxe45mMG58a8FvLTo8', null, '蕉仔伟', null, null, null, '100', null, 'http://wx.qlogo.cn/mmopen/yuksLibQcy84RoydOM28R9nhXLiaCJTC4B6IdD4Vyv6urQkvwgFZ9heHib2bBU1H5KuXtPzk1JxGn0ysxlDCRtXHDeRLFWickXCF/0', null, '1483530041');
INSERT INTO `user` VALUES ('16', '1', 'oh9VRwXnz0sYgGb-jHqkuapHDmkk', null, '@', '15807657230', null, null, '101', null, 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCicfUtqVuTcM9qJoCZbFQq0hklJt1HeibMhwwQhzhWf9XokB0yu3qIfxFtR6A6uqStjYpOicaImnWMy4XzgM4jzOvDTLpicNv4NGg/0', null, '1484531254');
INSERT INTO `user` VALUES ('17', '1', 'oh9VRwReocOFJHWuen0GRsDCQozU', null, '微尘', null, null, null, '101', null, 'http://wx.qlogo.cn/mmopen/MqN4d1hLfxNJ6HT6YNcNuYlAwleT8F54OcEMLOwPvQSr86kI1Zu07VH0ZpfrgTXR3QKpgvSNfHlIqnuQYa5abVhT1NnrCmZO/0', null, '1484912954');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_add_gold_record
-- ----------------------------
INSERT INTO `user_add_gold_record` VALUES ('1', '0', '1', '1', '1', '1474357870');
INSERT INTO `user_add_gold_record` VALUES ('2', '0', '1', '1', '2', '1474357928');
INSERT INTO `user_add_gold_record` VALUES ('3', '0', '1', '5', '1', '1477971992');

-- ----------------------------
-- Table structure for `user_dress_collection`
-- ----------------------------
DROP TABLE IF EXISTS `user_dress_collection`;
CREATE TABLE `user_dress_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID自增，收藏记录id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `sex` tinyint(4) DEFAULT NULL COMMENT '性别：1男2女',
  `dress_id` int(11) DEFAULT NULL COMMENT '服饰ID',
  `create_time` int(11) DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_dress_collection
-- ----------------------------
INSERT INTO `user_dress_collection` VALUES ('3', '3', '2', '16', '1482156269');
INSERT INTO `user_dress_collection` VALUES ('4', '4', '2', '16', '1482986164');

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
  `catalog_id` int(11) DEFAULT NULL COMMENT '服饰分类ID',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `manager_dress_match_id` int(11) DEFAULT NULL COMMENT '管理员服饰搭配ID',
  `detail_pics` text COMMENT '详细图片',
  `pics` text COMMENT '正反面图片',
  `zhen_pic` varchar(500) DEFAULT NULL COMMENT '正面图片',
  `fan_pic` varchar(500) DEFAULT NULL COMMENT '反面图片',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vender_dress_match
-- ----------------------------
INSERT INTO `vender_dress_match` VALUES ('12', '1', '流苏2', '169', '24.60', '0', '[\"\\/static\\/data\\/dress\\/21\\/40743fe3137327a75a5a6a40dea07dcb.jpg\"]', '[]', '/static/data/dress/25/0c37bc225add8917de764a08e2f5a991.png', '/static/data/dress/19/da0748c693483deddeada3d01182a7b7.png', '1482920072');
INSERT INTO `vender_dress_match` VALUES ('14', '1', '纽扣1', '327', '0.00', '0', '[\"\\/static\\/data\\/dress\\/18\\/a25ce4c6fcab5de0cb6ed33c02dc58f1.jpg\"]', '[]', '', '', '1483079681');
INSERT INTO `vender_dress_match` VALUES ('15', '1', '纽扣2', '327', '0.00', '0', '[\"\\/static\\/data\\/dress\\/93\\/7ac87b2676bf466a8c3509a6874f7e57.jpg\"]', '[]', '', '', '1483079706');
INSERT INTO `vender_dress_match` VALUES ('11', '1', '流苏1', '169', '20.00', '0', '[\"\\/static\\/data\\/dress\\/34\\/cfe1c03a1453f998cb777b1c56a01814.jpg\"]', '[]', '/static/data/dress/49/8ec2f42685373e5710e602e6e0327f5f.png', '/static/data/dress/58/1b4dfb43af02980dfcf84f8d25574080.png', '1482919881');
INSERT INTO `vender_dress_match` VALUES ('13', '1', '流苏3', '169', null, '0', '[\"\\/static\\/data\\/dress\\/43\\/2e05d3b453982ca5eb1c1b8e8576f1ae.jpg\"]', '[]', '/static/data/dress/10/ab0a0abe6afce8c06d5a7939502d39be.png', '/static/data/dress/20/36dfdbc5c8632cf26bc51b3ab49713d9.png', '1482920195');
INSERT INTO `vender_dress_match` VALUES ('16', '1', '纽扣3', '327', '0.00', '0', '[\"\\/static\\/data\\/dress\\/32\\/5eaf39bd9b86f6f2a08cff310092458d.jpg\"]', '[]', '', '', '1483079733');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote
-- ----------------------------
INSERT INTO `vote` VALUES ('18', '20', '98f13708210194c475687be6106a3b84', '双面顺毛毛呢大衣', '精选超顺滑双面顺毛毛呢，经典大翻领搭配超长修身下摆，让你成为万众焦点', '113', '双面顺毛毛呢', '[\"M\",\"S\"]', '2017-2-5', '[\"\\/static\\/data\\/advertisement_position_img\\/0b5bfa17f8d1ebe720abed0cb97b15f7.jpg\"]', '1483950925');

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_record
-- ----------------------------
INSERT INTO `vote_record` VALUES ('2', '3', 'c4ca4238a0b923820dcc509a6f75849b', '1477879775');
INSERT INTO `vote_record` VALUES ('3', '3', 'c81e728d9d4c2f636f067f89cc14862c', '1477896980');
INSERT INTO `vote_record` VALUES ('4', '5', '1679091c5a880faf6fb5e6087eb1b2dc', '1477968569');
INSERT INTO `vote_record` VALUES ('5', '5', 'c4ca4238a0b923820dcc509a6f75849b', '1477985434');
INSERT INTO `vote_record` VALUES ('6', '5', '45c48cce2e2d7fbdea1afc51c7c6ad26', '1477985991');
INSERT INTO `vote_record` VALUES ('7', '3', '45c48cce2e2d7fbdea1afc51c7c6ad26', '1478189773');
INSERT INTO `vote_record` VALUES ('8', '10', 'c4ca4238a0b923820dcc509a6f75849b', '1478397136');
INSERT INTO `vote_record` VALUES ('9', '3', 'c20ad4d76fe97759aa27a0c99bff6710', '1478592478');
INSERT INTO `vote_record` VALUES ('10', '4', '45c48cce2e2d7fbdea1afc51c7c6ad26', '1478595020');
INSERT INTO `vote_record` VALUES ('11', '7', 'c20ad4d76fe97759aa27a0c99bff6710', '1478747677');
INSERT INTO `vote_record` VALUES ('12', '7', '45c48cce2e2d7fbdea1afc51c7c6ad26', '1478747734');
INSERT INTO `vote_record` VALUES ('13', '4', 'c51ce410c124a10e0db5e4b97fc2af39', '1479191409');
INSERT INTO `vote_record` VALUES ('14', '7', 'c51ce410c124a10e0db5e4b97fc2af39', '1479290682');
INSERT INTO `vote_record` VALUES ('15', '7', 'aab3238922bcc25a6f606eb525ffdc56', '1479293095');
INSERT INTO `vote_record` VALUES ('16', '7', '9bf31c7ff062936a96d3c8bd1f8f2ff3', '1479370889');
INSERT INTO `vote_record` VALUES ('17', '7', 'c74d97b01eae257e44aa9d5bade97baf', '1479372568');
INSERT INTO `vote_record` VALUES ('18', '3', 'c51ce410c124a10e0db5e4b97fc2af39', '1479372862');
INSERT INTO `vote_record` VALUES ('19', '3', 'c74d97b01eae257e44aa9d5bade97baf', '1479393404');
INSERT INTO `vote_record` VALUES ('20', '11', 'c51ce410c124a10e0db5e4b97fc2af39', '1479433991');
INSERT INTO `vote_record` VALUES ('21', '3', 'aab3238922bcc25a6f606eb525ffdc56', '1479449342');
INSERT INTO `vote_record` VALUES ('22', '3', '70efdf2ec9b086079795c442636b55fb', '1479564911');
INSERT INTO `vote_record` VALUES ('23', '4', '70efdf2ec9b086079795c442636b55fb', '1479565436');
INSERT INTO `vote_record` VALUES ('24', '4', 'c74d97b01eae257e44aa9d5bade97baf', '1479622711');
INSERT INTO `vote_record` VALUES ('25', '7', '70efdf2ec9b086079795c442636b55fb', '1479651032');
INSERT INTO `vote_record` VALUES ('26', '9', 'c74d97b01eae257e44aa9d5bade97baf', '1479691346');
INSERT INTO `vote_record` VALUES ('27', '9', '70efdf2ec9b086079795c442636b55fb', '1480908080');
INSERT INTO `vote_record` VALUES ('28', '13', 'c74d97b01eae257e44aa9d5bade97baf', '1482600594');
INSERT INTO `vote_record` VALUES ('29', '16', '98f13708210194c475687be6106a3b84', '1484575382');
INSERT INTO `vote_record` VALUES ('30', '9', '98f13708210194c475687be6106a3b84', '1484838437');
INSERT INTO `vote_record` VALUES ('31', '17', '98f13708210194c475687be6106a3b84', '1485005397');
