DROP TABLE IF EXISTS `blog`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'blog' OR `relation_table` = 'blog';
