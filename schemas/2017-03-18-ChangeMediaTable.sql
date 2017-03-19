ALTER TABLE `media` CHANGE `adult` `adult` BIT(1) NULL;
ALTER TABLE `media` CHANGE `status_type_id` `status_type_id` INT(10) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `media` ADD COLUMN `is_detail_downloaded` BIT(1) NOT NULL DEFAULT 0;