-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019-06-05 14:27:37
-- 服务器版本： 5.5.56-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jade2.0`
--

-- --------------------------------------------------------

--
-- 表的结构 `c2_auth_assignment`
--

CREATE TABLE `c2_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `c2_auth_assignment`
--

INSERT INTO `c2_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('P_CRM', '2', 1494992704),
('P_Logistics', '1', 1557714151),
('P_P3S', '1', 1557714151),
('P_Sales', '2', 1494988087),
('P_System', '1', 1557714151),
('客服', '3', 1494809730),
('系统管理员', '1', 1494988059);

-- --------------------------------------------------------

--
-- 表的结构 `c2_auth_item`
--

CREATE TABLE `c2_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `c2_auth_item`
--

INSERT INTO `c2_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('P_Api', 2, 'api 接口访问', NULL, NULL, 1495683273, 1495683273),
('P_CRM', 2, 'CRM 客户关系管理', NULL, NULL, 1481702351, 1494981130),
('P_Logistics', 2, '后勤资料管理', NULL, NULL, 1495506790, 1495506790),
('P_P3S', 2, '', NULL, NULL, 1557713542, 1557713542),
('P_Sales', 2, 'Sales 销售管理', NULL, NULL, 1481702395, 1494981201),
('P_Statistics', 2, 'Statistics 统计', NULL, NULL, 1494981273, 1494981273),
('P_System', 2, 'System 系统配置', NULL, NULL, 1494981539, 1494981539),
('客服', 1, '', NULL, NULL, 1494809711, 1495506881),
('系统管理员', 1, '', NULL, NULL, 1481702421, 1495683288),
('经理', 1, '', NULL, NULL, 1494987655, 1495506856);

-- --------------------------------------------------------

--
-- 表的结构 `c2_auth_item_child`
--

CREATE TABLE `c2_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `c2_auth_item_child`
--

INSERT INTO `c2_auth_item_child` (`parent`, `child`) VALUES
('系统管理员', 'P_Api'),
('客服', 'P_CRM'),
('经理', 'P_CRM'),
('客服', 'P_Logistics'),
('经理', 'P_Logistics'),
('客服', 'P_Sales'),
('经理', 'P_Sales'),
('经理', 'P_Statistics'),
('系统管理员', 'P_System'),
('系统管理员', '客服'),
('经理', '客服'),
('系统管理员', '经理');

-- --------------------------------------------------------

--
-- 表的结构 `c2_auth_rule`
--

CREATE TABLE `c2_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `c2_be_user`
--

CREATE TABLE `c2_be_user` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c2_be_user`
--

