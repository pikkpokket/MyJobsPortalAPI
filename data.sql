DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS announcements;
DROP TABLE IF EXISTS compagnies;
DROP TABLE IF EXISTS emails;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS favorites;

CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
  lastname varchar(50) NOT NULL,
  name varchar(50) NOT NULL,
  class varchar(50) NOT NULL,
  mail varchar(50) NOT NULL,
  password varchar(100) NOT NULL,
  phone varchar(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY unique_mail (mail)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE compagnies (
	id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  mail varchar(50) NOT NULL,
  password varchar(100) NOT NULL,
  phone varchar(50) NOT NULL,
  address varchar(255) NOT NULL,
  description varchar(1000) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY unique_login (mail)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE announcements (
  id int(11) NOT NULL AUTO_INCREMENT,
	compagny varchar(50) NOT NULL,
  type varchar(50) NOT NULL,
	offer varchar(255) NOT NULL,
	missions varchar(255) NOT NULL,
	level varchar(255) NOT NULL,
	address varchar(255) NOT NULL,
	latitude varchar(255) NOT NULL,
	longitude varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE emails (
  mail varchar(50) NOT NULL,
  UNIQUE KEY unique_login (mail)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE images (
  img_id int NOT NULL AUTO_INCREMENT,
  img_nom varchar(50) NOT NULL,
  img_taille varchar(25) NOT NULL,
  img_type varchar(25) NOT NULL,
  img_desc varchar(100) NOT NULL,
  img_blob LONGBLOB NOT NULL,
  PRIMARY KEY (img_id),
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE contacts (
  compagny varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  name varchar(50) NOT NULL,
  position varchar(255) NOT NULL,
  mail varchar(255) NOT NULL,
  phone varchar(50) NOT NULL,
  selected int  NOT NULL,
  UNIQUE KEY unique_mail (mail)
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE appointments (
  date_offer varchar(10) NOT NULL,
  start varchar(10) NOT NULL,
  compagny varchar(50) NOT NULL,
  user varchar(50) NOT NULL,
  duration varchar(10) NOT NULL,
  id_announcement int(11) NOT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;