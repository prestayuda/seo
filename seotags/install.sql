
CREATE TABLE IF NOT EXISTS `PREFIX_neo_seotags` (
  `seotags_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'seotags ID',
  `title_product` varchar(255) NULL DEFAULT 0 COMMENT 'text of title product',
  `title_category` varchar(255) NULL DEFAULT 0 COMMENT 'text of title category',
  `description_product` varchar(855) NULL DEFAULT 0 COMMENT 'text of description product',
  `description_category` varchar(855) NULL DEFAULT 0 COMMENT 'text of description category',
  `keywords_product` varchar(455) NULL DEFAULT 0 COMMENT 'text of keywords product',
  `keywords_category` varchar(455) NULL DEFAULT 0 COMMENT 'text of keywords category',
  `language` int(3) NOT NULL DEFAULT 1 COMMENT 'id of language',
  PRIMARY KEY (`seotags_id`)
  );


