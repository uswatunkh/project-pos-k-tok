CREATE TABLE `gallery` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(50) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `album` varchar(50) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `uploader` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

INSERT INTO `wd_data_relation` ( `on_delete`, `primary_table`, `primary_id`, `relation_table`, `relation_id`) VALUES ( 'restrict', 'wd_users', 'id', 'gallery', 'uploader');
INSERT INTO `wd_modules` (`title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ('Gallery', 'fa fa-camera', 'gallery', '0', '11111', '42', '0');
