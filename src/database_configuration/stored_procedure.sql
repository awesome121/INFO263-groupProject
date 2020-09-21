CREATE DEFINER=`xxx`@`%` PROCEDURE `show_events_past`().  //Please put your username in xxx
BEGIN
	SELECT * FROM vw_front_event WHERE date <= curdate() AND date >= "2020/01/01"
    ORDER BY date DESC;
END
