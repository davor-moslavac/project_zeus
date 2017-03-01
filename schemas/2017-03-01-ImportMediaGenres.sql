CREATE TEMPORARY TABLE IF NOT EXISTS Genres 
(
    id INT(10) UNSIGNED NOT NULL,
    name VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
);
INSERT INTO Genres(id, name)
    SELECT 12, 'Adventure' UNION ALL
    SELECT 14, 'Fantasy' UNION ALL
    SELECT 16, 'Animation' UNION ALL
    SELECT 18, 'Drama' UNION ALL
    SELECT 27, 'Horror' UNION ALL
    SELECT 28, 'Action' UNION ALL
    SELECT 35, 'Comedy' UNION ALL
    SELECT 36, 'History' UNION ALL
    SELECT 37, 'Western' UNION ALL
    SELECT 53, 'Thriller' UNION ALL
    SELECT 80, 'Crime' UNION ALL
    SELECT 99, 'Documentary' UNION ALL
    SELECT 878, 'Science Fiction' UNION ALL
    SELECT 9648, 'Mystery' UNION ALL
    SELECT 10402, 'Music' UNION ALL
    SELECT 10749, 'Romance' UNION ALL
    SELECT 10751, 'Family' UNION ALL
    SELECT 10752, 'War' UNION ALL
    SELECT 10770, 'TV Movie';

INSERT INTO gender_media_type(id, name)
select id, name
    from Genres t1
    where not exists (select 1 from gender_media_type t2 where t2.id = t1.id);