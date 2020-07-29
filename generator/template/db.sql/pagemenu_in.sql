CREATE TABLE `page_menu` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `text` text,
  `parent` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `href` varchar(50) NOT NULL,
  `base_url` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
INSERT INTO `wd_modules` ( `title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ('Page Menu', 'fa fa-reorder', 'pagemenu', '0', '11111', '14', '0');
