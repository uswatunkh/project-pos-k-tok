-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2020 at 02:48 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_barang`
--

DROP TABLE IF EXISTS `item_barang`;
CREATE TABLE IF NOT EXISTS `item_barang` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jenis_barang` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_transaksi`
--

DROP TABLE IF EXISTS `item_transaksi`;
CREATE TABLE IF NOT EXISTS `item_transaksi` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(20) DEFAULT NULL,
  `id_item_barang` varchar(20) DEFAULT NULL,
  `jml_input` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

DROP TABLE IF EXISTS `jenis_barang`;
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_toko` varchar(20) DEFAULT NULL,
  `nama` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_toko` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kasir_toko`
--

DROP TABLE IF EXISTS `kasir_toko`;
CREATE TABLE IF NOT EXISTS `kasir_toko` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_user` int(6) NOT NULL,
  `id_toko` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir_toko`
--

INSERT INTO `kasir_toko` (`id`, `id_user`, `id_toko`) VALUES
(1, 2, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

DROP TABLE IF EXISTS `online_users`;
CREATE TABLE IF NOT EXISTS `online_users` (
  `session` varchar(100) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`session`, `time`) VALUES
('9da31799aac2fad77ca3a7852bbf825d497c755f', 1595847031),
('f5936c72e4e2746a9fc24e263246634c7002f6c8', 1595847032);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_toko` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

DROP TABLE IF EXISTS `toko`;
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `id_pemilik`, `nama`, `alamat`) VALUES
(1, 1, 'kios arif', 'jogja'),
(2, 1, 'KIOS KEDUA ARIF', 'jogja');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_toko` varchar(20) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_karyawan` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `jenis` varchar(20) NOT NULL,
  `id_pemilik` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `alamat`, `password`, `jenis`, `id_pemilik`) VALUES
(1, 'arif', 'rarif2626@gmail.com', 'jogja', '1f32aa4c9a1d2ea010adcf2348166a04', 'pemilik', 0),
(2, 'kasir_arif', 'kios_arif2626@gmail.com', 'jogja', '1f32aa4c9a1d2ea010adcf2348166a04', 'kasir', 1),
(3, 'kasir ke 3', 'arif3@gmail.com', 'jogja', '1f32aa4c9a1d2ea010adcf2348166a04', 'kasir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wd_backup_db`
--

DROP TABLE IF EXISTS `wd_backup_db`;
CREATE TABLE IF NOT EXISTS `wd_backup_db` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `file` tinyint(1) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wd_data_relation`
--

DROP TABLE IF EXISTS `wd_data_relation`;
CREATE TABLE IF NOT EXISTS `wd_data_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `on_delete` enum('restrict','cascade') NOT NULL DEFAULT 'restrict',
  `primary_table` varchar(100) NOT NULL,
  `primary_id` varchar(100) NOT NULL,
  `relation_table` varchar(100) NOT NULL,
  `relation_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `wd_groups`;
CREATE TABLE IF NOT EXISTS `wd_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `no_delete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `wd_group_privileges`;
CREATE TABLE IF NOT EXISTS `wd_group_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_id` mediumint(8) UNSIGNED NOT NULL,
  `modules_id` int(11) NOT NULL,
  `privilege` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wb_group_privilege_wb_groups1_idx` (`groups_id`),
  KEY `fk_wb_group_privilege_wb_modules1_idx` (`modules_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

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
(18, 2, 10, '11111'),
(21, 1, 13, '11111'),
(22, 1, 14, '11111'),
(23, 1, 15, '11111'),
(24, 1, 16, '11111'),
(25, 1, 17, '11111'),
(26, 1, 18, '11111'),
(27, 1, 19, '11111'),
(28, 1, 20, '11111');

-- --------------------------------------------------------

--
-- Table structure for table `wd_login_attempts`
--

DROP TABLE IF EXISTS `wd_login_attempts`;
CREATE TABLE IF NOT EXISTS `wd_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wd_migration`
--

DROP TABLE IF EXISTS `wd_migration`;
CREATE TABLE IF NOT EXISTS `wd_migration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `mode` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wd_migration`
--

INSERT INTO `wd_migration` (`id`, `file`, `date`, `mode`, `status`) VALUES
(26, '20170405_235413_all_db.sql', '2017-04-05 23:54:13', 'all', '2017-06-16 13:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `wd_modules`
--

DROP TABLE IF EXISTS `wd_modules`;
CREATE TABLE IF NOT EXISTS `wd_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'fa fa-circle-o',
  `url` varchar(45) DEFAULT '#',
  `parent` varchar(45) DEFAULT NULL,
  `support` varchar(5) DEFAULT '00000' COMMENT 'xxxxx\n\n1 = Admin\n1 = Read\n1 = Create\n1 = Update\n1 = Delete',
  `sort_order` int(11) DEFAULT NULL,
  `only_super` int(11) DEFAULT NULL,
  `no_delete` int(11) NOT NULL DEFAULT 0,
  `table_module` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

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
(10, 'Options', 'fa fa-bars', 'options', '2', '11111', 10, 0, 1, NULL),
(13, 'Toko', 'fa fa-archive', 'toko', '0', '11111', 12, NULL, 0, 'toko'),
(14, 'Pelanggan', 'fa fa-circle-o', 'pelanggan', '0', '11111', 13, NULL, 0, 'pelanggan'),
(15, 'Jenis Barang', 'fa fa-circle-o', 'jenisbarang', '0', '11111', 14, NULL, 0, 'jenis_barang'),
(16, 'Item Barang', 'fa fa-circle-o', 'itembarang', '0', '11111', 15, NULL, 0, 'item_barang'),
(17, 'Karyawan', 'fa fa-circle-o', 'karyawan', '0', '11111', 16, NULL, 0, 'karyawan'),
(18, 'Transaksi', 'fa fa-circle-o', 'transaksi', '0', '11111', 17, NULL, 0, 'transaksi'),
(19, 'Item Transaksi', 'fa fa-circle-o', 'itemtransaksi', '0', '11111', 18, NULL, 0, 'item_transaksi'),
(20, 'User', 'fa fa-circle-o', 'user', '0', '11111', 19, NULL, 0, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wd_options`
--

DROP TABLE IF EXISTS `wd_options`;
CREATE TABLE IF NOT EXISTS `wd_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `only_super` int(11) NOT NULL DEFAULT 0,
  `no_delete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `wd_users`;
CREATE TABLE IF NOT EXISTS `wd_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `no_delete` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wd_users`
--

INSERT INTO `wd_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `no_delete`) VALUES
(1, '127.0.0.1', 'super', '$2y$08$s6Ctz9s9wBfAJM1Mf/hZAelLiVOa4MtZUG.4EzD.dl2WJFOaRvaIG', '', 'support@indonesiait.com', '', NULL, NULL, 'K5CIzVgTly4W9HaJeD559.', 1268889823, 1595845735, 1, 'Super', 'Admin', 'ADMIN', '', 1),
(2, '127.0.0.1', 'admin', '$2y$08$AIiuasVsa4kyBAOhuh7HXOkBeN4TThXF3TjnlrIfxEZyw8bFnk99G', NULL, 'admin@admin.com', NULL, NULL, NULL, 'AWO6WnUKaIx4vFHcPG/JZu', 1465717020, 1466497168, 1, 'Administrator', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wd_users_groups`
--

DROP TABLE IF EXISTS `wd_users_groups`;
CREATE TABLE IF NOT EXISTS `wd_users_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wd_users_groups`
--

INSERT INTO `wd_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
