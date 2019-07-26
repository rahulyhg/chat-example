CREATE TABLE `user` (
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`email` CHAR(255) CHARACTER SET utf8 NOT NULL,
	`nickname` CHAR(255) CHARACTER SET utf8 NOT NULL,
	`username` CHAR(255) CHARACTER SET utf8 NOT NULL,
	`password` CHAR(255) CHARACTER SET utf8 NOT NULL
);

CREATE TABLE `message` (
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user_id` INT UNSIGNED NOT NULL,
	`created` DATETIME NOT NULL,
	`content` TEXT NOT NULL,
	`show_user_id` INT UNSIGNED NULL,
	`group_id` INT UNSIGNED NULL
);

CREATE TABLE `group` (
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`title` CHAR(255) CHARACTER SET utf8 NOT NULL
);

CREATE TABLE `group_member` (
	`id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user_id` INT UNSIGNED NOT NULL,
	`group_id` INT UNSIGNED NOT NULL
);


ALTER TABLE `message` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `message` ADD FOREIGN KEY (`show_user_id`) REFERENCES `user` (`id`);
ALTER TABLE `message` ADD FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);
ALTER TABLE `group_member` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
ALTER TABLE `group_member` ADD FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);