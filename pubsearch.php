<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_search.php");
?>

<!DOCTYPE html> 
<html>
<head>
<?php 
echo '<title>Am I in ' . strtoupper(logid_to_call($log_id)) . ' \'s Log</title>'
?>
<meta charset="UTF-8">
<?php include("inc/metaheader.php"); ?>
</head>
<body>

<?php
if ($pubsearch_enabled) {
$pubsearch=true;
echo '<h1 align="center">Am I in ' . strtoupper(logid_to_call($log_id)) . '\'s Log?</h1><br /><br />';
include("inc/pubsearch_input.php");

include("inc/search_proc.php");

if (!empty($call))
{
if ($enable_searchcount[$log_id]) {
		?>
		</br>
		<div class="row">
		<div class="col-sm-4"></div>	
		<div class="hidden-xs alert alert-info col-sm-4">
				There have been <?php echo get_search_count	($log_id) ; ?> searches in this log.
		</div>	
		</div>
<?php
}
	echo '<div class="row"><div class="col-sm-4"></div>	' . "\n";
$match_amount =count_qsos( $log_id );
switch ($match_amount) {
    case 0:
  echo '<div class="alert alert-warning col-sm-4">' . "\n" .
    '<strong>Sorry </strong> no QSO with you in the found in the log' . "\n" .
  	'</div>';
	break;
    case 1:
  echo '<div class="alert alert-info col-sm-4">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSO with you in the log found' . "\n" .
  	'</div>';

	break;
    default:
  echo '<div class="alert alert-success col-sm-4">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSOs with you in the log' . "\n" .
  	'</div>';
}
echo '</div>' . "\n";


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
