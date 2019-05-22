/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : jade2.0

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-05-22 17:40:56
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
INSERT INTO `c2_auth_assignment` VALUES ('P_Logistics', '1', '1557714151');
INSERT INTO `c2_auth_assignment` VALUES ('P_P3S', '1', '1557714151');
INSERT INTO `c2_auth_assignment` VALUES ('P_Sales', '2', '1494988087');
INSERT INTO `c2_auth_assignment` VALUES ('P_System', '1', '1557714151');
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
INSERT INTO `c2_auth_item` VALUES ('P_P3S', '2', '', null, null, '1557713542', '1557713542');
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
INSERT INTO `c2_be_user` VALUES ('1', '0', '0', 'admin', 'admin@zdt6.com', '$2y$10$L2ELm8yMYvl2429Id0M1u.g0l1lCnOyGIcYY.26T.k91y5RsWkyv.', 'wh3xjpD0cazZIwLEDNK785pe54bG6Dm1', '0000-00-00 00:00:00', null, null, '127.0.0.1', '0', '2019-05-22 07:06:13', '127.0.0.1', null, '0', '0', '1', '0', '2017-01-25 11:01:00', '2017-05-17 05:42:02');
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
-- Table structure for c2_fe_user
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user`;
CREATE TABLE `c2_fe_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT '0',
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
  `password_reset_token` varchar(255) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_fe_user
-- ----------------------------
INSERT INTO `c2_fe_user` VALUES ('1', '0', '0', 'jerrygoC3', 'c3@qq.com', null, null, null, null, null, '127.0.0.1', '100', null, null, null, '', null, null, null, '15622965563', null, null, null, null, '0', '0', '1', '1', '1', '0', '2019-05-21 07:49:59', '2019-05-21 10:26:05');
INSERT INTO `c2_fe_user` VALUES ('2', '0', '0', 'jerrygoC1', 'c1@qq.com', null, null, null, null, null, '127.0.0.1', '100', null, null, null, '', null, null, null, '15622966561', null, null, null, null, '0', '0', '1', '1', '1', '0', '2019-05-21 10:21:22', '2019-05-21 10:25:54');
INSERT INTO `c2_fe_user` VALUES ('3', '0', '0', 'jerrygoC2', 'c2@qq.com', null, null, null, null, null, '127.0.0.1', '5', null, null, null, '', null, null, null, '1562296562', null, null, null, null, '0', '0', '1', '1', '1', '0', '2019-05-21 10:25:30', '2019-05-21 10:25:30');
INSERT INTO `c2_fe_user` VALUES ('4', '0', '0', 'jem', null, '$2y$13$Xen21rD9UXmTVmTz5IP9n.BSar7M9/x7ynNwIfyBHpJYxtj0dSbRK', '-oa4ky_qD85f6lG6QrNiaSJnixZ2IVtg', null, null, null, '127.0.0.1', '5', null, null, '2019-05-22 17:00:46', '127.0.0.1', null, null, null, '15622965564', null, null, null, null, '0', '0', null, '4', '1', '0', '2019-05-22 15:17:56', '2019-05-22 17:00:46');
INSERT INTO `c2_fe_user` VALUES ('5', '0', '0', 'jem1', null, '$2y$13$Z0cGtf5mktZyigl8.v8cxuBJ/TVj5Ph1lxGuYFzgcSNKQIhNYxjsS', 'pdzLYuH0iypNTv-lqRqwoosQK9Hwf45A', null, null, null, '127.0.0.1', '5', null, null, null, null, null, null, null, '15622965565', null, null, null, null, '0', '0', null, null, '1', '0', '2019-05-22 16:44:54', '2019-05-22 16:44:54');

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
-- Table structure for c2_grp
-- ----------------------------
DROP TABLE IF EXISTS `c2_grp`;
CREATE TABLE `c2_grp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `attributeset_id` bigint(20) DEFAULT '0',
  `province_id` bigint(20) DEFAULT '0',
  `city_id` bigint(20) DEFAULT '0',
  `district_id` bigint(20) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
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
  KEY `Index_3` (`type`),
  KEY `Index_4` (`province_id`,`city_id`,`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_grp
