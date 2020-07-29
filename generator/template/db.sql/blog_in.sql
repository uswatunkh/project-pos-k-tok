CREATE TABLE `blog` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) DEFAULT NULL,
  `deskripsi` text,
  `file` varchar(100) DEFAULT NULL,
  `user_view` int(11) DEFAULT NULL,
  `tgl` date NOT NULL ,
  `user` int(11) NOT NULL,
  `tag` text,
  `slider_priority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `user_2` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

INSERT INTO `wd_data_relation` ( `on_delete`, `primary_table`, `primary_id`, `relation_table`, `relation_id`) VALUES ( 'restrict', 'wd_users', 'id', 'blog', 'user');
INSERT INTO `wd_modules` ( `title`, `icon`, `url`, `parent`, `support`, `sort_order`, `no_delete`) VALUES ('Berita', 'fa fa-newspaper-o', 'blog', '0', '11111', '22', '0');
