# Tserver
Tserver is a simple INFO263 group project at University of Canterbury<br>



# Database configuration
To ensure a successful setup, there are three important steps:
1. Please put your database account in src/db_config.php to connect your database.

2. Please use MySQL Workbench, execute tserver.sql to create tables used in the web pages. 

2. Please use MySQL Workbench, execute stored_procedure.sql to create procedures and views used in the web pages.
  (Ignore this if you have already created those procedures in your database)

## Web page structure
### login page
users will need a valid username and password to log into the interface
### home page 
displaying a calendar of what is happening this week, and users will be able to check events in the future by weeks
### create page
use to define event - new event created will be configured into te database
### past page
displaying all the events history includin current day past events
### future page
displaying all future events including current day future events

