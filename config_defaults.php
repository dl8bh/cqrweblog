<?php
/*************************************
PLEASE DO NOT EDIT THIS FILE, MAKE 
YOUR CHANGES IN CONFIG.PHP - THIS FILE 
IS BEEING CHANGED BY UPDATES OFTEN
*************************************/
/*******************
GENERAL SERVERCONFIG
*******************/
$cqrweblog_root="/";  // webserver root for cqrweblog, relative to your webroot, for http://server:port/path its just /path

/*******************
GENERAL LOG SETTINGS
*******************/
$defaultlog="1";           // this is the default log (override: log_id=N)
$defaultcount="50";        // count of qsos to show per default in the tables
$max_public_count="50";    // max count of qsos to show on the public pages
$publog_enabled=true;      // enable public log, true or false
$pubsearch_enabled=true;   // if publog is enabled, enable/disable logsearch for visitors
$debugmode=false;          // debug-mode
$exportdir="tmp/";         // where to export the adi files? has to be readable/writable by the webserver
$hamqth_api = true;        // enable/disable hamqth-api (switches to local dxcc resolution and disables cluster, if false)
													 // if your cqrweblog instance is very slow, consider turning $hamqt_api to false, hamqth.com might have problems!
$cluster_spot_num =50;     // number of spots to load from the dx-cluster
$enable_changelog = true;  // show link to changelog in header
//$clusterurl = 'https://www.hamqth.com/dxc_csv.php?';
													 // original cluster data
$clusterurl = 'https://api.dl8bh.de/dxc_csv.php?';
$hamqthurl = 'http://api.dl8bh.de';
// cached clusterspots from hamqth upstream, infrastructure by dl8bh
													 // allow to setup another location for cluster for caching
$apitimeout = 12;			 		 // time, after which cluster should time out. lower values if depending on hamqth.com, higher values, if you use some cached
													 // infrastructure like http://hamqth.dl8bh.de/dxc_csv.php which does caching for you
/**************
DEFAULT REPORTS
**************/
$defaultmode="CW";
$default_cw_rapport="599";
$default_ssb_rapport="59";

/*************
CLUSTER COLORS
*************/
$atnocolor = "red";
$newbandcolor ="deeppink";
$newmodecolor = "green";
$confirmedcolor ="black";
$workedcolor="blue";
$dupecolor="grey";
?>
