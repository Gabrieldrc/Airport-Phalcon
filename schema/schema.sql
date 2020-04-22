CREATE database IF NOT EXISTS users;

CREATE TABLE IF NOT EXISTS `user` (
    `userName` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
                                 );

-- CREATE TABLE IF NOT EXISTS `Comentario` (
--     `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
--     `url_id` VARCHAR(255) NOT NULL
--     `score` INT NOT NULL
--     `comment` VARCHAR(255)
--                                         );