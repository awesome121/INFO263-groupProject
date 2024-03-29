USE `INFO263_cgo54_tserver`; /********** Please change your database name *********/
DROP table IF EXISTS `front_user`;
DROP view IF EXISTS `vw_front_event_with_day_of_week`;
DROP procedure IF EXISTS `get_user`;
DROP procedure IF EXISTS `show_events_past`;
DROP procedure IF EXISTS `show_events_future`;
DROP procedure IF EXISTS `show_week_events`;
DROP procedure IF EXISTS `show_search_results`;
DROP procedure IF EXISTS `get_cluster_name`;
DROP procedure IF EXISTS `get_machine_group`;
DROP procedure IF EXISTS `add_event`;
DROP procedure IF EXISTS `add_weekly`;
DROP procedure IF EXISTS `add_daily`;
DROP procedure IF EXISTS `add_action`;
DROP procedure IF EXISTS `get_machine_group_id_by_name`;
DROP procedure IF EXISTS `get_cluster_id_by_name`;



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


	       
CREATE VIEW `vw_front_event_with_day_of_week` AS
SELECT 
`e`.`event_name` AS `event_name`,
`fc`.`cluster_name` AS `cluster_name`,
`fc`.`cluster_id` AS `cluster_id`,
`g`.`machine_group` AS `machine_group`,
`g`.`group_id` AS `group_id`,
STR_TO_DATE(CONCAT(`fw`.`event_year`,
                        ' ',
                        `fw`.`week_of_year`,
                        ' ',
                        `w`.`day`),
                '%x %v %W') AS `date`,
ADDTIME(`d`.`start_time`, `a`.`time_offset`) AS `time`,
`a`.`activate` AS `activate`,
`e`.`event_id` AS `event_id`,
`a`.`action_id` AS `action_id`,
`d`.`daily_id` AS `daily_id`,
`fw`.`weekly_id` AS `weekly_id`,
`el`.`status` AS `status`,
`el`.`ran` AS `date_ran`,
`d`.`day_of_week` AS `day_of_week`
    FROM
        (((((((`front_event` `e`
        JOIN `front_daily` `d` ON ((`e`.`event_id` = `d`.`event_id`)))
        JOIN `front_group` `g` ON ((`d`.`group_id` = `g`.`group_id`)))
        JOIN `front_day_of_week` `w` ON ((`d`.`day_of_week` = `w`.`day_of_week`)))
        JOIN `front_action` `a` ON ((`e`.`event_id` = `a`.`event_id`)))
        JOIN `front_cluster` `fc` ON ((`a`.`cluster_id` = `fc`.`cluster_id`)))
        JOIN `front_weekly` `fw` ON ((`e`.`event_id` = `fw`.`event_id`)))
        LEFT JOIN `front_event_log` `el` ON (((`e`.`event_id` = `el`.`event_id`)
            AND (`a`.`action_id` = `el`.`action_id`)
            AND (`d`.`daily_id` = `el`.`daily_id`)
            AND (`fw`.`weekly_id` = `el`.`weekly_id`))))
    ORDER BY `fw`.`week_of_year` , `d`.`day_of_week` , ADDTIME(`d`.`start_time`, `a`.`time_offset`) , `g`.`machine_group`;
	       
	       
	       
	       
	       
	       
	       
	       
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
SELECT * FROM vw_front_event_with_day_of_week
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
CREATE PROCEDURE `get_cluster_name` ()
BEGIN
	select cluster_name from front_cluster;
END$$
DELIMITER ;
	       
	       
	       
DELIMITER $$ 	       
CREATE PROCEDURE `get_machine_group` ()
BEGIN
	select machine_group from front_group;
END$$

DELIMITER ;
		 

DELIMITER $$	       
CREATE PROCEDURE `add_event`(
IN in_event_name VARCHAR(255)
)
BEGIN
	/* insert evnet and get the assigned event id */
	insert into front_event(event_name, status) values (in_event_name, 1);
    select event_id from front_event where event_name = in_event_name;
    
END$$
DELIMITER ;
		 
DELIMITER $$ 
CREATE PROCEDURE `add_weekly`(
IN event_id int(11),
IN in_event_year year(4),
IN in_week_of_year int(11) unsigned)
BEGIN
    insert into front_weekly(event_id, week_of_year, event_year) values (event_id, in_week_of_year, in_event_year);
END$$
DELIMITER ;
		 
DELIMITER $$ 	 
CREATE PROCEDURE `add_daily`(
IN in_event_id INT(11),
IN in_group_id INT(10),
IN in_day_of_week INT(11),
IN in_start_time TIME
)
BEGIN
	insert into front_daily(event_id, group_id, day_of_week, start_time) values (in_event_id, in_group_id, in_day_of_week, in_start_time);
END$$
DELIMITER ;

		 
		 
DELIMITER $$ 
CREATE PROCEDURE `add_action`(
IN event_id int(11),
IN in_cluster_id int(11),
IN in_time_off_set_before_start TIME,
IN in_duration TIME
)
BEGIN
    /* insert actions and week */
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_time_off_set_before_start, 3, 0);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_time_off_set_before_start, in_cluster_id, 1);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_duration, 3, 1);
    insert into front_action(event_id, time_offset, cluster_id, activate) values (event_id, in_duration, in_cluster_id, 0);
    
END$$
DELIMITER ;
		 
		 
DELIMITER $$ 	 
CREATE PROCEDURE `get_machine_group_id_by_name`(
IN in_machine_group varchar(100)
)
BEGIN
	select group_id from front_group where machine_group = in_machine_group;
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE `get_cluster_id_by_name`(
IN in_cluster_name VARCHAR(128)
)
BEGIN
select cluster_id from front_cluster where cluster_name = in_cluster_name;
END$$
DELIMITER ;



