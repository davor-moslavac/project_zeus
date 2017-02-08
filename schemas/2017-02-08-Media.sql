CREATE TABLE IF NOT EXISTS `media`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `plot` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image_url` VARCHAR(512) NULL,
  `imdb_rating` DECIMAL(4, 2) NULL,
  `trailer_url` VARCHAR(512) NULL,
  `type_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `media_type`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE
  `media` ADD CONSTRAINT `media_media_type` FOREIGN KEY IF NOT EXISTS(`type_id`) REFERENCES `media_type`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  INSERT INTO `media_type` (`name`)
  SELECT * FROM
  (
    SELECT 'Movie' UNION
    SELECT 'Series' UNION 
    SELECT 'Anime'
  ) AS tmp
  WHERE NOT EXISTS (
      SELECT name FROM `media_type` WHERE name <> 'Movie' OR name <> 'Series' OR name <> 'Anime'
  );

  CREATE TABLE IF NOT EXISTS `media_people_cast`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `cast_type_id`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`),
  KEY `media_id` (`media_id`),
  KEY `cast_type_id` (`cast_type_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `cast_type`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE `media_people_cast`
  ADD CONSTRAINT `media_people_cast_type` FOREIGN KEY IF NOT EXISTS (`cast_type_id`) REFERENCES `cast_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `media_people_cast_media` FOREIGN KEY IF NOT EXISTS (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


 CREATE TABLE IF NOT EXISTS `media_gender`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `gender_id`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`),
  KEY `media_id` (`media_id`),
  KEY `gender_id` (`gender_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `gender_media_type`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE `media_gender`
  ADD CONSTRAINT `media_gender_gender_type` FOREIGN KEY IF NOT EXISTS (`gender_id`) REFERENCES `gender_media_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gender_media_type_media` FOREIGN KEY IF NOT EXISTS (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


CREATE TABLE IF NOT EXISTS `media_season`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `season` INT(10) UNSIGNED NOT NULL,
  `episode` INT(10) UNSIGNED NOT NULL,
  `title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `plot` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `imdb_rating` DECIMAL(4, 2) NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE
  `media_season` ADD CONSTRAINT `media_media_season` FOREIGN KEY IF NOT EXISTS(`media_id`) REFERENCES `media`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;