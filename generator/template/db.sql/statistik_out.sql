DROP TABLE IF EXISTS `statistik`;
DELETE FROM `wd_data_relation` WHERE `primary_table` = 'statistik' OR `relation_table` = 'statistik';
