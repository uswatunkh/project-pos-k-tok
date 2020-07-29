DROP TABLE IF EXISTS `page_menu`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'page_menu' OR `relation_table` = 'page_menu';
