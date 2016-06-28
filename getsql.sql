/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : getsql

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-06-27 19:22:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for apply
-- ----------------------------
DROP TABLE IF EXISTS `apply`;
CREATE TABLE `apply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `apply_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of apply
-- ----------------------------
INSERT INTO `apply` VALUES ('1', '通用');
INSERT INTO `apply` VALUES ('2', '电子商务');
INSERT INTO `apply` VALUES ('3', '在线教育');
INSERT INTO `apply` VALUES ('4', '旅游社交');
INSERT INTO `apply` VALUES ('5', '互联网金融');
INSERT INTO `apply` VALUES ('6', '体育健身');
INSERT INTO `apply` VALUES ('7', '教育培训');

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '课程id',
  `list_name` varchar(20) NOT NULL COMMENT '分类名称',
  `course_name` varchar(20) NOT NULL COMMENT '课程名称',
  `course_photo` varchar(255) NOT NULL COMMENT '课程展图',
  `course_intro` varchar(500) NOT NULL COMMENT '课程简介',
  `course_price` int(6) NOT NULL COMMENT '价格',
  `teach_name` varchar(20) NOT NULL COMMENT '老师名称',
  `teach_mobi` varchar(11) NOT NULL COMMENT '老师手机',
  `teach_add` char(100) NOT NULL COMMENT '老师地址',
  `teach_intro` varchar(500) NOT NULL COMMENT '老师简介',
  `parent_id` int(10) NOT NULL COMMENT '父级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of course
-- ----------------------------

