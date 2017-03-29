ALTER TABLE  `media_series_season` 
ADD CONSTRAINT `media_series_season_media` FOREIGN KEY IF NOT EXISTS(`media_id`) REFERENCES `media`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `media_series_season` CHANGE `air_date` `air_date` DATE NULL;
ALTER TABLE `media_series_detail` CHANGE `origin_country` `origin_country` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NULL;
ALTER TABLE `media_series_detail` CHANGE `number_of_episode` `number_of_episode` INT(10) NULL;
ALTER TABLE `media_series_season` CHANGE `episode_count` `episode_count` INT(10) NULL, CHANGE `season_number` `season_number` INT(11) NULL;