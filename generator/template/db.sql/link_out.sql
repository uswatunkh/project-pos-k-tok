DROP TABLE IF EXISTS `link`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'link' OR `relation_table` = 'link';
