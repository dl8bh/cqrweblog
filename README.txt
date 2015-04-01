====REQUIREMENTS====
-mysql-server (5.5 or higher, maybe mariadb works, to)
-php enabled web-server with php-mysqli and php-filter extensions

====SETUP====

===MYSQL-SERVER===
-setup your mysql-server public available
-add mysql-user to handle your logs
-import ctyfiles/cqrlog_web.sql to your mysql-server (DXCC-Resolution Tables)

====WEB-SERVER====
-setup your webserver
-edit config.php.example, move it to config.php
-consider htaccess rules to block unauthorized users


====USAGE====
Some general URL-parameters:
-log_id=1 
	-It is used to select the correct log. 
	-Its default value can be set in config.php. 
	-same value as in cqrlog.
-qso_count=N
	-defines, how much QSOs to show
	-works with log, search and public log
	-default value can be set in config.php

===LOG===
Here you can log new qsos. Your browser should start in Callsign field, press TAB to skip to RST_S/RST_R/Name/Comment
Press enter to log QSO.
If frequency is set, it keeps its value as long as you dont change.

-Time
	-format: hh:mm or hhmm
	-optional, ifempty: actual time in UTC
-Band
	-if not used: Frequency is used
	-if used: Frequency is set to lower bound of selected band
		-eg: 40M -> 7.000
	-has priority over frequency
-Frequency
	-input frequency in MHz
	-if band is selected, frequency is selected as lower bound of band
-Callsign
	-just enter a callsign
-Mode
	-enter a mode
	-default mode can be configured in config.php
-RST_S/RST_R
	-RST sent/received
	-default RST can be configured in config.php
-Name (optional)
	-Name of OP
-Remarks (optional)
	-some remarks to QSO
-Submit
	-Log QSO, alternatively just hit ENTER
-CheckDXCC
	-Check the DXCC worked/confirmed statistics of the entered callsigns dxcc

===SEARCH===
Fields are combinde with logical AND. % can be used as wildcard in Callsign/Name/Remarks fields.

===Statistics===
