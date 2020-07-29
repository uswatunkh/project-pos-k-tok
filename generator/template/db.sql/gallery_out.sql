DROP TABLE IF EXISTS `gallery`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'gallery' OR `relation_table` = 'gallery';
