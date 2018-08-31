SET NAMES utf8mb4;

CREATE TABLE `user_admin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `village` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `permission_restriction` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_admin_id` int(10) unsigned NOT NULL,
  `village_id` int(10) unsigned NOT NULL,
  `permission` smallint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_admin_id`) REFERENCES `user_admin` (`id`) ON DELETE RESTRICT,
  FOREIGN KEY (`village_id`) REFERENCES `village` (`id`) ON DELETE RESTRICT
);

INSERT INTO `village`
(`name`) VALUES
('Brno'),
('Praha');

INSERT INTO `user_admin` (`name`, `created_at`) VALUES
('Adam'),
('Martin'),
('Erik'),
('Daniel');