-- ----------------------------
INSERT INTO `c2_grp` VALUES ('6', '1', '0', '0', '0', '0', 'GRP20190520C700000006', '丝雨', null, null, null, '1', '1', '1', '0', '2019-05-20 06:58:46', '2019-05-20 06:58:46');
INSERT INTO `c2_grp` VALUES ('7', '1', '0', '0', '0', '0', 'GRP20190521KW00000007', '原玉', null, null, null, '1', '1', '1', '0', '2019-05-21 10:28:24', '2019-05-21 10:28:24');

-- ----------------------------
-- Table structure for c2_grp_branch
-- ----------------------------
DROP TABLE IF EXISTS `c2_grp_branch`;
CREATE TABLE `c2_grp_branch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`grp_id`),
  KEY `Index_2` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_grp_branch
-- ----------------------------

-- ----------------------------
-- Table structure for c2_grp_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_grp_profile`;
CREATE TABLE `c2_grp_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
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
  KEY `Index_1` (`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_grp_profile
-- ----------------------------

-- ----------------------------
-- Table structure for c2_grp_station
-- ----------------------------
DROP TABLE IF EXISTS `c2_grp_station`;
CREATE TABLE `c2_grp_station` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `type` tinyint(9) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `parent_station_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`grp_id`),
  KEY `Index_2` (`parent_station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_grp_station
