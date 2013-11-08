CREATE TABLE IF NOT EXISTS `page` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_template` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(510) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_template` (`id_template`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;