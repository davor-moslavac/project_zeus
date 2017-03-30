CREATE TABLE IF NOT EXISTS `media_season_episodes`(
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `external_id` BIGINT(20) UNSIGNED NOT NULL,
  `season_id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `plot` TEXT CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `air_date` DATE NULL,
  `episode_number` INT(10) NOT NULL,
  `still_path` VARCHAR(512) NULL,
  `vote_count` INT(10) NOT NULL,
  `vote_average` DECIMAL(4, 2) NULL,
  PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE
  `media_season_episodes` ADD CONSTRAINT `media_season_media_season_episodes` FOREIGN KEY IF NOT EXISTS(`season_id`) REFERENCES `media_series_season`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
