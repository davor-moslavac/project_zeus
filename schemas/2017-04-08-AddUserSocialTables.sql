CREATE TABLE IF NOT EXISTS `social_provider` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  INSERT INTO `social_provider` (`name`)
  SELECT * FROM
  (
    SELECT 'Google' UNION
    SELECT 'Twitter' UNION 
    SELECT 'Facebook'
  ) AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM `social_provider` WHERE name <> 'Google' OR name <> 'Twitter' OR name <> 'Facebook'
  );

CREATE TABLE IF NOT EXISTS `user_social` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `social_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `social_provider_id` int(10) UNSIGNED NOT NULL,
  `social_data` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
ALTER TABLE `user_social`
  ADD CONSTRAINT `user_social_user` FOREIGN KEY IF NOT EXISTS (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_social_social_provider` FOREIGN KEY IF NOT EXISTS (`social_provider_id`) REFERENCES `social_provider` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
