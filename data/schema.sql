
DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id`    int(11)       NOT NULL AUTO_INCREMENT,
  `title` varchar(100)  NOT NULL,
  `text`  text          NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