-- ----------------------------
INSERT INTO `c2_grp_station` VALUES ('1', '3', '1', 'C3', 'C3', '0', '1', '0', '2019-05-20 06:57:45', '2019-05-20 06:57:45');
INSERT INTO `c2_grp_station` VALUES ('2', '4', '1', 'C3', 'C3', '0', '1', '0', '2019-05-20 06:57:46', '2019-05-20 06:57:46');
INSERT INTO `c2_grp_station` VALUES ('3', '5', '1', 'C3', 'C3', '0', '1', '0', '2019-05-20 06:58:10', '2019-05-20 06:58:10');
INSERT INTO `c2_grp_station` VALUES ('4', '6', '1', 'C3', 'C3', '0', '1', '0', '2019-05-20 06:58:46', '2019-05-20 06:58:46');
INSERT INTO `c2_grp_station` VALUES ('7', '6', '2', '1111', '1111', '4', '1', '0', '2019-05-20 09:03:28', '2019-05-20 09:03:28');
INSERT INTO `c2_grp_station` VALUES ('8', '6', '2', '2222', '2222', '4', '1', '0', '2019-05-20 09:03:28', '2019-05-20 09:03:28');
INSERT INTO `c2_grp_station` VALUES ('9', '6', '2', '3333', '3333', '4', '1', '0', '2019-05-20 10:03:12', '2019-05-20 10:03:12');
INSERT INTO `c2_grp_station` VALUES ('10', '6', '3', 'aaaa', 'aaaa', '7', '1', '0', '2019-05-20 10:13:05', '2019-05-20 10:13:05');
INSERT INTO `c2_grp_station` VALUES ('11', '6', '3', 'bbbb', 'bbbb', '7', '1', '0', '2019-05-20 11:58:37', '2019-05-20 11:58:37');
INSERT INTO `c2_grp_station` VALUES ('12', '6', '4', 'cccc', 'cccc', '10', '1', '0', '2019-05-21 05:54:15', '2019-05-21 05:54:15');
INSERT INTO `c2_grp_station` VALUES ('13', '6', '3', 'dddd', 'dddd', '7', '1', '0', '2019-05-21 05:55:11', '2019-05-21 05:55:11');
INSERT INTO `c2_grp_station` VALUES ('14', '7', '1', 'C3', 'C3', '0', '1', '0', '2019-05-21 10:28:24', '2019-05-21 10:28:24');
INSERT INTO `c2_grp_station` VALUES ('15', '7', '2', 'C1', 'C1', '14', '1', '0', '2019-05-21 10:29:33', '2019-05-21 10:29:33');
INSERT INTO `c2_grp_station` VALUES ('16', '7', '2', 'C1', 'C1', '14', '1', '0', '2019-05-21 11:23:25', '2019-05-21 11:23:25');
INSERT INTO `c2_grp_station` VALUES ('17', '7', '3', 'aaa', 'aaa', null, '1', '0', '2019-05-21 11:24:48', '2019-05-21 11:24:48');
INSERT INTO `c2_grp_station` VALUES ('18', '7', '3', '', 'bbbb', null, '1', '0', '2019-05-21 11:26:21', '2019-05-21 11:26:21');
INSERT INTO `c2_grp_station` VALUES ('19', '7', '4', '', 'cccc', null, '1', '0', '2019-05-21 11:27:17', '2019-05-21 11:27:17');
INSERT INTO `c2_grp_station` VALUES ('20', '7', '3', '', 'dddd', '15', '1', '0', '2019-05-21 11:29:13', '2019-05-21 11:29:13');
INSERT INTO `c2_grp_station` VALUES ('21', '7', '2', '', 'eeee', '14', '1', '0', '2019-05-21 11:29:27', '2019-05-21 11:29:27');
INSERT INTO `c2_grp_station` VALUES ('23', '7', '4', '', 'eeee', '20', '1', '0', '2019-05-21 12:04:59', '2019-05-21 12:04:59');
INSERT INTO `c2_grp_station` VALUES ('24', '7', '4', '', 'eeee', '20', '1', '0', '2019-05-21 12:05:02', '2019-05-21 12:05:02');
INSERT INTO `c2_grp_station` VALUES ('25', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:19', '2019-05-22 11:35:19');
INSERT INTO `c2_grp_station` VALUES ('26', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:23', '2019-05-22 11:35:23');
INSERT INTO `c2_grp_station` VALUES ('27', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:24', '2019-05-22 11:35:24');
INSERT INTO `c2_grp_station` VALUES ('28', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:25', '2019-05-22 11:35:25');
INSERT INTO `c2_grp_station` VALUES ('29', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:27', '2019-05-22 11:35:27');
INSERT INTO `c2_grp_station` VALUES ('30', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:30', '2019-05-22 11:35:30');
INSERT INTO `c2_grp_station` VALUES ('31', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:31', '2019-05-22 11:35:31');
INSERT INTO `c2_grp_station` VALUES ('32', '7', '4', '', 'qqq', '20', '1', '0', '2019-05-22 11:35:32', '2019-05-22 11:35:32');
INSERT INTO `c2_grp_station` VALUES ('33', '7', '5', '', 'ssss', '23', '1', '0', '2019-05-22 11:36:55', '2019-05-22 11:36:55');
INSERT INTO `c2_grp_station` VALUES ('34', '7', '5', '', 'ssss', '23', '1', '0', '2019-05-22 11:37:03', '2019-05-22 11:37:03');
INSERT INTO `c2_grp_station` VALUES ('35', '7', '6', '', 'ssss', '23', '1', '0', '2019-05-22 11:37:04', '2019-05-22 11:37:04');
INSERT INTO `c2_grp_station` VALUES ('36', '7', '5', '', 'gggg', '24', '1', '0', '2019-05-22 11:37:11', '2019-05-22 11:37:11');
INSERT INTO `c2_grp_station` VALUES ('37', '7', '6', '', 'gggg', '24', '1', '0', '2019-05-22 11:37:13', '2019-05-22 11:37:13');
INSERT INTO `c2_grp_station` VALUES ('38', '7', '5', '', 'gggg', '24', '1', '0', '2019-05-22 11:37:26', '2019-05-22 11:37:26');
INSERT INTO `c2_grp_station` VALUES ('39', '7', '6', '', '2222', '36', '1', '0', '2019-05-22 11:39:01', '2019-05-22 11:39:01');
INSERT INTO `c2_grp_station` VALUES ('40', '7', '7', '', '2222', '36', '1', '0', '2019-05-22 11:39:06', '2019-05-22 11:39:06');
INSERT INTO `c2_grp_station` VALUES ('41', '7', '8', '', '2222', '36', '1', '0', '2019-05-22 11:39:10', '2019-05-22 11:39:10');

-- ----------------------------
-- Table structure for c2_grp_station_item
-- ----------------------------
DROP TABLE IF EXISTS `c2_grp_station_item`;
CREATE TABLE `c2_grp_station_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_station_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `label` varchar(255) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`),
  KEY `Index_2` (`grp_station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_grp_station_item
-- ----------------------------
INSERT INTO `c2_grp_station_item` VALUES ('4', '11', '2', '', '1', '1', '0', '2019-05-21 10:21:34', '2019-05-21 10:21:44');
INSERT INTO `c2_grp_station_item` VALUES ('5', '12', '1', '', '1', '1', '0', '2019-05-21 10:21:55', '2019-05-21 10:21:55');
INSERT INTO `c2_grp_station_item` VALUES ('6', '13', '1', '', '1', '1', '0', '2019-05-21 10:23:29', '2019-05-21 10:23:48');
INSERT INTO `c2_grp_station_item` VALUES ('7', '13', '2', '', '1', '1', '0', '2019-05-21 10:24:58', '2019-05-21 10:24:58');
INSERT INTO `c2_grp_station_item` VALUES ('8', '10', '3', '', '1', '1', '0', '2019-05-21 10:25:38', '2019-05-21 10:25:38');
INSERT INTO `c2_grp_station_item` VALUES ('9', '8', '1', '', '1', '1', '0', '2019-05-21 10:26:18', '2019-05-21 10:26:18');
INSERT INTO `c2_grp_station_item` VALUES ('10', '8', '2', '', '1', '1', '0', '2019-05-21 10:26:23', '2019-05-21 10:26:23');
INSERT INTO `c2_grp_station_item` VALUES ('11', '7', '3', '', '1', '1', '0', '2019-05-21 10:26:35', '2019-05-21 10:26:35');
INSERT INTO `c2_grp_station_item` VALUES ('12', '15', '1', '', '1', '1', '0', '2019-05-21 12:06:41', '2019-05-21 12:06:41');
INSERT INTO `c2_grp_station_item` VALUES ('13', '16', '1', '', '1', '1', '0', '2019-05-22 08:50:16', '2019-05-22 08:50:16');
INSERT INTO `c2_grp_station_item` VALUES ('14', '21', '4', '', '1', '1', '0', '2019-05-22 09:20:41', '2019-05-22 09:20:41');

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
-- Table structure for c2_user_grp_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_grp_rs`;
CREATE TABLE `c2_user_grp_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`),
  KEY `Index_2` (`grp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_grp_rs
-- ----------------------------
INSERT INTO `c2_user_grp_rs` VALUES ('1', '7', '1', '1', '1', '0', '2019-05-22 08:50:17', '2019-05-22 08:50:17');
INSERT INTO `c2_user_grp_rs` VALUES ('2', '7', '4', '1', '1', '0', '2019-05-22 09:20:41', '2019-05-22 09:20:41');

-- ----------------------------
-- Table structure for c2_user_kpi
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_kpi`;
CREATE TABLE `c2_user_kpi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `join_user_id` bigint(20) NOT NULL DEFAULT '0',
  `rcd_user_id` bigint(20) DEFAULT NULL,
  `grp_station_id` bigint(20) DEFAULT NULL,
  `c1_id` bigint(20) DEFAULT NULL,
  `dues` decimal(10,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`join_user_id`),
  KEY `Index_2` (`grp_id`),
  KEY `Index_3` (`rcd_user_id`),
  KEY `Index_4` (`c1_id`),
  KEY `Index_5` (`c1_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_kpi
-- ----------------------------

-- ----------------------------
-- Table structure for c2_user_profit
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_profit`;
CREATE TABLE `c2_user_profit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_profit
-- ----------------------------

-- ----------------------------
-- Table structure for c2_user_profit_item
-- ----------------------------
DROP TABLE IF EXISTS `c2_user_profit_item`;
CREATE TABLE `c2_user_profit_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '1',
  `kpi_id` bigint(20) DEFAULT NULL,
  `grp_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`),
  KEY `Index_2` (`kpi_id`),
  KEY `Index_3` (`grp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of c2_user_profit_item
-- ----------------------------
