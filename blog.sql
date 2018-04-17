-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-17 03:58:01
-- 服务器版本： 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE `tp_admin` (
  `id` mediumint(9) NOT NULL,
  `username` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '修改时间',
  `role_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '角色id',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '管理员状态：1启用，0禁用',
  `delete_time` int(11) DEFAULT NULL COMMENT '软删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `username`, `password`, `create_time`, `update_time`, `role_id`, `status`, `delete_time`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 1, NULL),
(2, 'rybin', 'e10adc3949ba59abbe56e057f20f883e', 1541300502, 1541300502, 1, 1, NULL),
(23, 'test', 'e10adc3949ba59abbe56e057f20f883e', 1523516119, 1523516494, 1, 0, NULL),
(24, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 1523517157, 1523933900, 1, 1, 1523933900);

-- --------------------------------------------------------

--
-- 表的结构 `tp_article`
--

CREATE TABLE `tp_article` (
  `id` mediumint(9) NOT NULL COMMENT '文章id',
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `author` varchar(30) NOT NULL COMMENT '文章作者',
  `desc` varchar(255) NOT NULL COMMENT '文章简介',
  `keywords` varchar(255) NOT NULL COMMENT '文章关键词',
  `content` text NOT NULL COMMENT '文章内容',
  `pic` varchar(100) NOT NULL COMMENT '缩略图',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '点击数',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `cateid` mediumint(9) NOT NULL COMMENT '所属栏目',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_article`
--

INSERT INTO `tp_article` (`id`, `title`, `author`, `desc`, `keywords`, `content`, `pic`, `click`, `state`, `cateid`, `delete_time`, `create_time`, `update_time`) VALUES
(9, 'test', 'test', 'test', 'test', 'test', '/uploads/20180412\\e3ab4c9f96b6a07cd039c72953ed7cf6.jpg', 0, 1, 2, 1523518302, NULL, 1523518302),
(10, '测试', '测试', '测试', '测试', '测的', '/uploads/20180412\\2974ab41a041603717268d6927c918a9.jpg', 0, 1, 1, NULL, 1523520932, 1523520932);

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth`
--

CREATE TABLE `tp_auth` (
  `id` smallint(6) UNSIGNED NOT NULL COMMENT '权限id',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '权限名称',
  `pid` smallint(6) UNSIGNED NOT NULL COMMENT '父id',
  `model` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '模块',
  `action` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT '操作方法',
  `path` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '全路径',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '级别',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `tp_auth`
--

INSERT INTO `tp_auth` (`id`, `name`, `pid`, `model`, `action`, `path`, `level`, `delete_time`, `create_time`, `update_time`) VALUES
(1, '管理员管理', 0, '‘’', '‘’', '1', 0, NULL, NULL, 1523932712),
(2, '分类管理', 0, '‘’', '‘’', '2', 0, NULL, NULL, NULL),
(3, '文章管理', 0, '‘’', '‘’', '3', 0, NULL, NULL, 1523932873),
(4, '链接管理', 0, '‘’', '‘’', '4', 0, NULL, NULL, 1523933849),
(5, '标签管理', 0, '‘’', '‘’', '5', 0, NULL, NULL, NULL),
(6, '管理员列表', 1, 'admin', 'lst', '1-6', 1, NULL, NULL, NULL),
(7, '添加管理员', 1, 'admin', 'add', '1-7', 1, NULL, NULL, NULL),
(9, '分类列表', 2, 'cate', 'lst', '2-9', 1, NULL, NULL, NULL),
(10, '分类添加', 2, 'cate', 'add', '2-10', 1, NULL, NULL, NULL),
(12, '文章列表', 3, 'article', 'lst', '3-12', 1, NULL, NULL, NULL),
(13, '文章添加', 3, 'article', 'add', '3-13', 1, NULL, NULL, NULL),
(15, '链接列表', 4, 'links', 'lst', '4-15', 1, NULL, NULL, NULL),
(16, '链接添加', 4, 'links', 'add', '4-16', 1, NULL, NULL, NULL),
(18, '标签列表', 5, 'tags', 'lst', '5-18', 1, NULL, NULL, NULL),
(19, '标签添加', 5, 'tags', 'add', '5-19', 1, NULL, NULL, NULL),
(21, '角色管理', 0, '\'\'', '\'\'', '21', 0, NULL, NULL, NULL),
(22, '角色列表', 21, 'role', 'lst', '21-22', 1, NULL, NULL, NULL),
(23, '角色添加', 21, 'role', 'add', '21-23', 1, NULL, NULL, NULL),
(34, '权限管理', 0, '‘’', '‘’', '34', 0, NULL, NULL, 1523866199),
(35, '权限添加', 34, 'auth', 'add', '34-35', 1, NULL, NULL, 1523866247),
(36, '权限列表', 34, 'auth', 'lst', '34-36', 1, NULL, NULL, 1523866304),
(37, '测试专用11111', 1, '‘’', '‘’', '1-37', 1, 1523932601, 1523932224, 1523932601);

-- --------------------------------------------------------

--
-- 表的结构 `tp_cate`
--

CREATE TABLE `tp_cate` (
  `id` mediumint(9) NOT NULL COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_cate`
--

INSERT INTO `tp_cate` (`id`, `catename`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '网站模板1', NULL, 1523520556, NULL),
(2, '个人日记', NULL, 1523517679, 1523517679),
(3, 'php技术', NULL, NULL, NULL),
(4, '关于RyBin', NULL, 1523930239, 1523930239),
(6, '留言版', NULL, 1523517690, 1523517690),
(12, '测试', 1523520581, 1523520581, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_links`
--

CREATE TABLE `tp_links` (
  `id` mediumint(9) NOT NULL COMMENT '链接id',
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `url` varchar(60) NOT NULL COMMENT '链接地址',
  `desc` varchar(255) NOT NULL COMMENT '链接说明',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_links`
--

INSERT INTO `tp_links` (`id`, `title`, `url`, `desc`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '百度', 'http://www.baidu.com', '', NULL, 1523519532, 1523519532),
(4, '测试1', 'www.ceshi.com', '测试', 1523519782, 1523520156, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tp_role`
--

CREATE TABLE `tp_role` (
  `id` smallint(6) UNSIGNED NOT NULL COMMENT '角色id',
  `name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '角色名称',
  `auth_ids` varchar(128) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限ids',
  `auth_am` text CHARACTER SET utf8 COMMENT '模块操作',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `tp_role`
--

INSERT INTO `tp_role` (`id`, `name`, `auth_ids`, `auth_am`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '测试角色1', '1,6,2,9,3,12', '‘’-‘’,‘’-‘’,‘’-‘’,admin-lst,cate-lst,article-lst', NULL, 1523929721, NULL),
(3, '测试管理', '2,9,10,3,12,13', '‘’-‘’,‘’-‘’,cate-lst,cate-add,article-lst,article-add', 1523870192, 1523929740, NULL),
(4, '删除专用', NULL, NULL, 1523930064, 1523930149, 1523930149),
(5, '在测试', NULL, NULL, 1523930210, 1523930217, 1523930217);

-- --------------------------------------------------------

--
-- 表的结构 `tp_tags`
--

CREATE TABLE `tp_tags` (
  `id` mediumint(9) NOT NULL COMMENT 'tag标签id',
  `tagname` varchar(30) NOT NULL COMMENT 'tag标签名称',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_tags`
--

INSERT INTO `tp_tags` (`id`, `tagname`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '日记', NULL, NULL, NULL),
(2, 'php', NULL, NULL, NULL),
(4, '趣闻', NULL, 1523521277, 1523521277);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tp_admin`
--
ALTER TABLE `tp_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_article`
--
ALTER TABLE `tp_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_auth`
--
ALTER TABLE `tp_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_cate`
--
ALTER TABLE `tp_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_links`
--
ALTER TABLE `tp_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_role`
--
ALTER TABLE `tp_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_tags`
--
ALTER TABLE `tp_tags`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_admin`
--
ALTER TABLE `tp_admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- 使用表AUTO_INCREMENT `tp_article`
--
ALTER TABLE `tp_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章id', AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `tp_auth`
--
ALTER TABLE `tp_auth`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限id', AUTO_INCREMENT=38;
--
-- 使用表AUTO_INCREMENT `tp_cate`
--
ALTER TABLE `tp_cate`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '栏目id', AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `tp_links`
--
ALTER TABLE `tp_links`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '链接id', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_role`
--
ALTER TABLE `tp_role`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色id', AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `tp_tags`
--
ALTER TABLE `tp_tags`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'tag标签id', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
