/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : de_jade

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-26 18:36:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for c2_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `c2_auth_assignment`;
CREATE TABLE `c2_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `c2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of c2_auth_assignment
-- ----------------------------
INSERT INTO `c2_auth_assignment` VALUES ('P_CRM', '2', '1494992704');
INSERT INTO `c2_auth_assignment` VALUES ('P_Sales', '2', '1494988087');
INSERT INTO `c2_auth_assignment` VALUES ('客服', '3', '1494809730');
INSERT INTO `c2_auth_assignment` VALUES ('系统管理员', '1', '1494988059');

-- ----------------------------
-- Table structure for c2_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `c2_auth_item`;
CREATE TABLE `c2_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `c2_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `c2_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of c2_auth_item
-- ----------------------------
INSERT INTO `c2_auth_item` VALUES ('P_Api', '2', 'api 接口访问', null, null, '1495683273', '1495683273');
INSERT INTO `c2_auth_item` VALUES ('P_CRM', '2', 'CRM 客户关系管理', null, null, '1481702351', '1494981130');
INSERT INTO `c2_auth_item` VALUES ('P_Logistics', '2', '后勤资料管理', null, null, '1495506790', '1495506790');
INSERT INTO `c2_auth_item` VALUES ('P_Sales', '2', 'Sales 销售管理', null, null, '1481702395', '1494981201');
INSERT INTO `c2_auth_item` VALUES ('P_Statistics', '2', 'Statistics 统计', null, null, '1494981273', '1494981273');
INSERT INTO `c2_auth_item` VALUES ('P_System', '2', 'System 系统配置', null, null, '1494981539', '1494981539');
INSERT INTO `c2_auth_item` VALUES ('客服', '1', '', null, null, '1494809711', '1495506881');
INSERT INTO `c2_auth_item` VALUES ('系统管理员', '1', '', null, null, '1481702421', '1495683288');
INSERT INTO `c2_auth_item` VALUES ('经理', '1', '', null, null, '1494987655', '1495506856');

-- ----------------------------
-- Table structure for c2_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `c2_auth_item_child`;
CREATE TABLE `c2_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `c2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `c2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of c2_auth_item_child
-- ----------------------------
INSERT INTO `c2_auth_item_child` VALUES ('客服', 'P_CRM');
INSERT INTO `c2_auth_item_child` VALUES ('客服', 'P_Logistics');
INSERT INTO `c2_auth_item_child` VALUES ('客服', 'P_Sales');
INSERT INTO `c2_auth_item_child` VALUES ('系统管理员', 'P_Api');
INSERT INTO `c2_auth_item_child` VALUES ('系统管理员', 'P_System');
INSERT INTO `c2_auth_item_child` VALUES ('系统管理员', '客服');
INSERT INTO `c2_auth_item_child` VALUES ('系统管理员', '经理');
INSERT INTO `c2_auth_item_child` VALUES ('经理', 'P_CRM');
INSERT INTO `c2_auth_item_child` VALUES ('经理', 'P_Logistics');
INSERT INTO `c2_auth_item_child` VALUES ('经理', 'P_Sales');
INSERT INTO `c2_auth_item_child` VALUES ('经理', 'P_Statistics');
INSERT INTO `c2_auth_item_child` VALUES ('经理', '客服');

