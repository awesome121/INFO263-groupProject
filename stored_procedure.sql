USE `INFO263_lcs57_tserver`; /********** Please change your database name *********/
DROP table IF EXISTS `front_user`;
DROP procedure IF EXISTS `get_user`;
DROP procedure IF EXISTS `show_events_past`;
DROP procedure IF EXISTS `show_events_future`;



CREATE TABLE `front_user` (
  `username` VARCHAR(6) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `fullName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`));
INSERT INTO `front_user` (`username`, `password`, `email`, `fullName`) VALUES ('ast181', '123456', 'ast181@uclive.ac.nz', 'Amira Syakira Binti Sukarno');
INSERT INTO `front_user` (`username`, `password`, `email`, `fullName`) VALUES ('cgo54', '123456', 'cgo54@uclive.ac.nz', 'Changxing Gong');
INSERT INTO `front_user` (`username`, `password`, `email`, `fullName`) VALUES ('ejs156', '123456', 'ejs156@uclive.ac.nz', 'Emily Schleuss');
INSERT INTO `front_user` (`username`, `password`, `email`, `fullName`) VALUES ('lcs57', '123546', 'lcs57@uclive.ac.nz', 'Leilani Smith');


DELIMITER $$
CREATE PROCEDURE `get_user` ()
BEGIN
select * from front_user;
END$$

DELIMITER ;



DELIMITER $$
CREATE PROCEDURE `show_events_past`()
BEGIN
SELECT * FROM vw_front_event WHERE date <= curdate() AND date >= 01/01/2019 ORDER BY date DESC;
END$$

DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `show_events_future`()
BEGIN
SELECT * FROM vw_front_event WHERE date >= curdate() ORDER BY date ASC;
END$$

DELIMITER ;


DELIMITER $$
CREATE PROCEDURE `show_week_events`(
	IN start_date date, 
	IN end_date date
    )

BEGIN
SELECT * FROM vw_front_event
WHERE date >= start_date AND date <= end_date;
END$$

DELIMITER ;