-- ----------------------------
-- Table structure for datatype
-- ----------------------------
DROP TABLE IF EXISTS `datatype`;
CREATE TABLE `datatype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of datatype
-- ----------------------------
INSERT INTO `datatype` VALUES ('1', 'int');
INSERT INTO `datatype` VALUES ('2', 'tinyint');
INSERT INTO `datatype` VALUES ('3', 'smallint');
INSERT INTO `datatype` VALUES ('4', 'bigint');
INSERT INTO `datatype` VALUES ('5', 'char');
INSERT INTO `datatype` VALUES ('6', 'varchar');
INSERT INTO `datatype` VALUES ('7', 'text');
INSERT INTO `datatype` VALUES ('8', 'datetime');
INSERT INTO `datatype` VALUES ('9', 'timestamp');

-- ----------------------------
-- Table structure for field
-- ----------------------------
DROP TABLE IF EXISTS `field`;
CREATE TABLE `field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `leng` varchar(20) DEFAULT NULL,
  `default` varchar(20) DEFAULT NULL,
  `null` int(1) DEFAULT NULL,
  `addself` int(1) DEFAULT NULL,
  `majorkey` int(1) DEFAULT NULL,
  `explain` varchar(30) DEFAULT NULL,
  `table_id` int(10) DEFAULT NULL,
  `field_en` varchar(30) DEFAULT NULL,
  `data_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of field
-- ----------------------------
INSERT INTO `field` VALUES ('1', '10', null, '0', '1', '1', '用户id', '1', 'id', '1');
INSERT INTO `field` VALUES ('2', '20', null, '0', '0', '0', '用户名', '1', 'username', '6');
INSERT INTO `field` VALUES ('3', '26', null, '0', '0', '0', '用户密码', '1', 'password', '6');
INSERT INTO `field` VALUES ('4', '11', null, '0', '0', '0', '用户手机', '1', 'user_mobi', '6');
INSERT INTO `field` VALUES ('5', '255', null, '0', '0', '0', '用户头像', '1', 'user_photo', '6');
INSERT INTO `field` VALUES ('6', '', null, '0', '0', '0', '注册时间', '1', 'logintime', '8');
INSERT INTO `field` VALUES ('7', '10', null, '0', '1', '1', '课程id', '2', 'id', '1');
INSERT INTO `field` VALUES ('8', '20', null, '0', '0', '0', '分类名称', '2', 'list_name', '6');
INSERT INTO `field` VALUES ('9', '20', null, '0', '0', '0', '课程名称', '2', 'course_name', '6');
INSERT INTO `field` VALUES ('10', '255', null, '0', '0', '0', '课程展图', '2', 'course_photo', '6');
INSERT INTO `field` VALUES ('11', '500', null, '0', '0', '0', '课程简介', '2', 'course_intro', '6');
INSERT INTO `field` VALUES ('12', '6', null, '0', '0', '0', '价格', '2', 'course_price', '1');
INSERT INTO `field` VALUES ('13', '20', null, '0', '0', '0', '老师名称', '2', 'teach_name', '6');
INSERT INTO `field` VALUES ('14', '11', null, '0', '0', '0', '老师手机', '2', 'teach_mobi', '6');
INSERT INTO `field` VALUES ('15', '100', null, '0', '0', '0', '老师地址', '2', 'teach_add', '5');
INSERT INTO `field` VALUES ('16', '500', null, '0', '0', '0', '老师简介', '2', 'teach_intro', '6');
INSERT INTO `field` VALUES ('17', '10', null, '0', '0', '0', '父级id', '2', 'parent_id', '1');
INSERT INTO `field` VALUES ('18', '10', null, '0', '1', '1', '课时id', '3', 'id', '1');
INSERT INTO `field` VALUES ('19', '30', null, '0', '0', '0', '课时名称', '3', 'class_name', '1');
INSERT INTO `field` VALUES ('20', '15', null, '0', '0', '0', '上课时间', '3', 'class_time', '10');
INSERT INTO `field` VALUES ('21', '500', null, '0', '0', '0', '上课地点', '3', 'class_add', '10');
INSERT INTO `field` VALUES ('22', '10', null, '0', '0', '0', '课程id', '3', 'course_id', '1');
INSERT INTO `field` VALUES ('23', '30', null, '0', '0', '0', '课时长', '3', 'class_mins', '10');
INSERT INTO `field` VALUES ('24', '10', null, '0', '1', '1', '订单id', '4', 'id', '1');
INSERT INTO `field` VALUES ('25', '20', null, '0', '0', '0', '购买人', '4', 'ordera_name', '10');
INSERT INTO `field` VALUES ('26', '11', null, '0', '0', '0', '联系方式', '4', 'ordera_mobi', '10');
INSERT INTO `field` VALUES ('27', '10', null, '0', '0', '0', '用户id', '4', 'users_id', '1');
INSERT INTO `field` VALUES ('28', '10', null, '0', '0', '0', '课程id', '4', 'course_id', '1');
INSERT INTO `field` VALUES ('29', '11', null, '0', '0', '0', '订单时间', '4', 'order_time', '19');
INSERT INTO `field` VALUES ('30', '10', null, '0', '1', '1', '大图id', '5', 'id', '1');
INSERT INTO `field` VALUES ('31', '10', null, '0', '0', '0', '课程id', '5', 'course_id', '1');
INSERT INTO `field` VALUES ('32', '255', null, '0', '0', '0', '图片路径', '5', 'bigpho_url', '10');

-- ----------------------------
-- Table structure for sahg
-- ----------------------------
DROP TABLE IF EXISTS `sahg`;
CREATE TABLE `sahg` (
  `dsaf` int(20) NOT NULL,
  `ret` tinyint(20) NOT NULL DEFAULT '0',
  `rht` int(10) NOT NULL,
  `hgfh` int(20) NOT NULL DEFAULT '10',
  `ettrg` int(23) NOT NULL DEFAULT '4',
  `wer` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`wer`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of sahg
-- ----------------------------

-- ----------------------------
-- Table structure for table
-- ----------------------------
DROP TABLE IF EXISTS `table`;
CREATE TABLE `table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(30) DEFAULT NULL,
  `name_zh` varchar(30) DEFAULT NULL,
  `apply_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of table
-- ----------------------------
INSERT INTO `table` VALUES ('1', 'users', '用户表', '1');
INSERT INTO `table` VALUES ('2', 'course', '课程表', '1');
INSERT INTO `table` VALUES ('3', 'class', '课时表', '1');
INSERT INTO `table` VALUES ('4', 'ordera', '订单表', '1');
INSERT INTO `table` VALUES ('5', 'bigpho', '大图表', '1');
