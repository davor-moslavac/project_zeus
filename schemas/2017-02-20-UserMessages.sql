CREATE TABLE IF NOT EXISTS `user_messages`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sent_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` boolean DEFAULT 0,
  PRIMARY KEY(`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `user_messages`
 ADD CONSTRAINT `user_user_messages_sender_id` FOREIGN KEY IF NOT EXISTS (`sender_id`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
 ADD CONSTRAINT `user_user_messages_receiver_id` FOREIGN KEY IF NOT EXISTS (`receiver_id`) REFERENCES `user`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;