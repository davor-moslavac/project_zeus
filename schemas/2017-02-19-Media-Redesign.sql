
DROP TABLE IF EXISTS `media_people_cast`;
DROP TABLE IF EXISTS `cast_type`;
DROP TABLE IF EXISTS `media_gender`;
DROP TABLE IF EXISTS `gender_media_type`;
DROP TABLE IF EXISTS `media_season`;
DROP TABLE IF EXISTS `media`;


CREATE TABLE IF NOT EXISTS `media`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `external_id` BIGINT(20) UNSIGNED NOT NULL,
  `title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `plot` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `backdrop_path` VARCHAR(512) NULL,
  `homepage_path` VARCHAR(512) NULL,
  `poster_path` VARCHAR(512) NULL,
  `tagline` VARCHAR(1024) NULL,
  `type_id` INT(10) UNSIGNED NOT NULL,
  `status_type_id` INT(10) UNSIGNED NOT NULL,
  `vote_count` INT(10) NOT NULL,
  `vote_average` DECIMAL(4, 2) NULL,
  `popularity` DECIMAL(16, 8) NULL,
  `trailer_url` VARCHAR(512) NULL,
  `release_date` DATE NULL,
  `budget` numeric(15,2) NULL,
  `language` VARCHAR(100) NULL,
  `adult` bit NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `media_type`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `media_status_type`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE  `media` 
ADD CONSTRAINT `media_type` FOREIGN KEY IF NOT EXISTS(`type_id`) REFERENCES `media_type`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `media_media_status_type` FOREIGN KEY IF NOT EXISTS(`status_type_id`) REFERENCES `media_status_type`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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


  CREATE TABLE IF NOT EXISTS `media_creators`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `external_id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `profile_path` VARCHAR(512) NULL,
  PRIMARY KEY(`id`),
  KEY `media_id` (`media_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE `media_creators`
  ADD CONSTRAINT `media_media_creators` FOREIGN KEY IF NOT EXISTS (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


 CREATE TABLE IF NOT EXISTS `media_production_companies`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `production_company_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `production_company`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE `media_production_companies`
  ADD CONSTRAINT `media_gender_production_company` FOREIGN KEY IF NOT EXISTS (`production_company_id`) REFERENCES `production_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `media_production_companies_media` FOREIGN KEY IF NOT EXISTS (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;



 CREATE TABLE IF NOT EXISTS `media_gender`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `gender_id`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`),
  KEY `media_id` (`media_id`),
  KEY `gender_id` (`gender_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `gender_media_type`(
  `id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE `media_gender`
  ADD CONSTRAINT `media_gender_gender_type` FOREIGN KEY IF NOT EXISTS (`gender_id`) REFERENCES `gender_media_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `gender_media_type_media` FOREIGN KEY IF NOT EXISTS (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


CREATE TABLE IF NOT EXISTS `media_series_detail`(
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `number_of_seasons` INT(10) NOT NULL,
  `number_of_episode` INT(10) NOT NULL,
  `origin_country` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `episode_run_time` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `in_production` BIT NULL,
  `end_date` DATE NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


ALTER TABLE
  `media_series_detail` ADD CONSTRAINT `media_media_series_detail` FOREIGN KEY IF NOT EXISTS(`id`) REFERENCES `media`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

  CREATE TABLE IF NOT EXISTS `media_series_season`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `media_id`  BIGINT(20) UNSIGNED NOT NULL,
  `air_date` DATE NOT NULL,
  `external_id` BIGINT(20) UNSIGNED NOT NULL,
  `episode_count` INT(10) NOT NULL,
  `poster_path` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `season_number` INT NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
