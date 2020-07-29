CREATE TABLE `download` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `file` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `downloader` int(22) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO `wd_data_relation` ( `on_delete`, `primary_table`, `primary_id`, `relation_table`, `relation_id`) VALUES ( 'restrict', 'wd_users', 'id', 'download', 'author');
INSERT INTO `wd_modules` ( `title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ( 'Download', 'fa fa-archive', 'download', '0', '11111', '39', '0');
