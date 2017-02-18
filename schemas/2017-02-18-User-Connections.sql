CREATE TABLE IF NOT EXISTS `user_connections` (
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` int(10)UNSIGNED NOT NULL,
	`followed_user_id` int(10) NOT NULL,
	`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(`id`),
	KEY `user_id` (`user_id`),
  	KEY `followed_user_id` (`followed_user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `user_connections`
 ADD CONSTRAINT `user_user_connections_user_id` FOREIGN KEY IF NOT EXISTS (`user_id`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
 ADD CONSTRAINT `user_user_connections_followed_user_id` FOREIGN KEY IF NOT EXISTS (`followed_user_id`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;