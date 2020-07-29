CREATE TABLE `link` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `href` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
INSERT INTO `wd_modules` (`title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ('Link', 'fa fa-chain', 'link', '0', '11111', '25', '0');
