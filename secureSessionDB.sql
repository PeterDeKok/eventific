CREATE TABLE `sessions` (
  `id` CHAR(128) NOT NULL,
  `set_time` CHAR(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` CHAR(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE USER 'sec_user'@'127.0.0.1' IDENTIFIED BY 'rKfsleTsdBoi';
GRANT SELECT, INSERT, UPDATE, DELETE ON `webtechgroup5`.`sessions` TO 'sec_user'@'127.0.0.1';