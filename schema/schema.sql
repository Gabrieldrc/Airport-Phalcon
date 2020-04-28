CREATE database IF NOT EXISTS airportPhalcon;

CREATE TABLE IF NOT EXISTS `user` (
    `userName` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
                                 );

CREATE TABLE IF NOT EXISTS `airplane` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `passengers` INT(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `destiny` VARCHAR(255) NULL,
    `idFlight` VARCHAR(255) NULL
                                 );

CREATE TABLE IF NOT EXISTS `flight` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `passengers` INT(255) NOT NULL,
    `origin` VARCHAR(255) NOT NULL,
    `destiny` VARCHAR(255) NULL,
    `idAirplane` VARCHAR(255) NULL
                                 );

-- $id;
-- $passengers;
-- $location;
-- $destiny;
-- $idVuelo;