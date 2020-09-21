CREATE DEFINER=`lcs57`@`%` PROCEDURE `show_events_past`()
BEGIN
	SELECT * FROM vw_front_event WHERE date <= curdate() AND date >= "2020/01/01"
    ORDER BY date DESC;
END