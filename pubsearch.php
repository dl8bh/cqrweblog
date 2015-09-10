<?php
include("config.php");
include("inc/header.php");
include("inc/parse_search.php");
?>

<html>
<head>
<?php 
echo '<title>Am I in ' . strtoupper(logid_to_call($log_id)) . ' \'s Log</title>'
?>
<!--<link rel="stylesheet" type="text/css" href="inc/log.css">-->
<meta charset="UTF-8">
</head>
<body>

<?php
if ($pubsearch_enabled) {
$pubsearch=true;
echo '<h1 align="center">Am I in ' . strtoupper(logid_to_call($log_id)) . '\'s Log?</h1><br /><br />';
include("inc/pubsearch_input.php");
echo '<br /><br />' . "\n";

include("inc/search_proc.php");

if (!empty($call))
{
if ($enable_searchcount[$log_id]) {
		echo '<p><center>There have been ' . increment_search_count ($log_id) . ' searches from Log</center></p>' . "\n";
}
echo '<p><h3 align="center"><font color="red">'. "\n";
$aqsos = count_qsos( $log_id );
switch ($aqsos) {
    case 0: 
	echo' Your call was not found in the Log';
	break;
    case 1: 
	echo $aqsos . ' QSO with you in the log';
        break;
    default:
	echo$aqsos . ' QSOs with you in the log';
}    
echo '</font></h3></p>' . "\n";
}
echo '<hr>' . "\n" . '<br><br>' . "\n" ;

if (!empty($call))
{
include("inc/pubqsotable.php");
}
}
else
{
		echo '<h1 align="center">Pubsearch or Publog not enabled!</h1><br /><br />' . "\n";
}
?>

<p align="center"><a href="http://www.dl8bh.de/cqrweblog/">cqrweblog</a>, a simple webinterface for <a href="http://cqrlog.com">CQRLOG</a></p>

</body>
</html>
