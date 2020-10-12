USE `INFO263_lcs57_tserver`; /********** Please change your database name *********/
DROP table IF EXISTS `front_user`;
DROP procedure IF EXISTS `get_user`;
DROP procedure IF EXISTS `show_events_past`;
DROP procedure IF EXISTS `show_events_future`;
DROP procedure IF EXISTS `show_week_events`;
DROP procedure IF EXISTS `show_search_results`;
DROP procedure IF EXISTS `test_search_results`;
DROP procedure IF EXISTS `add_event`;


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
WHERE date >= start_date AND date <= end_date 
ORDER BY date, cluster_id, group_id ASC;
END$$

DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `show_search_results`(
	IN search_value VARCHAR(50)
    )
BEGIN
SELECT * FROM vw_front_event
WHERE event_name LIKE concat('%', search_value, '%') ORDER BY date DESC;
END$$

DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `test_search_results`()
BEGIN
SET @var1 = 'stat';
SELECT * FROM vw_front_event
WHERE event_name LIKE concat('%', @var1, '%') ORDER BY date DESC;
END$$

DELIMITER ;
	      
	      
	       
	       
	       
DELIMITER $$	       
CREATE PROCEDURE `add_event`(
IN in_event_name VARCHAR(255),
IN in_cluster_name VARCHAR(128),
IN in_time_off_set_before_start TIME,
IN in_duration TIME, 
IN in_event_year year(4),
IN in_week_of_year int(11) unsigned
)
BEGIN
	/* insert evnet and get the assigned event id */
	insert into front_event(event_name, status) values (in_event_name, 1);
    set @event_id  = (select event_id from front_event where event_name = in_event_name);
    
    /* get the corresponding cluster id */
    set @cluster_id = (select cluster_id from front_cluster where cluster_name = in_cluster_name);
    
    /* insert actions and week */
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_time_off_set_before_start, 3, 0);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_time_off_set_before_start, cluster_id, 1);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_duration, 3, 1);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_duration, cluster_id, 0);
    insert into front_weekly(event_id, week_of_year, event_year) values (event_id, in_week_of_year, in_event_year);
    
END$$
DELIMITER ;
