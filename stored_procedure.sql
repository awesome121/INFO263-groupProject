USE `INFO263_cgo54_tserver`;/* Please change your database name */
DROP procedure IF EXISTS `get_user`;
DROP procedure IF EXISTS `show_events_past`;



DELIMITER $$
CREATE PROCEDURE `get_user` ()
BEGIN
select * from front_user;
END$$

DELIMITER ;



DELIMITER $$
CREATE PROCEDURE `show_events_past`()
BEGIN
SELECT * FROM vw_front_event WHERE date <= curdate() AND date >= "2020/01/01" ORDER BY date DESC;

END$$

DELIMITER ;
