DROP TABLE IF EXISTS `download`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'download' OR `relation_table` = 'download';
