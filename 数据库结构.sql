/*
 Navicat Premium Data Transfer

 Source Server         : bdm279970694_db
 Source Server Type    : MySQL
 Source Server Version : 50173
 Source Host           : bdm279970694.my3w.com
 Source Database       : bdm279970694_db

 Target Server Type    : MySQL
 Target Server Version : 50173
 File Encoding         : utf-8

 Date: 10/15/2017 10:57:32 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `dynamic`
-- ----------------------------
DROP TABLE IF EXISTS `dynamic`;
CREATE TABLE `dynamic` (
  `dynamic_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `content` varchar(255) NOT NULL COMMENT '动态内容',
  `dy_create_time` int(11) NOT NULL COMMENT '动态创建时间',
  `dy_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dynamic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `dynamic`
-- ----------------------------
BEGIN;
INSERT INTO `dynamic` VALUES ('4', '3', '你好啊，漏网！', '1494158159', ''), ('6', '3', '上面可以预览你动态发布后的样子\nHello World!', '1494168095', ''), ('7', '3', '上面可以预览你动态发布后的样子\nHello World !\n你看确实很简陋吧。', '1494168360', ''), ('8', '3', '对，简陋到头像都没有，是不是很惨？_(:з」∠)_', '1494168420', ''), ('9', '3', '第一個方式需要使用者自行安裝這些外掛程式，其實不是很方便。第二個方式要改的還不少，而且沒辦法直接使用到 blog, wiki 與 forum 上面。所以決定採用第三種方式，因為唯一的修改就是改模版。', '1494244547', ''), ('10', '3', 'sdfsdfsd fsd fsdf sdf sf sf dfknsdkndsgkjnfdsgkjndsgkjndfskjgnksnd kjsnd kjnfskjf dkfh kdsh ks fkjsn fjksdfn sdjfk sdfkj nsdf sdfshkjfkjehskhdfkjshekjfhskjhfkjdhfkdshfkjshfkjsdhfkjsdf', '1494244957', ''), ('11', '3', '近四年上岛咖啡肯定会打开建设规划都发生过还是尽快更换说得更好是国家或地方公司的后果大风过后但口感好低空飞过第三个烤红薯但口感都是分开过豆腐口感好但宽松复古豆腐空间感大风过大风过后大风过大风过的开发机构低空飞过快说得更好受理的更好时代感第三个， 的山高水低和i 如何过是大风过后谁都看过时光', '1494245156', ''), ('12', '3', '你好啊！大家是不是被抓饼只能自己在家中班手机相机下班说你小鸡小鸡小鸡小鸡行不行下决心那些\n大家学驾照', '1494245329', ''), ('13', '4', '天气不错啊！不错个屁啊！\n讨厌下雨天！', '1494251059', ''), ('14', '4', '为什么手机要点两次才变色啊？？？？？', '1494253250', ''), ('15', '4', '虫儿飞', '1494256879', ''), ('16', '3', '你好啊', '1494294643', ''), ('17', '3', '终于可以上传图片啦', '1494328284', 'FuMaFL1_7YlsQRQgoG43Ovu_x-hW.jpeg'), ('18', '3', '123', '1494329702', ''), ('19', '3', '上传图片试试', '1494423851', 'Fn8OwcXF8nM6A4ExycEGIxSHzsLT.jpg'), ('20', '5', 'niho asdasdasd', '1494425173', 'FrnRkuGqG0olcpdEsNiExXSYwgK7.png'), ('21', '6', '123', '1494429721', '');
COMMIT;

-- ----------------------------
--  Table structure for `reply`
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `count` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_id` int(11) NOT NULL COMMENT '动态id',
  `reply_user_id` int(11) NOT NULL COMMENT '回复的用户的id',
  `reply_content` varchar(255) NOT NULL COMMENT '回复内容',
  `re_create_time` int(11) NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`count`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `nick_name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `email` varchar(255) NOT NULL COMMENT '用户邮箱',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `create_time` int(11) NOT NULL COMMENT '用户创建时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('3', 'CHEN', '719149964@qq.com', 'fcea920f7412b5da7be0cf42b8c93759', '1494127809'), ('4', '空心', 'evollyone@outlook.com', 'fcea920f7412b5da7be0cf42b8c93759', '0'), ('5', 'test', '123@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '0'), ('6', '123', '333@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '1494429705');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
