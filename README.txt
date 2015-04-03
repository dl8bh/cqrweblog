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
	-you can just set 7 for 40m 21 for 15m, 14 for 20m if you dont want/need precice frequencies
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
	-is saved uppercase
-Remarks (optional)
	-some remarks to QSO
	-is saved uppercase
-Submit
	-Log QSO, alternatively just hit ENTER
-CheckDXCC
	-Check the DXCC worked/confirmed slot-statistics of the entered callsigns dxcc in a new window
	-uses the dxcc stats explained later


===SEARCH===
General:
Fields are combined with logical AND, all fields are optional.
-Callsign 
	-use % as wildcard, example: DL% would find DL8BH and DL4UNY (and many more DL)
-DXCC 
	-DXCC Prefix as known from cqrlog, use % as wildcard
-Mode:
	-filter for cw/ssb/…
-Remarks
	-use % as wildcard
-Locator
	-use % as locator
	-hint for vhf/uhf ops: JO% JO50% etc might be interesting…
An advanced example:
Band=20m DXCC=DL Mode=CW Name=Pet% Remarks=%WAE15%
Would search for all german stations you worked on 20m cw in WAE 2015 (if you use have such comments) with names starting with Pet (Peter, Pete, Petr…)


===Statistics===
-shows dxcc statistics
-can show one or more of cw/ssb/allmode at the same time
-uses input to define kind of confirmation as set in cqrlog (paper/lotw/eqsl)
-sums up the dxcc at the bottom of the table
-DXCC
	-allows to search for a specific DXCC
	-uses % as wildcard
		-D% shows D2 (Antigua), D4 (Cap Verde), D6 (Comoros), DL (Federal Republic of Germany), DU (Philippines)
		-D2 just shows Antigua…

===Publog===
-can be enabled/disabled in config.php
-just shows the last $qso_count=N QSOs
-allows to search for call, no wildcards are allowed
	-opens "Am I in log" page
	-if public search is disabled, search field is not shown

===Am I in log===
-can be enabled/disabled in config.php
-lets the visitor check, if he is in log
