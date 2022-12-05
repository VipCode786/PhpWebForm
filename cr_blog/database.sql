create database ret_des;

use images;

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `image` longblob(100) NOT NULL
  PRIMARY KEY  (`id`)
);