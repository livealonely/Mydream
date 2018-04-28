-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-28 16:38:57
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app2`
--

-- --------------------------------------------------------

--
-- 表的结构 `app2_admin`
--

CREATE TABLE `app2_admin` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `encrypt` varchar(6) DEFAULT NULL,
  `lastloginip` varchar(15) DEFAULT NULL,
  `lastlogintime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT NULL,
  `realname` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_admin`
--

INSERT INTO `app2_admin` (`userid`, `username`, `password`, `roleid`, `encrypt`, `lastloginip`, `lastlogintime`, `email`, `realname`) VALUES
(1, 'twp584', 'f0d884322f35f4d2ecdd176d70957a90', 1, 'mKNYUB', '127.0.0.1', 1524923845, '506188980@qq.com', '陶文鹏'),
(6, 'twp', '73e46db717a3c336c470c6ada1667c79', 2, 'thzSOH', NULL, 0, '506188@qq.cp', 'adsad');

-- --------------------------------------------------------

--
-- 表的结构 `app2_admin_role`
--

CREATE TABLE `app2_admin_role` (
  `roleid` tinyint(3) UNSIGNED NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `listorder` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `disabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_admin_role`
--

INSERT INTO `app2_admin_role` (`roleid`, `rolename`, `description`, `listorder`, `disabled`) VALUES
(1, '超级管理员', '超级管理员', 0, 0),
(2, '普通用户', '普通用户', 0, 0),
(5, '大哥', '啊', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `app2_admin_role_priv`
--

CREATE TABLE `app2_admin_role_priv` (
  `roleid` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_category`
--

