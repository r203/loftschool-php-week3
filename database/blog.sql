-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `messages1`;
CREATE TABLE `messages1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `messages1` (`id`, `text`, `created_at`, `author_id`, `image`) VALUES
(3,	'как той \r\nтекст',	'2022-05-01 14:19:54',	1,	''),
(4,	'telegram',	'2022-05-01 14:53:02',	1,	''),
(5,	'test',	'2022-05-01 14:59:36',	1,	'9ad1b329bc432d292c3f39ea58b9c59d9dc674f4.jpg'),
(6,	'telegram',	'2022-05-01 14:59:58',	1,	'ec82fd51b9fede7b47e8e017910eb22918d7a8e7.jpg'),
(7,	'привет',	'2022-05-01 15:46:32',	3,	'');

DROP TABLE IF EXISTS `users1`;
CREATE TABLE `users1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users1` (`id`, `name`, `created_at`, `password`, `email`) VALUES
(1,	'register',	'2022-05-01 11:18:18',	'e29bb6f6e42a0be19c451a92fc250993836d2a21',	'register'),
(2,	'Артём',	'2022-05-01 11:19:32',	'e29bb6f6e42a0be19c451a92fc250993836d2a21',	'register'),
(3,	'qwerty',	'2022-05-01 15:46:17',	'e53e7d7d6b3dc5fa04787320ef3989bf71e0a8ee',	'qwerty');

-- 2022-05-01 12:48:30
