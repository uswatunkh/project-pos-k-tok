CREATE TABLE `statistik` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) DEFAULT NULL,
  `mac_address` varchar(20) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
INSERT INTO `wd_modules` (`title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ('Statistik', 'fa fa-bar-chart', 'statistik', '0', '11111', '34', '0');