INSERT INTO `c2_be_user` (`id`, `type`, `attributeset_id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `flags`, `last_login_at`, `last_login_ip`, `open_id`, `created_by`, `updated_by`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'admin', 'admin@zdt6.com', '$2y$10$5eauFS9k6xcu1du2VueAnemqc10NKyUyezRE59Pfntb9MPvAm8KQ.', 'wh3xjpD0cazZIwLEDNK785pe54bG6Dm1', '0000-00-00 00:00:00', NULL, NULL, '127.0.0.1', 0, '2019-06-05 14:03:25', '120.231.110.30', NULL, 0, 0, 1, 0, '2017-01-25 11:01:00', '2019-06-03 17:37:54'),
(2, 0, 0, 'tester1', 'tester1@zdt6.com', '$2y$10$QDFHh.AvjI7RnBmBnHNavOmw/H2cRSt69s0SIe9l4oGy0.03Rvkt.', 'T1yk3EUV6Qf4KwVz7jJspdR5PiX3F8yk', '0000-00-00 00:00:00', NULL, NULL, '127.0.0.1', NULL, '2017-05-18 03:25:05', NULL, NULL, 0, 0, 1, 0, '0000-00-00 00:00:00', '2017-05-17 05:43:39'),
(3, 0, 0, 'tester2', 'tester2@zdt6.com', '$2y$10$F3fC9b1cgSJZ/LzG1451Su2s3NkPYs8jDM/p0A9iur.vBX2BPDSti', 'fgm17RciIC0qaCAiF6lj8s7DX07A_con', '0000-00-00 00:00:00', NULL, NULL, '127.0.0.1', NULL, NULL, NULL, NULL, 0, 0, 1, 0, '2017-05-16 12:07:01', '2017-05-24 03:41:30');

-- --------------------------------------------------------

--
-- 表的结构 `c2_be_user_profile`
--

CREATE TABLE `c2_be_user_profile` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c2_be_user_profile`
--

INSERT INTO `c2_be_user_profile` (`id`, `user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`, `firstname`, `lastname`, `birthday`, `avatar`, `terms`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', NULL, 'Bi', 'Ben', '2017-06-01 00:00:00', 'ASGOWptT-UWl57arDgUEtNDvrSm3ZFhJ.jpg', 0, 1, 0, NULL, NULL),
(2, 2, 'test1', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', NULL, 'Firstname', 'Lastname', '2017-05-28 00:00:00', 'yHC5IkHVVhfDAnVaapt43tNc1pZuluOb.jpg', 0, 1, 0, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `c2_city`
--

CREATE TABLE `c2_city` (
  `id` bigint(20) NOT NULL,
  `name` char(35) DEFAULT NULL,
  `country_code` char(3) DEFAULT NULL,
  `district` char(20) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_config`
--

CREATE TABLE `c2_config` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_country`
--

CREATE TABLE `c2_country` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_country_language`
--

CREATE TABLE `c2_country_language` (
  `id` bigint(20) NOT NULL,
  `country_code` char(3) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `is_official` enum('T','F') DEFAULT NULL,
  `percentage` float(4,1) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_fe_user`
--

CREATE TABLE `c2_fe_user` (
  `id` bigint(20) NOT NULL,
  `type` int(11) DEFAULT '0',
  `invite_user_id` bigint(20) DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `invite_username` varchar(255) DEFAULT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_fe_user`
--

INSERT INTO `c2_fe_user` (`id`, `type`, `invite_user_id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `invite_username`, `blocked_at`, `registration_ip`, `registration_src_type`, `flags`, `level`, `last_login_at`, `last_login_ip`, `open_id`, `wechat_union_id`, `wechat_open_id`, `mobile_number`, `sms_receipt`, `access_token`, `password_reset_token`, `district_id`, `province_id`, `city_id`, `created_by`, `updated_by`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'jerrygoC3', 'c3@qq.com', '$2y$13$hmGVN0Q.SHJ2M0dgMhu98.pYl.LuvU0B2eQfL3X0F85iYsYGlBNLq', 'J-zspSoY_5JPmcetMtgRPGFddamid1bH', NULL, NULL, NULL, '127.0.0.1', 100, NULL, NULL, '2019-05-28 18:59:16', '127.0.0.1', NULL, NULL, NULL, '15622965563', NULL, NULL, NULL, NULL, 0, 0, 1, 1, 1, 0, '2019-05-21 07:49:59', '2019-05-28 18:59:16'),
(2, 0, 0, 'jerrygoC1', 'c1@qq.com', '$2y$13$eAMxg4hfUqWMJC.6ndpYzu1XYi85KzJuKUyz0ElvauL38nsDZ125u', 'QxRZNTp6g29sxS4LupmPrsa0FUr-gTtf', NULL, NULL, NULL, '127.0.0.1', 100, NULL, NULL, '2019-05-30 10:27:31', '120.231.110.194', NULL, NULL, NULL, '15622966561', NULL, NULL, NULL, NULL, 0, 0, 1, 2, 1, 0, '2019-05-21 10:21:22', '2019-05-30 10:27:31'),
(3, 0, 0, 'jerrygoC2', 'c2@qq.com', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', 5, NULL, NULL, NULL, '', NULL, NULL, NULL, '1562296562', NULL, NULL, NULL, NULL, 0, 0, 1, 1, 1, 0, '2019-05-21 10:25:30', '2019-05-21 10:25:30'),
(4, 0, 0, 'jem', NULL, '$2y$13$Xen21rD9UXmTVmTz5IP9n.BSar7M9/x7ynNwIfyBHpJYxtj0dSbRK', '-oa4ky_qD85f6lG6QrNiaSJnixZ2IVtg', NULL, NULL, NULL, '127.0.0.1', 5, NULL, NULL, '2019-06-05 14:10:18', '120.231.110.30', NULL, NULL, NULL, '15622965564', NULL, NULL, NULL, NULL, 0, 0, NULL, 4, 1, 0, '2019-05-22 15:17:56', '2019-06-05 14:10:18'),
(5, 0, 0, 'jem1', NULL, '$2y$13$Z0cGtf5mktZyigl8.v8cxuBJ/TVj5Ph1lxGuYFzgcSNKQIhNYxjsS', 'pdzLYuH0iypNTv-lqRqwoosQK9Hwf45A', NULL, NULL, NULL, '127.0.0.1', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965565', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-05-22 16:44:54', '2019-05-22 16:44:54'),
(6, 0, 0, 'jem23', NULL, '$2y$13$x0DfgMNHi0Tl0kvJEKMW9O3VP26VBSumhlYo6xOoymNit0AFJYwkK', 'ix1nZilQcPMrqqzGYdkVwdCneJkCdRQ1', NULL, NULL, NULL, '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965523', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-05-24 15:12:41', '2019-05-24 15:12:41'),
(7, 0, 0, 'jem21', NULL, '$2y$13$ATXYVJXD3W3Gf4FjwnyFXunjs338Y3Rql/QB9unPJE.kHpXmxGh/i', 'otnxZF90grqvFscoYNgYUnXt4VAwSTo6', NULL, NULL, NULL, '127.0.0.1', 1, NULL, NULL, '2019-05-26 18:28:28', '127.0.0.1', NULL, NULL, NULL, '15622965521', NULL, NULL, NULL, NULL, 0, 0, NULL, 7, 1, 0, '2019-05-24 15:13:22', '2019-05-26 18:28:28'),
(8, 0, 0, 'jem11', NULL, '$2y$13$dIgMily7AyYeUkH5gMW81.bkXkgXjuaBqJALQH1KUnVvwCI8MvYqC', 'q1qMGtuDcXjoFw46am9GpVE6_WRLgrqX', NULL, NULL, NULL, '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965511', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-05-24 15:14:13', '2019-05-24 15:14:13'),
(11, 0, 0, 'jem22', NULL, '$2y$13$qeW7vB9HCYFBhrq8cy/.VOILiowvYaC7GMDu.h/T7Y0RSsFh8hfQq', 'BpOFJfnU4KZWl5nN677QaXfV1D4L1Sra', NULL, NULL, NULL, '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965522', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-05-28 19:37:45', '2019-05-28 19:37:45'),
(13, 0, 0, 'jem33', NULL, '$2y$13$dYakBSblkV7mi.Qtelo/kuMw.Z6Zsg5XplapyZSSg6ESEHvRxmkni', 'WlQ1jRCMgAOjL4H5PVrmbnzNfiC-RNwo', NULL, NULL, NULL, '127.0.0.1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965533', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-05-28 19:51:05', '2019-05-28 19:51:05'),
(14, 0, 4, 'jem44', NULL, '$2y$13$5P1zTcwDNH8qqsW4G1YMP.YVi20ldlUYsC5NxCGs270WStAmZYUUC', '6uUuI8R1GJW5tcLWA-oALbcn_90rSApl', NULL, 'jem', NULL, '127.0.0.1', 1, NULL, NULL, '2019-05-28 20:01:05', '127.0.0.1', NULL, NULL, NULL, '15622965544', NULL, NULL, NULL, NULL, 0, 0, NULL, 14, 1, 0, '2019-05-28 19:59:58', '2019-05-28 20:01:05'),
(15, 0, 4, '戴映发', NULL, '$2y$13$601CZ7YTXyR8FMii3XLnFuB1QX6U6I.jw1NO0EBdNr/2NX0q2M9L.', 'lt4yuskyCfwBu1oqddOLNcBHQNvZDMPN', NULL, 'jem', NULL, '117.136.79.71', 3, NULL, NULL, '2019-06-04 11:47:19', '120.231.110.30', NULL, NULL, NULL, '18824731491', NULL, NULL, NULL, NULL, 0, 0, NULL, 15, 1, 0, '2019-05-29 12:29:34', '2019-06-04 11:47:19'),
(16, 0, 4, '陈寻借', NULL, '$2y$13$bk3CQ3Etfe6sV6.tWY7NverAlFcRi8lnSeKuyohFMfZfAYQqfd4s2', 'dcHvyvkzC1JO9plimCVMUpMEjJGQCM6A', NULL, 'jem', NULL, '120.231.110.30', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15622965566', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 0, '2019-06-05 14:05:13', '2019-06-05 14:05:13');

-- --------------------------------------------------------

--
-- 表的结构 `c2_fe_user_profile`
--

CREATE TABLE `c2_fe_user_profile` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_grp`
--

CREATE TABLE `c2_grp` (
  `id` bigint(20) NOT NULL,
  `type` tinyint(4) DEFAULT '0',
  `attributeset_id` bigint(20) DEFAULT '0',
  `province_id` bigint(20) DEFAULT '0',
  `city_id` bigint(20) DEFAULT '0',
  `district_id` bigint(20) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `seo_code` varchar(255) NOT NULL,
  `geo_longitude` varchar(255) DEFAULT NULL,
  `geo_latitude` varchar(255) DEFAULT NULL,
  `geo_marker_color` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT '0',
  `updated_by` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_grp`
--

INSERT INTO `c2_grp` (`id`, `type`, `attributeset_id`, `province_id`, `city_id`, `district_id`, `code`, `label`, `seo_code`, `geo_longitude`, `geo_latitude`, `geo_marker_color`, `created_by`, `updated_by`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 'GRP201905287D00000001', '太平洋A', 'QIi8cRKr62', NULL, NULL, NULL, 1, 1, 1, 0, '2019-05-28 10:35:04', '2019-05-28 10:35:04');

-- --------------------------------------------------------

--
-- 表的结构 `c2_grp_branch`
--

CREATE TABLE `c2_grp_branch` (
  `id` bigint(20) NOT NULL,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_grp_profile`
--

CREATE TABLE `c2_grp_profile` (
  `id` bigint(20) NOT NULL,
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
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_grp_station`
--

CREATE TABLE `c2_grp_station` (
  `id` bigint(20) NOT NULL,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `type` tinyint(9) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `parent_station_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_grp_station`
--

INSERT INTO `c2_grp_station` (`id`, `grp_id`, `type`, `name`, `label`, `parent_station_id`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '懂事长', '懂事长', 0, 1, 0, '2019-05-28 10:35:04', '2019-05-28 11:11:49'),
(2, 1, 2, '经理', '经理', 1, 1, 0, '2019-05-28 10:59:09', '2019-05-28 10:59:09'),
(34, 1, 3, '助理', '助理', 2, 1, 0, '2019-05-28 13:03:35', '2019-05-28 13:03:35'),
(35, 1, 4, '主管', '主管', 34, 1, 0, '2019-05-28 13:29:32', '2019-05-28 13:29:32'),
(36, 1, 4, '主管', '主管', 34, 1, 0, '2019-05-28 13:29:38', '2019-05-28 13:29:38'),
(37, 1, 4, '主管', '主管', 34, 1, 0, '2019-05-28 13:29:41', '2019-05-28 13:29:41'),
(38, 1, 5, '组长', '组长', 35, 1, 0, '2019-06-05 14:06:07', '2019-06-05 14:06:07'),
(39, 1, 5, '组长', '组长', 35, 1, 0, '2019-06-05 14:06:11', '2019-06-05 14:06:11'),
(40, 1, 5, '组长', '组长', 35, 1, 0, '2019-06-05 14:06:17', '2019-06-05 14:06:17');

-- --------------------------------------------------------

--
-- 表的结构 `c2_grp_station_item`
--

CREATE TABLE `c2_grp_station_item` (
  `id` bigint(20) NOT NULL,
  `grp_station_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `label` varchar(255) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_grp_station_item`
--

INSERT INTO `c2_grp_station_item` (`id`, `grp_station_id`, `user_id`, `label`, `state`, `status`, `position`, `created_at`, `updated_at`) VALUES
(9, 34, 2, '', 1, 1, 0, '2019-05-28 13:03:43', '2019-05-28 13:03:43'),
(10, 35, 4, '', 1, 1, 0, '2019-05-28 13:29:50', '2019-05-28 13:29:50'),
(11, 36, 11, '', 1, 1, 0, '2019-05-28 19:48:20', '2019-05-28 19:48:20'),
(12, 37, 14, '', 1, 1, 0, '2019-05-28 20:00:49', '2019-05-28 20:00:49'),
(14, 1, 1, '', 1, 1, 0, '2019-05-28 20:44:33', '2019-05-28 20:44:33'),
(15, 2, 3, '', 1, 1, 0, '2019-05-28 20:44:39', '2019-05-28 20:44:39'),
(16, 35, 15, '', 1, 1, 0, '2019-05-30 10:34:24', '2019-05-30 10:34:24'),
(17, 38, 16, '', 1, 1, 0, '2019-06-05 14:07:14', '2019-06-05 14:07:14');

-- --------------------------------------------------------

--
-- 表的结构 `c2_region`
--

CREATE TABLE `c2_region` (
  `id` bigint(20) NOT NULL,
  `type` tinyint(4) DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_region_rs`
--

CREATE TABLE `c2_region_rs` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT '0',
  `child_id` bigint(20) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `c2_user_grp_rs`
--

CREATE TABLE `c2_user_grp_rs` (
  `id` bigint(20) NOT NULL,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_user_grp_rs`
--

INSERT INTO `c2_user_grp_rs` (`id`, `grp_id`, `user_id`, `state`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 1, 1, 0, '2019-05-22 08:50:17', '2019-05-22 08:50:17'),
(2, 7, 4, 1, 1, 0, '2019-05-22 09:20:41', '2019-05-22 09:20:41'),
(3, 7, 1, 1, 1, 0, '2019-05-24 16:29:40', '2019-05-24 16:29:40'),
(4, 7, 8, 1, 1, 0, '2019-05-26 12:12:45', '2019-05-26 12:12:45'),
(5, 7, 7, 1, 1, 0, '2019-05-26 18:16:22', '2019-05-26 18:16:22');

-- --------------------------------------------------------

--
-- 表的结构 `c2_user_invite_code`
--

CREATE TABLE `c2_user_invite_code` (
  `id` bigint(20) NOT NULL,
  `grp_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_user_invite_code`
--

INSERT INTO `c2_user_invite_code` (`id`, `grp_id`, `user_id`, `code`, `expired_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '71fcd4', NULL, 1, '2019-05-24 00:37:56', '2019-05-24 00:37:56'),
(2, 7, 7, 'ad238e', NULL, 1, '2019-05-26 18:28:33', '2019-05-26 18:28:33'),
(3, 1, 4, 'a592fb', NULL, 1, '2019-05-28 19:30:40', '2019-05-28 19:30:40'),
(4, 1, 14, '475780', NULL, 1, '2019-05-28 20:01:08', '2019-05-28 20:01:08'),
(5, 1, 15, '2219e6', NULL, 1, '2019-05-30 10:36:40', '2019-05-30 10:36:40');

-- --------------------------------------------------------

--
-- 表的结构 `c2_user_kpi`
--

CREATE TABLE `c2_user_kpi` (
  `id` bigint(20) NOT NULL,
  `grp_id` bigint(20) NOT NULL DEFAULT '0',
  `join_user_id` bigint(20) NOT NULL DEFAULT '0',
  `invite_user_id` bigint(20) DEFAULT NULL,
  `grp_station_id` bigint(20) DEFAULT NULL,
  `c1_id` bigint(20) DEFAULT NULL,
  `dues` decimal(10,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_user_kpi`
--

INSERT INTO `c2_user_kpi` (`id`, `grp_id`, `join_user_id`, `invite_user_id`, `grp_station_id`, `c1_id`, `dues`, `type`, `state`, `status`, `position`, `created_at`, `updated_at`) VALUES
(3, 1, 11, 4, 36, 2, '2121.00', NULL, 4, 1, 0, '2019-05-28 19:37:45', '2019-05-28 19:48:20'),
(4, 1, 13, 4, NULL, NULL, NULL, NULL, 1, 1, 0, '2019-05-28 19:51:05', '2019-05-28 19:51:05'),
(5, 1, 14, 4, 37, 2, '2333.00', NULL, 4, 1, 0, '2019-05-28 19:59:58', '2019-05-28 20:00:49'),
(6, 1, 15, 4, 35, 2, '10000.00', NULL, 4, 1, 0, '2019-05-29 12:29:34', '2019-05-30 10:34:24'),
(7, 1, 16, 4, 38, 1, '10000.00', NULL, 4, 1, 0, '2019-06-05 14:05:13', '2019-06-05 14:07:14');

-- --------------------------------------------------------

--
-- 表的结构 `c2_user_profit`
--

CREATE TABLE `c2_user_profit` (
  `id` bigint(20) NOT NULL,
  `type` int(11) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_user_profit`
--

INSERT INTO `c2_user_profit` (`id`, `type`, `user_id`, `income`, `state`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 4, '100.00', NULL, 1, '2019-06-05 14:09:09', '2019-06-05 14:09:09'),
(2, 0, 15, '100.00', NULL, 1, '2019-06-05 14:09:13', '2019-06-05 14:09:13');

-- --------------------------------------------------------

--
-- 表的结构 `c2_user_profit_item`
--

CREATE TABLE `c2_user_profit_item` (
  `id` bigint(20) NOT NULL,
  `type` tinyint(4) DEFAULT '1',
  `kpi_id` bigint(20) DEFAULT NULL,
  `grp_id` bigint(20) DEFAULT '0',
  `user_id` bigint(20) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `c2_user_profit_item`
--

INSERT INTO `c2_user_profit_item` (`id`, `type`, `kpi_id`, `grp_id`, `user_id`, `income`, `state`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, 4, '100.00', 1, 1, '2019-06-05 14:09:09', '2019-06-05 14:09:09'),
(2, 1, 7, 1, 15, '100.00', 1, 1, '2019-06-05 14:09:13', '2019-06-05 14:09:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c2_auth_assignment`
--
ALTER TABLE `c2_auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `c2_auth_item`
--
ALTER TABLE `c2_auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `c2_auth_item_child`
--
ALTER TABLE `c2_auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `c2_auth_rule`
--
ALTER TABLE `c2_auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `c2_be_user`
--
ALTER TABLE `c2_be_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`username`),
  ADD KEY `Index_2` (`email`),
  ADD KEY `Index_3` (`type`),
  ADD KEY `Index_4` (`open_id`);

--
-- Indexes for table `c2_be_user_profile`
--
ALTER TABLE `c2_be_user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`);

--
-- Indexes for table `c2_city`
--
ALTER TABLE `c2_city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`name`),
  ADD KEY `Index_2` (`country_code`);

--
-- Indexes for table `c2_config`
--
ALTER TABLE `c2_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`code`(191)),
  ADD KEY `Index_2` (`label`(191)),
  ADD KEY `Index_3` (`type`);

--
-- Indexes for table `c2_country`
--
ALTER TABLE `c2_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`code`),
  ADD KEY `Index_2` (`name`);

--
-- Indexes for table `c2_country_language`
--
ALTER TABLE `c2_country_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`country_code`),
  ADD KEY `Index_2` (`language`(191));

--
-- Indexes for table `c2_fe_user`
--
ALTER TABLE `c2_fe_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`username`(191)),
  ADD KEY `Index_2` (`email`(191)),
  ADD KEY `Index_3` (`type`),
  ADD KEY `Index_4` (`open_id`(191)),
  ADD KEY `Index_5` (`wechat_open_id`(191)),
  ADD KEY `Index_6` (`access_token`(191),`status`),
  ADD KEY `Index_7` (`mobile_number`(191));

--
-- Indexes for table `c2_fe_user_profile`
--
ALTER TABLE `c2_fe_user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`);

--
-- Indexes for table `c2_grp`
--
ALTER TABLE `c2_grp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`geo_latitude`(191),`geo_longitude`(191)),
  ADD KEY `Index_2` (`label`(191)),
  ADD KEY `Index_3` (`type`),
  ADD KEY `Index_4` (`province_id`,`city_id`,`district_id`),
  ADD KEY `Index_5` (`seo_code`(191)) USING BTREE;

--
-- Indexes for table `c2_grp_branch`
--
ALTER TABLE `c2_grp_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`grp_id`),
  ADD KEY `Index_2` (`parent_id`);

--
-- Indexes for table `c2_grp_profile`
--
ALTER TABLE `c2_grp_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`grp_id`);

--
-- Indexes for table `c2_grp_station`
--
ALTER TABLE `c2_grp_station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`grp_id`),
  ADD KEY `Index_2` (`parent_station_id`);

--
-- Indexes for table `c2_grp_station_item`
--
ALTER TABLE `c2_grp_station_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`),
  ADD KEY `Index_2` (`grp_station_id`);

--
-- Indexes for table `c2_region`
--
ALTER TABLE `c2_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`type`,`label`(191)),
  ADD KEY `Index_2` (`type`,`code`(191));

--
-- Indexes for table `c2_region_rs`
--
ALTER TABLE `c2_region_rs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`parent_id`),
  ADD KEY `Index_2` (`child_id`),
  ADD KEY `Index_3` (`parent_id`,`child_id`);

--
-- Indexes for table `c2_user_grp_rs`
--
ALTER TABLE `c2_user_grp_rs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`),
  ADD KEY `Index_2` (`grp_id`);

--
-- Indexes for table `c2_user_invite_code`
--
ALTER TABLE `c2_user_invite_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`),
  ADD KEY `Index_2` (`grp_id`);

--
-- Indexes for table `c2_user_kpi`
--
ALTER TABLE `c2_user_kpi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`join_user_id`),
  ADD KEY `Index_2` (`grp_id`),
  ADD KEY `Index_3` (`invite_user_id`),
  ADD KEY `Index_4` (`c1_id`),
  ADD KEY `Index_5` (`c1_id`);

--
-- Indexes for table `c2_user_profit`
--
ALTER TABLE `c2_user_profit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`);

--
-- Indexes for table `c2_user_profit_item`
--
ALTER TABLE `c2_user_profit_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Index_1` (`user_id`),
  ADD KEY `Index_2` (`kpi_id`),
  ADD KEY `Index_3` (`grp_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `c2_be_user`
--
ALTER TABLE `c2_be_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `c2_be_user_profile`
--
ALTER TABLE `c2_be_user_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `c2_city`
--
ALTER TABLE `c2_city`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_config`
--
ALTER TABLE `c2_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_country`
--
ALTER TABLE `c2_country`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_country_language`
--
ALTER TABLE `c2_country_language`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_fe_user`
--
ALTER TABLE `c2_fe_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `c2_fe_user_profile`
--
ALTER TABLE `c2_fe_user_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_grp`
--
ALTER TABLE `c2_grp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `c2_grp_branch`
--
ALTER TABLE `c2_grp_branch`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_grp_profile`
--
ALTER TABLE `c2_grp_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_grp_station`
--
ALTER TABLE `c2_grp_station`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `c2_grp_station_item`
--
ALTER TABLE `c2_grp_station_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `c2_region`
--
ALTER TABLE `c2_region`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_region_rs`
--
ALTER TABLE `c2_region_rs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `c2_user_grp_rs`
--
ALTER TABLE `c2_user_grp_rs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `c2_user_invite_code`
--
ALTER TABLE `c2_user_invite_code`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `c2_user_kpi`
--
ALTER TABLE `c2_user_kpi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `c2_user_profit`
--
ALTER TABLE `c2_user_profit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `c2_user_profit_item`
--
ALTER TABLE `c2_user_profit_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 限制导出的表
--

--
-- 限制表 `c2_auth_assignment`
--
ALTER TABLE `c2_auth_assignment`
  ADD CONSTRAINT `c2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `c2_auth_item`
--
ALTER TABLE `c2_auth_item`
  ADD CONSTRAINT `c2_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `c2_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `c2_auth_item_child`
--
ALTER TABLE `c2_auth_item_child`
  ADD CONSTRAINT `c2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `c2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
