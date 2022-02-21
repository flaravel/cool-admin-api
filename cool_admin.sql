-- -------------------------------------------------------------
-- TablePlus 3.11.0(352)
--
-- https://tableplus.com/
--
-- Database: cool_admin
-- Generation Time: 2022-02-21 23:34:27.5010
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `admin_menus`;
CREATE TABLE `admin_menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned DEFAULT NULL COMMENT '父菜单ID',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `router` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单地址',
  `perms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限标识',
  `type` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '类型 0：目录 1：菜单 2：按钮',
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `order_num` int unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `view_path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '视图地址',
  `keep_alive` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '路由缓存',
  `is_show` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '是否展示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色标签',
  `relevance` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '数据权限是否关联上下级',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int unsigned NOT NULL DEFAULT '0' COMMENT '部门ID',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '状态 0:禁用 1：启用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nick_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `phone` char(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_role_menus`;
CREATE TABLE `admin_role_menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `role_id` int unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_user_roles`;
CREATE TABLE `admin_user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `role_id` int unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_departments`;
CREATE TABLE `admin_departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '部门名称',
  `order_num` int unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `admin_role_departments`;
CREATE TABLE `admin_role_departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int unsigned NOT NULL DEFAULT '0' COMMENT '部门ID',
  `role_id` int unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_menus` (`id`, `parent_id`, `name`, `router`, `perms`, `type`, `icon`, `order_num`, `view_path`, `keep_alive`, `is_show`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', NULL, '工作台', '/', '', '0', 'icon-workbench', '1', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('2', NULL, '系统管理', '/sys', '', '0', 'icon-system', '2', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('8', '27', '菜单列表', '/sys/menu', '', '1', 'icon-menu', '2', 'cool/modules/base/views/menu.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('10', '8', '新增', '', 'system:menu:add', '2', '', '1', '', '0', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('11', '8', '删除', '', 'system:menu:delete', '2', '', '2', '', '0', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('12', '8', '修改', '', 'system:menu:update', '2', '', '3', '', '0', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('13', '8', '查询', '', 'system:menu:page', '2', '', '4', '', '0', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('22', '27', '角色列表', '/sys/role', '', '1', 'icon-common', '3', 'cool/modules/base/views/role.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('23', '22', '新增', '', 'system:role:add', '2', '', '1', '', '0', '1', '2022-02-20 12:11:16', '2022-02-21 14:46:57', NULL),
('24', '22', '删除', '', 'system:role:delete', '2', '', '2', '', '0', '1', '2022-02-20 12:11:16', '2022-02-21 14:47:05', NULL),
('25', '22', '修改', '', 'system:role:update', '2', '', '3', '', '0', '1', '2022-02-20 12:11:16', '2022-02-21 14:47:16', NULL),
('26', '22', '查询', '', 'system:role:page,system:role:list,system:role:info', '2', '', '4', '', '0', '1', '2022-02-20 12:11:16', '2022-02-21 14:47:30', NULL),
('27', '2', '权限管理', '', '', '0', 'icon-auth', '1', '', '0', '1', '2022-02-20 12:11:16', '2022-02-21 08:27:35', NULL),
('29', '105', '请求日志', '/sys/log', '', '1', 'icon-log', '1', 'cool/modules/base/views/log.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:05:57', '2022-02-20 17:05:57'),
('30', '29', '权限', '', 'base:sys:log:page,base:sys:log:clear,base:sys:log:getKeep,base:sys:log:setKeep', '2', '', '1', '', '0', '1', '2022-02-20 12:11:16', '2022-02-20 17:06:01', '2022-02-20 17:06:01'),
('43', '45', 'crud 示例', '/crud', '', '1', 'icon-favor', '1', 'cool/modules/demo/views/crud.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('45', '1', '组件库', '/ui-lib', '', '0', 'icon-common', '2', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('49', '45', 'quill 富文本编辑器', '/editor-quill', '', '1', 'icon-favor', '2', 'cool/modules/demo/views/editor-quill.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('59', '97', '部门列表', '', 'system:department:page,system:department:list', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:44:25', NULL),
('60', '97', '新增部门', '', 'system:department:add', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:44:39', NULL),
('61', '97', '更新部门', '', 'system:department:update', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:44:48', NULL),
('62', '97', '删除部门', '', 'system:department:delete', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:45:00', NULL),
('63', '97', '部门排序', '', 'system:department:order', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:43:59', NULL),
('65', '97', '用户转移', '', 'base:sys:user:move', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 13:30:17', '2022-02-21 13:30:17'),
('78', '2', '参数配置', '', '', '0', 'icon-common', '4', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:34', '2022-02-20 17:16:34'),
('79', '78', '参数列表', '/sys/param', '', '1', 'icon-menu', '0', 'cool/modules/base/views/param.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:32', '2022-02-20 17:16:32'),
('80', '79', '新增', '', 'base:sys:param:add', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:30', '2022-02-20 17:16:30'),
('81', '79', '修改', '', 'base:sys:param:info,base:sys:param:update', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:28', '2022-02-20 17:16:28'),
('82', '79', '删除', '', 'base:sys:param:delete', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:26', '2022-02-20 17:16:26'),
('83', '79', '查看', '', 'base:sys:param:page,base:sys:param:list,base:sys:param:info', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-20 17:16:24', '2022-02-20 17:16:24'),
('86', '45', '文件上传', '/upload', '', '1', 'icon-favor', '3', 'cool/modules/demo/views/upload.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('96', '1', '组件预览', '/demo', '', '1', 'icon-favor', '0', 'cool/modules/demo/views/demo.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('97', '27', '用户列表', '/sys/user', '', '1', 'icon-user', '0', 'cool/modules/base/views/user.vue', '1', '1', '2022-02-20 12:11:16', '2022-02-20 12:11:16', NULL),
('98', '97', '新增', '', 'system:user:add', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:45:41', NULL),
('99', '97', '删除', '', 'system:user:delete', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:45:53', NULL),
('100', '97', '修改', '', 'system:user:update', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:46:02', NULL),
('101', '97', '查询', '', 'system:user:list,system:user:info,system:user:page', '2', '', '0', '', '1', '1', '2022-02-20 12:11:16', '2022-02-21 14:46:14', NULL),
('122', NULL, 'demo', '', '', '0', 'icon-like', '3', '', '1', '1', '2022-02-20 17:29:46', '2022-02-20 17:31:59', '2022-02-20 17:31:59'),
('123', '122', '测试菜单', '/demo/test', '', '1', 'icon-info', '1', 'views/home/index.vue', '0', '1', '2022-02-20 17:30:24', '2022-02-20 17:31:55', '2022-02-20 17:31:55');

INSERT INTO `admin_roles` (`id`, `user_id`, `name`, `remark`, `label`, `relevance`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1', '0', '超级管理员', '超级管理员', 'admin', '1', '2022-02-21 18:29:11', '2022-02-21 12:42:59', NULL),
('10', '1', '系统管理员', '', 'admin-sys', '1', '2022-02-21 05:54:20', '2022-02-21 13:14:08', '2022-02-21 13:14:08'),
('14', '0', '测试角色', '测试', 'test', '1', '2022-02-21 10:04:52', '2022-02-21 13:14:06', '2022-02-21 13:14:06'),
('19', '0', 'test', '', 'test', '1', '2022-02-21 15:17:08', '2022-02-21 15:17:08', NULL);

INSERT INTO `admin_users` (`id`, `department_id`, `name`, `username`, `password`, `avatar`, `email`, `status`, `created_at`, `updated_at`, `nick_name`, `phone`, `remark`) VALUES
('1', '1', 'admin', 'admin', '$2y$10$gGl/C4d7tNOMZn/ktemEnurhnnNW/sxRz7Dt2s7RuawtzThiPOFMK', 'https://zy-1309318760.cos.ap-shanghai.myqcloud.com/zy/dq3w8Cp9819ZzSJr6XfT6p4msII5tQcJnFt221u7.png', 'flaravel7@gmail.com', '1', '2022-02-21 13:09:28', '2022-02-21 13:09:28', 'jieke', '18507193432', '超级管理员'),
('12', '1', 'test', 'test', '$2y$10$3chaK32kFZO4ySgMJvwBvOtoiOI2gloGJ1XVMHRkYypy4IIHqrbkK', 'http://dengxian_admin.test/storage/20220221/Z1fp8aGUGlc7KMF3fgX8TqeZOeoGo1Qi4WTeaXAs.jpg', '', '1', '2022-02-21 14:49:31', '2022-02-21 15:17:32', 'test', '', '');

INSERT INTO `admin_role_menus` (`id`, `menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
('101', '1', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('102', '96', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('103', '45', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('104', '43', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('105', '49', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('106', '86', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('107', '2', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('108', '27', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('109', '97', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('110', '59', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('111', '60', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('112', '61', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('113', '62', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('114', '63', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('115', '98', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('116', '99', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('117', '100', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('118', '101', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('119', '8', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('120', '10', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('121', '11', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('122', '12', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('123', '13', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('124', '22', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('125', '23', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('126', '24', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('127', '25', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('128', '26', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('153', '1', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('154', '96', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('155', '45', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('156', '43', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('157', '49', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('158', '86', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('159', '59', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('160', '63', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('161', '101', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('162', '2', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('163', '27', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05'),
('164', '97', '19', '2022-02-21 15:33:05', '2022-02-21 15:33:05');

INSERT INTO `admin_user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
('4', '6', '1', '2022-02-21 09:14:45', '2022-02-21 09:14:45'),
('5', '6', '11', '2022-02-21 09:14:45', '2022-02-21 09:14:45'),
('6', '6', '13', '2022-02-21 09:14:45', '2022-02-21 09:14:45'),
('10', '8', '11', '2022-02-21 09:54:41', '2022-02-21 09:54:41'),
('11', '8', '12', '2022-02-21 09:54:41', '2022-02-21 09:54:41'),
('13', '9', '17', '2022-02-21 13:22:12', '2022-02-21 13:22:12'),
('17', '10', '17', '2022-02-21 13:24:37', '2022-02-21 13:24:37'),
('18', '11', '17', '2022-02-21 13:35:46', '2022-02-21 13:35:46'),
('19', '1', '1', '2022-02-21 22:35:51', '2022-02-21 22:35:51'),
('25', '12', '19', '2022-02-21 15:17:50', '2022-02-21 15:17:50');

INSERT INTO `admin_departments` (`id`, `parent_id`, `name`, `order_num`, `created_at`, `updated_at`) VALUES
('1', '0', 'COOL', '0', '2022-02-21 03:59:52', '2022-02-21 15:33:25'),
('17', '1', '测试', '1', '2022-02-21 14:50:23', '2022-02-21 15:33:25');

INSERT INTO `admin_role_departments` (`id`, `department_id`, `role_id`, `created_at`, `updated_at`) VALUES
('1', '1', '16', '2022-02-21 10:17:16', '2022-02-21 10:17:16'),
('2', '11', '16', '2022-02-21 10:17:16', '2022-02-21 10:17:16'),
('3', '12', '16', '2022-02-21 10:17:16', '2022-02-21 10:17:16'),
('4', '13', '16', '2022-02-21 10:17:16', '2022-02-21 10:17:16'),
('13', '1', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45'),
('14', '17', '1', '2022-02-21 15:06:45', '2022-02-21 15:06:45');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;