-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2017 at 08:54 
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indoit_framework_tes`
--

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `session` varchar(100) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`session`, `time`) VALUES
('c11bf88def2825307244e016829c97a509f70975', 1497595724);

-- --------------------------------------------------------

--
-- Table structure for table `wd_backup_db`
--

CREATE TABLE `wd_backup_db` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `file` tinyint(1) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wd_data_relation`
--

CREATE TABLE `wd_data_relation` (
  `id` int(11) NOT NULL,
  `on_delete` enum('restrict','cascade') NOT NULL DEFAULT 'restrict',
  `primary_table` varchar(100) NOT NULL,
  `primary_id` varchar(100) NOT NULL,
  `relation_table` varchar(100) NOT NULL,
  `relation_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_data_relation`
--

INSERT INTO `wd_data_relation` (`id`, `on_delete`, `primary_table`, `primary_id`, `relation_table`, `relation_id`) VALUES
(19, 'cascade', 'wd_modules', 'id', 'wd_group_privileges', 'modules_id'),
(5, 'restrict', 'wd_groups', 'id', 'wd_users_groups', 'group_id'),
(6, 'restrict', 'wd_users', 'id', 'wd_users_groups', 'user_id'),
(7, 'restrict', 'wd_groups', 'id', 'wd_group_privileges', 'groups_id');

-- --------------------------------------------------------

--
-- Table structure for table `wd_groups`
--

CREATE TABLE `wd_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `no_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wd_groups`
--

INSERT INTO `wd_groups` (`id`, `name`, `description`, `no_delete`) VALUES
(1, 'super_admin', 'For Developer Only', 1),
(2, 'admin', 'Administrator', 1),
(3, 'member', 'Member', 1),
(4, 'operator', 'Operator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wd_group_privileges`
--

CREATE TABLE `wd_group_privileges` (
  `id` int(11) NOT NULL,
  `groups_id` mediumint(8) UNSIGNED NOT NULL,
  `modules_id` int(11) NOT NULL,
  `privilege` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_group_privileges`
--

INSERT INTO `wd_group_privileges` (`id`, `groups_id`, `modules_id`, `privilege`) VALUES
(1, 1, 1, '11000'),
(2, 1, 2, '11000'),
(3, 1, 3, '11111'),
(4, 1, 4, '11111'),
(5, 1, 5, '11111'),
(6, 1, 6, '11111'),
(7, 1, 7, '11000'),
(8, 1, 8, '11000'),
(9, 1, 9, '11111'),
(10, 1, 10, '11111'),
(11, 2, 1, '11111'),
(12, 2, 2, '11111'),
(13, 2, 3, '11111'),
(14, 2, 4, '11111'),
(15, 2, 5, '11111'),
(16, 2, 6, '11111'),
(17, 2, 9, '11111'),
(18, 2, 10, '11111');

-- --------------------------------------------------------

--
-- Table structure for table `wd_login_attempts`
--

CREATE TABLE `wd_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wd_migration`
--

CREATE TABLE `wd_migration` (
  `id` int(11) NOT NULL,
  `file` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `mode` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_migration`
--

INSERT INTO `wd_migration` (`id`, `file`, `date`, `mode`, `status`) VALUES
(26, '20170405_235413_all_db.sql', '2017-04-05 23:54:13', 'all', '2017-06-16 13:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `wd_modules`
--

CREATE TABLE `wd_modules` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'fa fa-circle-o',
  `url` varchar(45) DEFAULT '#',
  `parent` varchar(45) DEFAULT NULL,
  `support` varchar(5) DEFAULT '00000' COMMENT 'xxxxx\n\n1 = Admin\n1 = Read\n1 = Create\n1 = Update\n1 = Delete',
  `sort_order` int(11) DEFAULT NULL,
  `only_super` int(11) DEFAULT NULL,
  `no_delete` int(11) NOT NULL DEFAULT '0',
  `table_module` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_modules`
--

INSERT INTO `wd_modules` (`id`, `title`, `icon`, `url`, `parent`, `support`, `sort_order`, `only_super`, `no_delete`, `table_module`) VALUES
(1, 'Dahsboard', 'fa fa-dashboard', 'dashboard', '0', '10000', 1, 1, 1, NULL),
(2, 'System', 'fa fa-gear', '#', '0', '10000', 2, 0, 1, NULL),
(3, 'Users', 'fa fa-user-plus', '#', '2', '11111', 3, 0, 1, NULL),
(4, 'User', 'fa fa-user', 'users', '3', '11111', 4, 0, 1, NULL),
(5, 'Groups', 'fa fa-users', 'groups', '3', '11111', 5, 0, 1, NULL),
(6, 'Module', 'fa fa-terminal', 'module', '2', '11111', 6, 0, 1, NULL),
(7, 'Data Relation', 'fa fa-archive', 'relation', '2', '10000', 7, 1, 1, NULL),
(8, 'Migration', 'fa fa-hourglass-1', 'migration', '2', '10000', 8, 1, 1, NULL),
(9, 'Backup DB', 'fa fa-database', 'backup', '2', '11111', 9, 0, 1, NULL),
(10, 'Options', 'fa fa-bars', 'options', '2', '11111', 10, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wd_options`
--

CREATE TABLE `wd_options` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `value` text,
  `only_super` int(11) NOT NULL DEFAULT '0',
  `no_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_options`
--

INSERT INTO `wd_options` (`id`, `name`, `value`, `only_super`, `no_delete`) VALUES
(1, 'admin_email', 'admin@admin.com', 1, 1),
(2, 'super_admin_group', 'super_admin', 1, 1),
(3, 'admin_group', 'admin', 1, 1),
(4, 'default_group', 'member', 1, 1),
(5, 'identity', 'email', 1, 1),
(6, 'password_email', '123456', 1, 1),
(7, 'warranty app name', 'nama aplikasi', 0, 1),
(8, 'warranty Licence', 'lisensi', 1, 1),
(9, 'warranty guarantee', 'garansi', 1, 1),
(10, 'warranty release', 'release date', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wd_users`
--

CREATE TABLE `wd_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `no_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wd_users`
--

INSERT INTO `wd_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `no_delete`) VALUES
(1, '127.0.0.1', 'super', '$2y$08$s6Ctz9s9wBfAJM1Mf/hZAelLiVOa4MtZUG.4EzD.dl2WJFOaRvaIG', '', 'support@indonesiait.com', '', NULL, NULL, 'Vqh1rHuSW4qI0snfe1E4.u', 1268889823, 1488425598, 1, 'Super', 'Admin', 'ADMIN', '', 1),
(2, '127.0.0.1', 'admin', '$2y$08$AIiuasVsa4kyBAOhuh7HXOkBeN4TThXF3TjnlrIfxEZyw8bFnk99G', NULL, 'admin@admin.com', NULL, NULL, NULL, 'AWO6WnUKaIx4vFHcPG/JZu', 1465717020, 1466497168, 1, 'Administrator', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wd_users_groups`
--

CREATE TABLE `wd_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wd_users_groups`
--

INSERT INTO `wd_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`session`);

--
-- Indexes for table `wd_backup_db`
--
ALTER TABLE `wd_backup_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_data_relation`
--
ALTER TABLE `wd_data_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_groups`
--
ALTER TABLE `wd_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_group_privileges`
--
ALTER TABLE `wd_group_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wb_group_privilege_wb_groups1_idx` (`groups_id`),
  ADD KEY `fk_wb_group_privilege_wb_modules1_idx` (`modules_id`);

--
-- Indexes for table `wd_login_attempts`
--
ALTER TABLE `wd_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_migration`
--
ALTER TABLE `wd_migration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_modules`
--
ALTER TABLE `wd_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_options`
--
ALTER TABLE `wd_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_users`
--
ALTER TABLE `wd_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wd_users_groups`
--
ALTER TABLE `wd_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wd_backup_db`
--
ALTER TABLE `wd_backup_db`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wd_data_relation`
--
ALTER TABLE `wd_data_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `wd_groups`
--
ALTER TABLE `wd_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wd_group_privileges`
--
ALTER TABLE `wd_group_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `wd_login_attempts`
--
ALTER TABLE `wd_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wd_migration`
--
ALTER TABLE `wd_migration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `wd_modules`
--
ALTER TABLE `wd_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wd_options`
--
ALTER TABLE `wd_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `wd_users`
--
ALTER TABLE `wd_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wd_users_groups`
--
ALTER TABLE `wd_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `wd_group_privileges`
--
ALTER TABLE `wd_group_privileges`
  ADD CONSTRAINT `fk_wb_group_privilege_wb_groups1` FOREIGN KEY (`groups_id`) REFERENCES `wd_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wb_group_privilege_wb_modules1` FOREIGN KEY (`modules_id`) REFERENCES `wd_modules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wd_users_groups`
--
ALTER TABLE `wd_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `wd_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `wd_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