-- ----------------------------
-- Table structure for c2_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `c2_auth_rule`;
CREATE TABLE `c2_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of c2_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for c2_be_user
-- ----------------------------
DROP TABLE IF EXISTS `c2_be_user`;
CREATE TABLE `c2_be_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `attributeset_id` bigint(20) DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `registration_ip` varchar(255) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `open_id` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`username`),
  KEY `Index_2` (`email`),
  KEY `Index_3` (`type`),
  KEY `Index_4` (`open_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_be_user
-- ----------------------------
INSERT INTO `c2_be_user` VALUES ('1', '0', '0', 'admin', 'admin@zdt6.com', '$2y$10$L2ELm8yMYvl2429Id0M1u.g0l1lCnOyGIcYY.26T.k91y5RsWkyv.', 'wh3xjpD0cazZIwLEDNK785pe54bG6Dm1', '0000-00-00 00:00:00', null, null, '127.0.0.1', '0', '2019-03-25 10:35:02', null, null, '0', '0', '1', '0', '2017-01-25 11:01:00', '2017-05-17 05:42:02');
INSERT INTO `c2_be_user` VALUES ('2', '0', '0', 'tester1', 'tester1@zdt6.com', '$2y$10$QDFHh.AvjI7RnBmBnHNavOmw/H2cRSt69s0SIe9l4oGy0.03Rvkt.', 'T1yk3EUV6Qf4KwVz7jJspdR5PiX3F8yk', '0000-00-00 00:00:00', null, null, '127.0.0.1', null, '2017-05-18 03:25:05', null, null, '0', '0', '1', '0', '0000-00-00 00:00:00', '2017-05-17 05:43:39');
INSERT INTO `c2_be_user` VALUES ('3', '0', '0', 'tester2', 'tester2@zdt6.com', '$2y$10$F3fC9b1cgSJZ/LzG1451Su2s3NkPYs8jDM/p0A9iur.vBX2BPDSti', 'fgm17RciIC0qaCAiF6lj8s7DX07A_con', '0000-00-00 00:00:00', null, null, '127.0.0.1', null, null, null, null, '0', '0', '1', '0', '2017-05-16 12:07:01', '2017-05-24 03:41:30');

-- ----------------------------
-- Table structure for c2_be_user_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_be_user_profile`;
CREATE TABLE `c2_be_user_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  `timezone` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `terms` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_be_user_profile
-- ----------------------------
INSERT INTO `c2_be_user_profile` VALUES ('1', '1', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', null, 'Bi', 'Ben', '2017-06-01 00:00:00', 'ASGOWptT-UWl57arDgUEtNDvrSm3ZFhJ.jpg', '0', '1', '0', null, null);
INSERT INTO `c2_be_user_profile` VALUES ('2', '2', 'test1', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', null, 'Firstname', 'Lastname', '2017-05-28 00:00:00', 'yHC5IkHVVhfDAnVaapt43tNc1pZuluOb.jpg', '0', '1', '0', null, null);
INSERT INTO `c2_be_user_profile` VALUES ('3', '3', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '0', null, null);

-- ----------------------------
-- Table structure for c2_chess
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess`;
CREATE TABLE `c2_chess` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `lv6_id` bigint(20) DEFAULT '0',
  `lv5_id` bigint(20) DEFAULT '0',
  `lv4_id` bigint(20) DEFAULT NULL,
  `attributeset_id` bigint(20) DEFAULT '0',
  `province_id` bigint(20) DEFAULT '0',
  `city_id` bigint(20) DEFAULT '0',
  `district_id` bigint(20) DEFAULT '0',
  `code` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `biz_registration_number` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `product_style` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `open_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `wechat_open_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `geo_longitude` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `geo_latitude` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `geo_marker_color` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`geo_latitude`(191),`geo_longitude`(191)),
  KEY `Index_2` (`label`(191)),
  KEY `Index_3` (`lv6_id`,`type`),
  KEY `Index_4` (`lv4_id`),
  KEY `Index_5` (`wechat_open_id`(191)),
  KEY `Index_6` (`lv5_id`),
  KEY `Index_7` (`province_id`,`city_id`,`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_chess
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_lv1_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_lv1_rs`;
CREATE TABLE `c2_chess_lv1_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `lv4_id` bigint(20) DEFAULT '0',
  `lv1_type` tinyint(4) DEFAULT '0',
  `lv1_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`lv1_id`),
  KEY `Index_3` (`lv4_id`),
  KEY `Index_4` (`lv1_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_chess_lv1_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_lv2_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_lv2_rs`;
CREATE TABLE `c2_chess_lv2_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `lv4_id` bigint(20) DEFAULT '0',
  `lv2_type` tinyint(4) DEFAULT '0',
  `lv2_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`lv2_id`),
  KEY `Index_3` (`lv4_id`),
  KEY `Index_4` (`lv2_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_chess_lv2_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_lv3_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_lv3_rs`;
CREATE TABLE `c2_chess_lv3_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `lv4_id` bigint(20) DEFAULT '0',
  `lv3_type` tinyint(4) DEFAULT '0',
  `lv3_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`lv3_id`),
  KEY `Index_3` (`lv4_id`),
  KEY `Index_4` (`lv3_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_chess_lv3_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_profile`;
CREATE TABLE `c2_chess_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `wechat_number` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `gravatar_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `bio` text COLLATE utf8mb4_bin,
  `timezone` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `terms` tinyint(4) DEFAULT '0',
  `qr_code` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `qr_code_image` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_chess_profile
-- ----------------------------

-- ----------------------------
-- Table structure for c2_city
-- ----------------------------
DROP TABLE IF EXISTS `c2_city`;
CREATE TABLE `c2_city` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` char(35) COLLATE utf8mb4_bin DEFAULT NULL,
  `country_code` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `district` char(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`name`),
  KEY `Index_2` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_city
-- ----------------------------

-- ----------------------------
-- Table structure for c2_config
-- ----------------------------
DROP TABLE IF EXISTS `c2_config`;
CREATE TABLE `c2_config` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `default_value` text,
  `custom_value` text,
  `memo` tinytext,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`code`),
  KEY `Index_2` (`label`),
  KEY `Index_3` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_config
-- ----------------------------
INSERT INTO `c2_config` VALUES ('1', '1', 'frontend\\url', '前台URL', '', '', '', '1', '1', '1', '0', '2017-05-19 10:40:59', '2017-05-20 11:02:34');
INSERT INTO `c2_config` VALUES ('27', '1', 'general\\locale', 'Locale', null, 'a', null, '1', '1', '1', '0', '2017-05-20 11:30:31', '2017-05-20 11:30:48');
INSERT INTO `c2_config` VALUES ('28', '1', 'general\\locale_language', 'Locale Language', 'zh-CN', '', null, '1', '1', '1', '0', '2017-05-20 11:30:31', '2017-05-20 11:30:48');
INSERT INTO `c2_config` VALUES ('29', '1', 'general\\locale_currency', 'Locale Currency', null, 'c', null, '1', '1', '1', '0', '2017-05-20 11:30:31', '2017-05-20 11:30:48');
INSERT INTO `c2_config` VALUES ('30', '1', 'perf\\cache_enable', 'Cache Enable', null, '1', null, '1', '1', '1', '0', '2017-05-20 11:31:10', '2017-05-26 16:11:00');
INSERT INTO `c2_config` VALUES ('31', '1', 'perf\\cache_duration', 'Cache Duration', null, '5', null, '1', '1', '1', '0', '2017-05-20 11:31:10', '2017-05-26 16:28:41');
INSERT INTO `c2_config` VALUES ('32', '1', 'wechat\\id', 'Id', null, null, null, '1', '1', '1', '0', '2017-05-26 10:48:51', '2017-05-26 10:48:51');
INSERT INTO `c2_config` VALUES ('33', '1', 'wechat\\apply_merchant_qrcode', 'Apply Merchant Qrcode', null, 'http://fe-apollo-pre.bulletelc.com/site/merchant-form', null, '1', '1', '1', '0', '2017-05-26 10:48:51', '2017-05-29 02:24:19');
INSERT INTO `c2_config` VALUES ('34', '1', 'wechat\\apply_merchant_qrcode_image', '店长申请二维码', null, 'apply_merchant_qrcode20.png', null, '1', '1', '1', '0', '2017-05-26 10:48:51', '2017-05-29 02:24:19');
INSERT INTO `c2_config` VALUES ('35', '0', 'point', '积分', '10', '20', '', '1', '1', '1', '0', '2019-03-25 11:04:27', '2019-03-25 11:04:27');
INSERT INTO `c2_config` VALUES ('37', '0', '123', '123', '123', '123', '123', '1', '1', '1', '0', '2019-03-25 11:05:15', '2019-03-25 11:05:15');
INSERT INTO `c2_config` VALUES ('38', '0', '123', '123', '123', '123', '123', '1', '1', '1', '0', '2019-03-25 11:05:15', '2019-03-25 11:05:15');
INSERT INTO `c2_config` VALUES ('39', '0', '123', '123', '123', '123', '123', '1', '1', '1', '0', '2019-03-25 11:05:15', '2019-03-25 11:05:15');

-- ----------------------------
-- Table structure for c2_country
-- ----------------------------
DROP TABLE IF EXISTS `c2_country`;
CREATE TABLE `c2_country` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `name` char(52) COLLATE utf8mb4_bin DEFAULT NULL,
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') COLLATE utf8mb4_bin DEFAULT NULL,
  `region` char(26) COLLATE utf8mb4_bin DEFAULT NULL,
  `surface_area` float(10,2) DEFAULT NULL,
  `indep_year` smallint(6) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `life_expectancy` float(3,1) DEFAULT NULL,
  `gnp_old` float(10,2) DEFAULT NULL,
  `local_name` char(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `government_form` char(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `head_of_state` char(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `capital` int(11) DEFAULT NULL,
  `code2` char(2) COLLATE utf8mb4_bin DEFAULT NULL,
  `gnp` float(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`code`),
  KEY `Index_2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_country
-- ----------------------------

-- ----------------------------
-- Table structure for c2_country_language
-- ----------------------------
DROP TABLE IF EXISTS `c2_country_language`;
CREATE TABLE `c2_country_language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_code` char(3) COLLATE utf8mb4_bin DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_official` enum('T','F') COLLATE utf8mb4_bin DEFAULT NULL,
  `percentage` float(4,1) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`country_code`),
  KEY `Index_2` (`language`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_country_language
-- ----------------------------

-- ----------------------------
-- Table structure for c2_entity_attachment
-- ----------------------------
DROP TABLE IF EXISTS `c2_entity_attachment`;
CREATE TABLE `c2_entity_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entity_id` bigint(20) DEFAULT '0',
  `entity_class` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `entity_attribute` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `content` text COLLATE utf8mb4_bin,
  `hash` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `mime_type` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `logic_path` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`entity_id`,`entity_class`(191),`entity_attribute`(191),`type`),
  KEY `Index_2` (`entity_class`(191),`type`),
  KEY `Index_3` (`hash`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_entity_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for c2_fe_user
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user`;
CREATE TABLE `c2_fe_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `attributeset_id` bigint(20) DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `registration_ip` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_src_type` tinyint(4) DEFAULT '100',
  `flags` int(11) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `open_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `wechat_union_id` char(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `wechat_open_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `sms_receipt` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `province_id` bigint(20) DEFAULT '0',
  `city_id` bigint(20) DEFAULT '0',
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`username`(191)),
  KEY `Index_2` (`email`(191)),
  KEY `Index_3` (`type`),
  KEY `Index_4` (`open_id`(191)),
  KEY `Index_5` (`wechat_open_id`(191)),
  KEY `Index_6` (`access_token`(191),`status`),
  KEY `Index_7` (`mobile_number`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_fe_user
-- ----------------------------

-- ----------------------------
-- Table structure for c2_fe_user_auth
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user_auth`;
CREATE TABLE `c2_fe_user_auth` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `source_id` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`source`(191)),
  KEY `Index_2` (`user_id`,`source_id`(191),`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_fe_user_auth
-- ----------------------------

-- ----------------------------
-- Table structure for c2_fe_user_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user_profile`;
CREATE TABLE `c2_fe_user_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `wechat_number` char(10) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  `timezone` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `terms` tinyint(4) DEFAULT '0',
  `qr_code` varchar(255) DEFAULT NULL,
  `qr_code_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_fe_user_profile
-- ----------------------------
INSERT INTO `c2_fe_user_profile` VALUES ('2', '2', 'merchant1', null, 'merchant1@test.com', '', '全球个人ID', '', '', '', '', '', '', null, 'zTg--oW9VqxBVIC7_arflyTPHmf21eiY.jpg', '0', '', '', '1', '0', '2017-05-19 04:17:45', '2017-05-24 10:39:56');
INSERT INTO `c2_fe_user_profile` VALUES ('13', '13', 'merchant2', null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 08:24:17', '2017-05-22 08:24:17');
INSERT INTO `c2_fe_user_profile` VALUES ('14', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 08:35:22', '2017-05-22 08:35:22');
INSERT INTO `c2_fe_user_profile` VALUES ('15', '14', '', null, '', '', '', '', '', '', '', '', '', null, '4ajOYuFSBBOm6VXhIF1eOewshhepDZM8.jpg', '0', '', '', '1', '0', '2017-05-22 08:48:12', '2017-05-22 08:48:26');
INSERT INTO `c2_fe_user_profile` VALUES ('17', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 08:58:25', '2017-05-22 08:58:25');
INSERT INTO `c2_fe_user_profile` VALUES ('18', '16', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 09:08:49', '2017-05-22 09:08:49');
INSERT INTO `c2_fe_user_profile` VALUES ('19', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 09:09:46', '2017-05-22 09:09:46');
INSERT INTO `c2_fe_user_profile` VALUES ('20', '17', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-22 09:35:00', '2017-05-22 09:35:00');
INSERT INTO `c2_fe_user_profile` VALUES ('21', '18', '', null, '', '', '', '', '', '', '', '', '', null, 'e58DzrrYFD73PP1QSX7oiXTlJ8QhfrMk.jpg', '0', 'http://fe-apollo-pre.local.bulletelc.com/site/port?sid=18&a=addCustomer', 'he6qg7Em.png', '1', '0', '2017-05-22 11:12:54', '2017-05-22 11:13:16');
INSERT INTO `c2_fe_user_profile` VALUES ('22', '19', '', null, '', '', '', '', '', '', '', '张', '一千', null, '37OUGeuKMh_YLSxyBR4z3APORe1tsRje.jpg', '0', 'http://fe-apollo-pre.local.bulletelc.com/api/port?mn=&uid=19&woid=&a=user_info', 'KHtzk6L9.png', '1', '0', '2017-05-22 11:32:05', '2017-05-22 12:00:33');
INSERT INTO `c2_fe_user_profile` VALUES ('23', '20', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-23 04:11:17', '2017-05-23 04:11:17');
INSERT INTO `c2_fe_user_profile` VALUES ('24', '21', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-23 08:18:52', '2017-05-23 08:18:52');
INSERT INTO `c2_fe_user_profile` VALUES ('26', '23', '毕随影', null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-27 08:47:12', '2017-05-27 08:47:12');
INSERT INTO `c2_fe_user_profile` VALUES ('27', '24', '毕随影', null, null, null, null, null, null, null, null, null, null, null, null, '0', '', '', '1', '0', '2017-05-27 08:55:35', '2017-05-27 08:55:36');

-- ----------------------------
-- Table structure for c2_lv2_lv1_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lv2_lv1_rs`;
CREATE TABLE `c2_lv2_lv1_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lv2_id` bigint(20) DEFAULT '0',
  `lv1_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lv2_id`),
  KEY `Index_2` (`lv1_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_lv2_lv1_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_lv3_lv2_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lv3_lv2_rs`;
CREATE TABLE `c2_lv3_lv2_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lv3_id` bigint(20) DEFAULT '0',
  `lv2_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lv3_id`),
  KEY `Index_2` (`lv2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_lv3_lv2_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_lv4_lv3_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lv4_lv3_rs`;
CREATE TABLE `c2_lv4_lv3_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lv4_id` bigint(20) DEFAULT '0',
  `lv3_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lv4_id`),
  KEY `Index_2` (`lv3_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_lv4_lv3_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_lv5_lv4_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lv5_lv4_rs`;
CREATE TABLE `c2_lv5_lv4_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lv5_id` bigint(20) DEFAULT '0',
  `lv4_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lv5_id`),
  KEY `Index_2` (`lv4_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_lv5_lv4_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_lv6_lv5_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lv6_lv5_rs`;
CREATE TABLE `c2_lv6_lv5_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lv6_id` bigint(20) DEFAULT '0',
  `lv5_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lv6_id`),
  KEY `Index_2` (`lv5_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_lv6_lv5_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_migration
-- ----------------------------
DROP TABLE IF EXISTS `c2_migration`;
CREATE TABLE `c2_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_migration
-- ----------------------------
INSERT INTO `c2_migration` VALUES ('m000000_000000_base', '1495179023');

-- ----------------------------
-- Table structure for c2_region
-- ----------------------------
DROP TABLE IF EXISTS `c2_region`;
CREATE TABLE `c2_region` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`label`),
  KEY `Index_2` (`code`),
  KEY `Index_3` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_region
-- ----------------------------
INSERT INTO `c2_region` VALUES ('1', 'R0001', '中山', '1', '0', '2017-05-23 04:47:44', '2017-05-23 05:05:20');

-- ----------------------------
-- Table structure for c2_region_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_region_rs`;
CREATE TABLE `c2_region_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `child_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`parent_id`),
  KEY `Index_2` (`child_id`),
  KEY `Index_3` (`parent_id`,`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- ----------------------------
-- Records of c2_region_rs
-- ----------------------------
