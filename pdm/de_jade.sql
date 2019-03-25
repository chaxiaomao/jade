/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : de_jade

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-25 18:06:13
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
-- Table structure for c2_consumption_record
-- ----------------------------
DROP TABLE IF EXISTS `c2_consumption_record`;
CREATE TABLE `c2_consumption_record` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `shop_id` bigint(20) DEFAULT '0',
  `fe_user_type` tinyint(4) DEFAULT '0',
  `fe_user_id` bigint(20) DEFAULT '0',
  `salesman_id` bigint(20) DEFAULT '0',
  `salesman_commission` char(10) DEFAULT NULL,
  `payment_method_id` bigint(20) DEFAULT '0',
  `discount_amount` decimal(10,4) DEFAULT '0.0000',
  `refund_amount` decimal(10,4) DEFAULT '0.0000',
  `subtotal` decimal(10,4) DEFAULT '0.0000',
  `grand_total` decimal(10,4) DEFAULT '0.0000',
  `remote_ip` varchar(255) DEFAULT NULL,
  `memo` text,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `state` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`shop_id`),
  KEY `Index_2` (`salesman_id`),
  KEY `Index_3` (`fe_user_id`),
  KEY `Index_4` (`code`),
  KEY `Index_5` (`fe_user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_consumption_record
-- ----------------------------

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
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` datetime DEFAULT NULL,
  `registration_ip` varchar(255) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `open_id` varchar(255) DEFAULT NULL,
  `wechat_open_id` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
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
  KEY `Index_4` (`open_id`),
  KEY `Index_5` (`wechat_open_id`),
  KEY `Index_7` (`mobile_number`),
  KEY `Index_6` (`access_token`,`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_fe_user
-- ----------------------------
INSERT INTO `c2_fe_user` VALUES ('2', '1', '0', 'Merchant1', 'merchant1@test.com', '$2y$10$c873IIOkqz/lHBq7wVXtbOF7MR5VVdLTwstKEg/3/weN.6FWiRSBW', 'd22SEEt7hagRk0fEscZ0wyqMnopB8N7X', null, '', null, '', null, '2017-05-29 04:03:49', '127.0.0.1', '123', 'oL8S2w1mCxR6fwoXr9GOBkBnZvfU', '112344', '$2y$10$bZhRTPWivsVqoarXRk152OEeSfdC.pRMYd.CI4nFS.8HqOFGXxdcq', null, '0', '0', '1', '0', '2017-05-19 04:17:45', '2017-05-29 04:03:49');
INSERT INTO `c2_fe_user` VALUES ('13', '1', '0', 'Merchant2', '', null, 'w-5o7oGnvQ8bjSESRLRR9iIsn8e1pGsL', null, null, null, null, null, null, null, '', '', '6767688', '$2y$10$f8AqTJaW.0xvURM4IrxGN.HQ7PjH1EAa9AYINRgJgnCv3PntJIaee', null, '0', '0', '1', '0', '2017-05-22 08:24:17', '2017-05-26 10:32:47');
INSERT INTO `c2_fe_user` VALUES ('14', '1', '0', 'Merchant3', '', null, null, null, null, null, null, null, null, null, '', '', '', null, null, '0', '0', '1', '0', '2017-05-22 08:48:12', '2017-05-22 08:48:12');
INSERT INTO `c2_fe_user` VALUES ('16', '1', '0', 'Merchant4', '', null, null, null, null, null, null, null, null, null, '', '', '', null, null, '0', '0', '1', '0', '2017-05-22 09:08:49', '2017-05-22 09:08:49');
INSERT INTO `c2_fe_user` VALUES ('17', '1', '0', 'Merchant5', '', null, null, null, null, null, null, null, null, null, '', '', '', null, null, '0', '0', '1', '0', '2017-05-22 09:35:00', '2017-05-22 09:35:00');
INSERT INTO `c2_fe_user` VALUES ('18', '2', '0', 'Salesman1', '', '$2y$10$OwrwO/Jc3eZTkrNCuoUOTuf3nEcm/bHUhhhmWd6Rb/7m7TOjvBPZq', 'ofexj-qdlUoKfY3JYeI7LiP47G-K5MAQ', null, null, null, null, null, '2017-05-30 04:19:16', '127.0.0.1', '', '', '', '$2y$10$bikL/6oWyO4PAN4Zvl3wAOignYZmyxFyRTWdBYGU2kYaDw9BR4cSK', null, '0', '0', '1', '0', '2017-05-22 11:12:54', '2017-05-30 04:19:16');
INSERT INTO `c2_fe_user` VALUES ('19', '3', '0', 'Favoured Customer1', '', '$2y$10$9WSDCM6/QCYE58ZzuSlOwOr5to60wGPrxk3QMNh1uWfZOTPo9Syq6', '70a-ZRQpattYaZXzfdpTH4LCZJhQ4oAz', null, null, null, null, null, null, null, '999', '', '', '$2y$10$98Mrm0/QGJ9mk.GVycw9guZGbxws9mEHm.vac7e0xxDq.9d44y/7y', null, '0', '0', '1', '0', '2017-05-22 11:32:05', '2017-05-28 16:14:53');
INSERT INTO `c2_fe_user` VALUES ('20', '2', '0', 'Salesman2', '', null, null, null, null, null, null, null, null, null, '', '', '', null, null, '0', '0', '1', '0', '2017-05-23 04:11:17', '2017-05-23 04:15:14');
INSERT INTO `c2_fe_user` VALUES ('21', '4', '0', 'Normal Customer1', '', '$2y$10$0dW8caal18AybpeYJYRtN.5W7DWg2YtDbqyEPZItSIRYKrDwbF4ca', null, null, null, null, null, null, '2017-05-28 06:40:41', '127.0.0.1', '', '', '', null, null, '0', '0', '1', '0', '2017-05-23 08:18:52', '2017-05-28 06:40:41');
INSERT INTO `c2_fe_user` VALUES ('23', '1', '0', '13922462101', 'tester1@zdt6.com', null, '6FG0WvYwOJR_TwsJ_2vLOF-y0vEB6LCC', null, null, null, null, null, null, null, null, null, '13922462101', '$2y$10$0Af7m0jMmEJECwBxc9EJiOJnjzVA1BnMDqgzgqnx5TzQsY.qAW89y', null, '0', '0', '2', '0', '2017-05-27 08:47:12', '2017-05-27 08:47:12');
INSERT INTO `c2_fe_user` VALUES ('24', '1', '0', '13922462102', '', null, 'rlT2Z0HjTrexxiryDnbbobOKZiq78ocu', null, null, null, null, null, null, null, null, null, '13922462102', '$2y$10$yb6bVHab8QWd5Epte5VHV.Ww3GTZJy8bwFEqW/KIQ3EWCponUTm1u', null, '0', '0', '2', '0', '2017-05-27 08:55:35', '2017-05-27 08:55:35');

-- ----------------------------
-- Table structure for c2_fe_user_feedback
-- ----------------------------
DROP TABLE IF EXISTS `c2_fe_user_feedback`;
CREATE TABLE `c2_fe_user_feedback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `user_id` bigint(20) DEFAULT '0',
  `complain_type` tinyint(4) DEFAULT '0',
  `complain_object_id` bigint(20) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`user_id`),
  KEY `Index_2` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_fe_user_feedback
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
-- Table structure for c2_salesman_customer_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_salesman_customer_rs`;
CREATE TABLE `c2_salesman_customer_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `salesman_id` bigint(20) DEFAULT '0',
  `customer_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`salesman_id`),
  KEY `Index_2` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_salesman_customer_rs
-- ----------------------------
INSERT INTO `c2_salesman_customer_rs` VALUES ('3', '18', '19', '1', '0', null, null);

-- ----------------------------
-- Table structure for c2_shop
-- ----------------------------
DROP TABLE IF EXISTS `c2_shop`;
CREATE TABLE `c2_shop` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '0',
  `merchant_id` bigint(20) DEFAULT NULL,
  `attributeset_id` bigint(20) DEFAULT '0',
  `region_id` bigint(20) DEFAULT '0',
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
  KEY `Index_1` (`code`),
  KEY `Index_2` (`label`),
  KEY `Index_3` (`type`),
  KEY `Index_4` (`merchant_id`),
  KEY `Index_5` (`wechat_open_id`),
  KEY `Index_6` (`open_id`),
  KEY `Index_7` (`region_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_shop
-- ----------------------------
INSERT INTO `c2_shop` VALUES ('1', '0', '2', '0', '1', 'SHOP001', '专卖店1', '', '', '', '', '', null, null, null, '0', '0', '1', '0', '2017-05-22 12:03:50', '2017-05-23 05:03:22');
INSERT INTO `c2_shop` VALUES ('6', '0', '13', '0', '1', 'SHOP002', '专卖店2', '', '', '', '', '', null, null, null, '0', '0', '1', '0', '2017-05-28 16:44:44', '2017-05-28 16:44:44');

-- ----------------------------
-- Table structure for c2_shop_customer_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_shop_customer_rs`;
CREATE TABLE `c2_shop_customer_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) DEFAULT '0',
  `merchant_id` bigint(20) DEFAULT '0',
  `customer_type` tinyint(4) DEFAULT '0',
  `customer_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`shop_id`),
  KEY `Index_2` (`customer_id`),
  KEY `Index_3` (`merchant_id`),
  KEY `Index_4` (`customer_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_shop_customer_rs
