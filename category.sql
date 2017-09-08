CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `d` (`level`,`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5047 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
