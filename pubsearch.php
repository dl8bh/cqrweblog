<?php
include("config_defaults.php");
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
<?php include("inc/metaheader.php"); ?>
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

$match_amount =count_qsos( $log_id );
switch ($match_amount) {
    case 0:
  echo '<div class="alert alert-warning">' . "\n" .
    '<strong>NO </strong> QSO with you in the found in the log' . "\n" .
  	'</div>';
	break;
    case 1:
  echo '<div class="alert alert-info">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSO with you in the log found' . "\n" .
  	'</div>';

	break;
    default:
  echo '<div class="alert alert-success">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSOs with you in the log' . "\n" .
  	'</div>';
}



}

if (!empty($call))
{
include("inc/pubqsotable.php");
}
}
else
{
  echo '<div class="alert alert-danger">' . "\n" .
    '<strong>ERROR </strong> Pubsearch or Publog not enabled!' . "\n" .
  	'</div>';
}
?>

<p align="center"><a href="http://www.dl8bh.de/cqrweblog/">cqrweblog</a>, a simple webinterface for <a href="http://cqrlog.com">CQRLOG</a></p>

</body>
</html>
