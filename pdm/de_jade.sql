/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : de_jade

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-07 23:50:00
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
INSERT INTO `c2_auth_assignment` VALUES ('P_P3S', '1', '1553834079');
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
INSERT INTO `c2_auth_item` VALUES ('P_P3S', '2', 'P_P3S', null, null, '1553834067', '1553834067');
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
INSERT INTO `c2_be_user` VALUES ('1', '0', '0', 'admin', 'admin@zdt6.com', '$2y$10$L2ELm8yMYvl2429Id0M1u.g0l1lCnOyGIcYY.26T.k91y5RsWkyv.', 'wh3xjpD0cazZIwLEDNK785pe54bG6Dm1', '0000-00-00 00:00:00', null, null, '127.0.0.1', '0', '2019-04-07 08:39:07', null, null, '0', '0', '1', '0', '2017-01-25 11:01:00', '2017-05-17 05:42:02');
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
  `lord_id` bigint(20) DEFAULT '0',
  `elder_id` bigint(20) DEFAULT '0',
  `chieftain_id` bigint(20) DEFAULT NULL,
  `attributeset_id` bigint(20) DEFAULT '0',
  `province_id` bigint(20) DEFAULT '0',
  `city_id` bigint(20) DEFAULT '0',
  `district_id` bigint(20) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `biz_registration_number` varchar(255) DEFAULT NULL,
  `product_style` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `open_id` varchar(255) DEFAULT NULL,
  `wechat_open_id` varchar(255) DEFAULT NULL,
  `geo_longitude` varchar(255) DEFAULT NULL,
  `geo_latitude` varchar(255) DEFAULT NULL,
  `geo_marker_color` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`geo_latitude`(191),`geo_longitude`(191)),
  KEY `Index_2` (`label`(191)),
  KEY `Index_3` (`lord_id`,`type`),
  KEY `Index_4` (`chieftain_id`),
  KEY `Index_5` (`wechat_open_id`(191)),
  KEY `Index_6` (`elder_id`),
  KEY `Index_7` (`province_id`,`city_id`,`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chess
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_familiar_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_familiar_rs`;
CREATE TABLE `c2_chess_familiar_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `chieftain_id` bigint(20) DEFAULT '0',
  `familiar_type` tinyint(4) DEFAULT '0',
  `familiar_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`familiar_id`),
  KEY `Index_3` (`chieftain_id`),
  KEY `Index_4` (`familiar_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chess_familiar_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_master_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_master_rs`;
CREATE TABLE `c2_chess_master_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `chieftain_id` bigint(20) DEFAULT '0',
  `master_type` tinyint(4) DEFAULT '0',
  `master_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`master_id`),
  KEY `Index_3` (`chieftain_id`),
  KEY `Index_4` (`master_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chess_master_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_peasant_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_peasant_rs`;
CREATE TABLE `c2_chess_peasant_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '0',
  `chieftain_id` bigint(20) DEFAULT '0',
  `peasant_type` tinyint(4) DEFAULT '0',
  `peasant_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`),
  KEY `Index_2` (`peasant_id`),
  KEY `Index_3` (`chieftain_id`),
  KEY `Index_4` (`peasant_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chess_peasant_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chess_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_chess_profile`;
CREATE TABLE `c2_chess_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `wechat_number` char(10) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  `timezone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `terms` tinyint(4) DEFAULT '0',
  `qr_code` varchar(255) DEFAULT NULL,
  `qr_code_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chess_profile
-- ----------------------------

-- ----------------------------
-- Table structure for c2_chieftain_master_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_chieftain_master_rs`;
CREATE TABLE `c2_chieftain_master_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chieftain_id` bigint(20) DEFAULT '0',
  `master_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`chieftain_id`),
  KEY `Index_2` (`master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_chieftain_master_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_city
-- ----------------------------
DROP TABLE IF EXISTS `c2_city`;
CREATE TABLE `c2_city` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` char(35) DEFAULT NULL,
  `country_code` char(3) DEFAULT NULL,
  `district` char(20) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`name`),
  KEY `Index_2` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  KEY `Index_1` (`code`(191)),
  KEY `Index_2` (`label`(191)),
  KEY `Index_3` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_config
-- ----------------------------

-- ----------------------------
-- Table structure for c2_country
-- ----------------------------
DROP TABLE IF EXISTS `c2_country`;
CREATE TABLE `c2_country` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` char(3) DEFAULT NULL,
  `name` char(52) DEFAULT NULL,
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') DEFAULT NULL,
  `region` char(26) DEFAULT NULL,
  `surface_area` float(10,2) DEFAULT NULL,
  `indep_year` smallint(6) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `life_expectancy` float(3,1) DEFAULT NULL,
  `gnp_old` float(10,2) DEFAULT NULL,
  `local_name` char(45) DEFAULT NULL,
  `government_form` char(45) DEFAULT NULL,
  `head_of_state` char(60) DEFAULT NULL,
  `capital` int(11) DEFAULT NULL,
  `code2` char(2) DEFAULT NULL,
  `gnp` float(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`code`),
  KEY `Index_2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_country
-- ----------------------------