-- ----------------------------
INSERT INTO `c2_shop_customer_rs` VALUES ('2', '2', '0', '0', '19', '1', '0', null, null);

-- ----------------------------
-- Table structure for c2_shop_profile
-- ----------------------------
DROP TABLE IF EXISTS `c2_shop_profile`;
CREATE TABLE `c2_shop_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) DEFAULT NULL,
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
  KEY `Index_1` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_shop_profile
-- ----------------------------
INSERT INTO `c2_shop_profile` VALUES ('1', '1', null, null, null, null, null, null, null, null, null, null, null, '0', '1:专卖店1:cc', 'F4ZFdGWK.png', '1', '0', '2017-05-22 12:03:50', '2017-05-22 12:03:50');
INSERT INTO `c2_shop_profile` VALUES ('6', '6', null, null, null, null, null, null, null, null, null, null, null, '0', 'http://fe-apollo-pre.local.bulletelc.com/site/port?sid=6&a=shop_info', 'IRmYACL2.png', '1', '0', '2017-05-28 16:44:44', '2017-05-28 16:44:44');

-- ----------------------------
-- Table structure for c2_shop_region_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_shop_region_rs`;
CREATE TABLE `c2_shop_region_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) DEFAULT '0',
  `region_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_shop_region_rs
-- ----------------------------

-- ----------------------------
-- Table structure for c2_shop_salesman_rs
-- ----------------------------
DROP TABLE IF EXISTS `c2_shop_salesman_rs`;
CREATE TABLE `c2_shop_salesman_rs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) DEFAULT '0',
  `merchant_id` bigint(20) DEFAULT '0',
  `salesman_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_1` (`shop_id`),
  KEY `Index_2` (`salesman_id`),
  KEY `Index_3` (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c2_shop_salesman_rs
-- ----------------------------
INSERT INTO `c2_shop_salesman_rs` VALUES ('2', '2', '0', '20', '1', '0', null, null);
INSERT INTO `c2_shop_salesman_rs` VALUES ('3', '1', '0', '18', '1', '0', null, null);

-- ----------------------------
-- Table structure for c2_social_account
-- ----------------------------
DROP TABLE IF EXISTS `c2_social_account`;
CREATE TABLE `c2_social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `c2_social_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `c2_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of c2_social_account
-- ----------------------------
