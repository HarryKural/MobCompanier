
DROP TABLE IF EXISTS mobiles;
DROP TABLE IF EXISTS bikes;
DROP TABLE IF EXISTS companies;
CREATE TABLE companies (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  founded varchar(20) NOT NULL,
  website varchar(200) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;


BEGIN;
INSERT INTO companies
VALUES
('100', 'k', '01/05/1327', 'https://en.wikipedia.org/wiki/le_Inc.');

CREATE TABLE mobiles (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  price decimal(10,2) NOT NULL,
  company_id int(11) NOT NULL,
  image varchar(100) DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT company FOREIGN KEY (company_id) REFERENCES companies (id) ON DELETE CASCADE ON UPDATE CASCADE
);

BEGIN;
INSERT INTO mobiles
VALUES
('19', 'iPhone', '109.00', '100', '6.jpg');
commit;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  role tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
);

insert into users values (1, 'Harshit', 'Sharma', 'harshitsharma@gmail.com', 'heybyehey', 1);