-- ----------------------------
-- Table structure for c2_country_language
-- ----------------------------
DROP TABLE IF EXISTS `c2_country_language`;
CREATE TABLE `c2_country_language` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_code` char(3) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `is_official` enum('T','F') DEFAULT NULL,
  `percentage` float(4,1) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`country_code`),
  KEY `Index_2` (`language`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_country_language
-- ----------------------------

-- ----------------------------
-- Table structure for c2_elder_chieftain_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_elder_chieftain_rs`;
CREATE TABLE `c2_elder_chieftain_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `elder_id` bigint(20) DEFAULT '0',
  `chieftain_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`elder_id`),
  KEY `Index_2` (`chieftain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_elder_chieftain_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_entity_attachment
-- ----------------------------
DROP TABLE IF EXISTS `c2_entity_attachment`;
CREATE TABLE `c2_entity_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entity_id` bigint(20) DEFAULT '0',
  `entity_class` varchar(255) DEFAULT NULL,
  `entity_attribute` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `content` text,
  `hash` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `mime_type` varchar(255) DEFAULT NULL,
  `logic_path` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`entity_id`,`entity_class`(191),`entity_attribute`(191),`type`),
  KEY `Index_2` (`entity_class`(191),`type`),
  KEY `Index_3` (`hash`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_entity_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for c2_familiar_peasant_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_familiar_peasant_rs`;
CREATE TABLE `c2_familiar_peasant_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `familiar_id` bigint(20) DEFAULT '0',
  `peasant_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`familiar_id`),
  KEY `Index_2` (`peasant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_familiar_peasant_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_fe_user
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user`;
CREATE TABLE `c2_fe_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `attributeset_id` bigint(20) DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `registration_ip` varchar(255) DEFAULT NULL,
  `registration_src_type` tinyint(4) DEFAULT '100',
  `flags` int(11) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `open_id` varchar(255) DEFAULT NULL,
  `wechat_union_id` char(10) DEFAULT NULL,
  `wechat_open_id` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `sms_receipt` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `district_id` bigint(20) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_fe_user
-- ----------------------------
INSERT INTO `c2_fe_user` VALUES ('1', '1', '0', 'xhun', null, '$2y$13$.1MFFGi/Mv0yWQ2fG74SNOCW/XGo/t.gc7KkVBhE.oIk6h654r1ZC', 'BQmZ4XFJtqtKciAhXla2bGR6PwqB4Nr8', null, null, null, null, '100', null, null, null, null, null, null, null, '15622965560', null, null, '0', null, '0', '0', '0', '0', '1', '0', '2019-04-07 15:31:26', '2019-04-07 15:31:26');
INSERT INTO `c2_fe_user` VALUES ('2', '0', '0', 'xun', null, '$2y$13$MXeCA0zAItfek.X5H2YhCeyJAv8QXRW/cO3OgVhzWTaKf6H69vWa.', 'JwbJW4n1JUb4_BjClzlAzOLSofwir_DQ', null, null, null, null, '100', null, null, null, null, null, null, null, '15622965561', null, null, '0', null, '0', '0', '0', '0', '1', '0', '2019-04-07 17:37:51', '2019-04-07 17:37:51');

-- ----------------------------
-- Table structure for c2_fe_user_auth
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user_auth`;
CREATE TABLE `c2_fe_user_auth` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `source_id` varchar(255) DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`source`(191)),
  KEY `Index_2` (`user_id`,`source_id`(191),`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `wechat_number` varchar(255) DEFAULT NULL,
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
  `id_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `terms` tinyint(4) DEFAULT '0',
  `qr_code` varchar(255) DEFAULT NULL,
  `qr_code_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_fe_user_profile
-- ----------------------------

-- ----------------------------
-- Table structure for c2_lord_elder_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_lord_elder_rs`;
CREATE TABLE `c2_lord_elder_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lord_id` bigint(20) DEFAULT '0',
  `elder_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lord_id`),
  KEY `Index_2` (`elder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_lord_elder_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_master_familiar_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_master_familiar_rs`;
CREATE TABLE `c2_master_familiar_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `master_id` bigint(20) DEFAULT '0',
  `familiar_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`master_id`),
  KEY `Index_2` (`familiar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_master_familiar_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_region
-- ----------------------------
DROP TABLE IF EXISTS `c2_region`;
CREATE TABLE `c2_region` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`type`,`label`(191)),
  KEY `Index_2` (`type`,`code`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_region
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_region_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_user_degree
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_degree`;
CREATE TABLE `c2_user_degree` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chess_id` bigint(20) DEFAULT '1',
  `type` tinyint(4) DEFAULT '0',
  `root` bigint(20) DEFAULT '0',
  `lft` bigint(20) DEFAULT '0',
  `rgt` bigint(20) DEFAULT '0',
  `lvl` int(11) DEFAULT '0',
  `selected` tinyint(4) DEFAULT '0',
  `readonly` tinyint(4) DEFAULT '0',
  `visible` tinyint(4) DEFAULT '0',
  `collapsed` tinyint(4) DEFAULT '0',
  `movable_u` tinyint(4) DEFAULT '1',
  `movable_d` tinyint(4) DEFAULT '1',
  `movable_l` tinyint(4) DEFAULT '1',
  `movable_r` tinyint(4) DEFAULT '1',
  `removable` tinyint(4) DEFAULT '1',
  `removable_all` tinyint(4) DEFAULT '1',
  `disabled` tinyint(4) DEFAULT '0',
  `active` tinyint(4) DEFAULT '1',
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `description` text,
  `icon` varchar(255) DEFAULT NULL,
  `icon_type` tinyint(4) DEFAULT '1',
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`lft`,`rgt`),
  KEY `Index_2` (`chess_id`),
  KEY `Index_3` (`lvl`),
  KEY `Index_4` (`type`),
  KEY `Index_5` (`code`(191)),
  KEY `Index_6` (`root`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_degree
-- ----------------------------

-- ----------------------------
-- Table structure for c2_user_degree_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_degree_rs`;
CREATE TABLE `c2_user_degree_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `degree_id` bigint(20) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`),
  KEY `Index_2` (`degree_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_degree_rs
-- ----------------------------