CREATE TABLE `app2_category` (
  `catid` smallint(5) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `parentid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `catname` varchar(30) NOT NULL,
  `description` mediumtext NOT NULL,
  `url` varchar(100) NOT NULL,
  `setting` mediumtext NOT NULL,
  `listorder` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_category`
--

INSERT INTO `app2_category` (`catid`, `type`, `parentid`, `catname`, `description`, `url`, `setting`, `listorder`, `ismenu`) VALUES
(2, 0, 0, '订单管理', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `app2_category_priv`
--

CREATE TABLE `app2_category_priv` (
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `roleid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `action` char(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_link`
--

CREATE TABLE `app2_link` (
  `linkid` smallint(5) UNSIGNED NOT NULL,
  `linktype` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `introduce` text NOT NULL,
  `listorder` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `passed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_log`
--

CREATE TABLE `app2_log` (
  `logid` int(10) UNSIGNED NOT NULL,
  `controller` varchar(15) NOT NULL,
  `action` varchar(20) NOT NULL,
  `querystring` mediumtext NOT NULL,
  `userid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_member`
--

CREATE TABLE `app2_member` (
  `memberid` mediumint(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `department` tinyint(6) NOT NULL,
  `job` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `QQ` varchar(32) NOT NULL,
  `wechat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_member`
--

INSERT INTO `app2_member` (`memberid`, `username`, `password`, `department`, `job`, `phone`, `QQ`, `wechat`) VALUES
(1, '陶文鹏', '', 1, '组长', '111', '111', 'wechat'),
(2, '司马干', '', 13, 'ada', '123', '123', '123'),
(3, '张三', '', 1, '司令', '123', '132', ''),
(4, '张三', '', 11, '司令', '123', '132', '');

-- --------------------------------------------------------

--
-- 表的结构 `app2_member_role`
--

CREATE TABLE `app2_member_role` (
  `m_roleid` tinyint(3) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_member_role`
--

INSERT INTO `app2_member_role` (`m_roleid`, `rolename`, `description`, `disabled`) VALUES
(1, '办公室', '这是办公室啊', 0),
(11, '工程部', '这是工程部', 0),
(13, '生产部', '这是生产部', 0);

-- --------------------------------------------------------

--
-- 表的结构 `app2_menu`
--

CREATE TABLE `app2_menu` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` char(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `c` char(20) NOT NULL DEFAULT '',
  `a` char(20) NOT NULL DEFAULT '',
  `data` char(255) NOT NULL DEFAULT '',
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  `listorder` smallint(6) UNSIGNED NOT NULL DEFAULT '0',
  `display` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `app2_menu`
--

INSERT INTO `app2_menu` (`id`, `name`, `parentid`, `c`, `a`, `data`, `is_system`, `listorder`, `display`) VALUES
(1, '我的面板', 0, 'Admin', 'public_top', '', 1, 1, '1'),
(2, '系统设置', 0, 'Setting', 'top', '', 0, 2, '1'),
(3, '内容管理', 0, 'Content', 'top', '', 0, 3, '1'),
(4, '员工管理', 0, 'Member', 'top', '', 0, 4, '1'),
(5, '后台管理', 0, 'System', 'top', '', 0, 5, '1'),
(6, '个人信息', 1, 'Admin', 'public_left', '', 1, 0, '1'),
(7, '修改密码', 6, 'Admin', 'public_editPwd', '', 1, 1, '1'),
(8, '修改个人信息', 6, 'Admin', 'public_editInfo', '', 1, 0, '1'),
(9, '系统设置', 2, 'Setting', 'left', '', 0, 1, '1'),
(10, '站点设置', 9, 'Setting', 'site', '', 0, 1, '1'),
(11, '管理员设置', 2, 'Admin', 'left', '', 0, 2, '1'),
(12, '管理员管理', 11, 'Admin', 'memberList', '', 0, 1, '1'),
(13, '角色管理', 11, 'Admin', 'roleList', '', 0, 2, '1'),
(14, '后台管理', 5, 'System', 'left', '', 0, 1, '1'),
(15, '日志管理', 14, 'System', 'logList', '', 0, 1, '1'),
(16, '菜单管理', 14, 'System', 'menuList', '', 0, 2, '1'),
(17, '查看菜单', 16, 'System', 'menuView', '', 0, 0, '1'),
(18, '添加菜单', 16, 'System', 'menuAdd', '', 0, 0, '1'),
(19, '修改菜单', 16, 'System', 'menuEdit', '', 0, 0, '1'),
(20, '删除菜单', 16, 'System', 'menuDelete', '', 0, 0, '1'),
(21, '菜单排序', 16, 'System', 'menuOrder', '', 0, 0, '1'),
(22, '查看日志', 15, 'System', 'logView', '', 0, 0, '1'),
(23, '删除日志', 15, 'System', 'logDelete', '', 0, 0, '1'),
(24, '查看管理员', 12, 'Admin', 'memberView', '', 0, 0, '1'),
(25, '添加管理员', 12, 'Admin', 'memberAdd', '', 0, 0, '1'),
(26, '编辑管理员', 12, 'Admin', 'memberEdit', '', 0, 0, '1'),
(27, '删除管理员', 12, 'Admin', 'memberDelete', '', 0, 0, '1'),
(28, '查看角色', 13, 'Admin', 'roleView', '', 0, 0, '1'),
(29, '添加角色', 13, 'Admin', 'roleAdd', '', 0, 0, '1'),
(30, '编辑角色', 13, 'Admin', 'roleEdit', '', 0, 0, '1'),
(31, '删除角色', 13, 'Admin', 'roleDelete', '', 0, 0, '1'),
(32, '角色排序', 13, 'Admin', 'roleOrder', '', 0, 0, '1'),
(33, '权限设置', 13, 'Admin', 'roleSet', '', 0, 0, '1'),
(34, '发布管理', 3, 'Content', 'left', '', 0, 0, '1'),
(35, '内容管理', 34, 'Content', 'index', '', 0, 0, '1'),
(36, '栏目管理', 34, 'Category', 'categoryList', '', 0, 0, '1'),
(37, '查看栏目', 36, 'Category', 'categoryView', '', 0, 0, '1'),
(38, '添加栏目', 36, 'Category', 'categoryAdd', '', 0, 0, '1'),
(39, '编辑栏目', 36, 'Category', 'categoryEdit', '', 0, 0, '1'),
(40, '删除栏目', 36, 'Category', 'categoryDelete', '', 0, 0, '1'),
(41, '栏目排序', 36, 'Category', 'categoryOrder', '', 0, 0, '1'),
(42, '员工中心', 4, 'Member', 'left', '', 0, 0, '1'),
(43, '员工列表', 42, 'Member', 'memberList', '', 0, 0, '1'),
(44, '员工分类', 42, 'Member', 'typeList', '', 0, 0, '0'),
(45, '订单管理', 0, 'Order', 'index', '', 0, 0, '1'),
(46, '订单中心', 45, 'Order', 'index', '', 0, 0, '1'),
(47, '任务管理', 0, 'Work', 'work', '', 0, 0, '1'),
(48, '任务中心', 47, 'Work', 'workList', '', 0, 0, '1'),
(49, '部门管理', 42, 'Member', 'roleList', '', 0, 0, '1'),
(50, '订单信息', 46, 'Order', 'orderList', '', 0, 0, '1');

-- --------------------------------------------------------

--
-- 表的结构 `app2_news`
--

CREATE TABLE `app2_news` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '1',
  `islink` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_order`
--

CREATE TABLE `app2_order` (
  `orderid` mediumint(6) NOT NULL,
  `order_name` varchar(32) NOT NULL,
  `company` varchar(32) NOT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `finished_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `department` tinyint(6) NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0未完成 1完成 2 放弃',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_page`
--

CREATE TABLE `app2_page` (
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(160) NOT NULL,
  `keywords` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `updatetime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_setting`
--

CREATE TABLE `app2_setting` (
  `key` varchar(50) NOT NULL,
  `value` varchar(5000) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `app2_times`
--

CREATE TABLE `app2_times` (
  `username` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `logintime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `times` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app2_admin`
--
ALTER TABLE `app2_admin`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `app2_admin_role`
--
ALTER TABLE `app2_admin_role`
  ADD PRIMARY KEY (`roleid`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `app2_admin_role_priv`
--
ALTER TABLE `app2_admin_role_priv`
  ADD KEY `roleid` (`roleid`,`c`,`a`);

--
-- Indexes for table `app2_category`
--
ALTER TABLE `app2_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `app2_category_priv`
--
ALTER TABLE `app2_category_priv`
  ADD KEY `catid` (`catid`,`roleid`,`is_admin`,`action`);

--
-- Indexes for table `app2_link`
--
ALTER TABLE `app2_link`
  ADD PRIMARY KEY (`linkid`);

--
-- Indexes for table `app2_log`
--
ALTER TABLE `app2_log`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `module` (`controller`,`action`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `app2_member`
--
ALTER TABLE `app2_member`
  ADD PRIMARY KEY (`memberid`),
  ADD UNIQUE KEY `memberid` (`memberid`);

--
-- Indexes for table `app2_member_role`
--
ALTER TABLE `app2_member_role`
  ADD PRIMARY KEY (`m_roleid`);

--
-- Indexes for table `app2_menu`
--
ALTER TABLE `app2_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `parentid` (`parentid`),
  ADD KEY `module` (`c`,`a`);

--
-- Indexes for table `app2_news`
--
ALTER TABLE `app2_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`,`listorder`,`id`),
  ADD KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  ADD KEY `catid` (`catid`,`status`,`id`);

--
-- Indexes for table `app2_order`
--
ALTER TABLE `app2_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `app2_page`
--
ALTER TABLE `app2_page`
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `app2_setting`
--
ALTER TABLE `app2_setting`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `app2_times`
--
ALTER TABLE `app2_times`
  ADD PRIMARY KEY (`username`,`isadmin`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `app2_admin`
--
ALTER TABLE `app2_admin`
  MODIFY `userid` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `app2_admin_role`
--
ALTER TABLE `app2_admin_role`
  MODIFY `roleid` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `app2_category`
--
ALTER TABLE `app2_category`
  MODIFY `catid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `app2_link`
--
ALTER TABLE `app2_link`
  MODIFY `linkid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `app2_log`
--
ALTER TABLE `app2_log`
  MODIFY `logid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `app2_member`
--
ALTER TABLE `app2_member`
  MODIFY `memberid` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `app2_member_role`
--
ALTER TABLE `app2_member_role`
  MODIFY `m_roleid` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `app2_menu`
--
ALTER TABLE `app2_menu`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `app2_news`
--
ALTER TABLE `app2_news`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `app2_order`
--
ALTER TABLE `app2_order`
  MODIFY `orderid` mediumint(6) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
