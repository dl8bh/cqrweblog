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
$searchactive=true;
include("inc/logbook.php");
$Logbook = new Logbook ($DbSpawner->newdb(), $log_id);
echo '<title>' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . ' \'s Logsearch</title>'
?>
<link rel="stylesheet" type="text/css" href="inc/css/logold.css">
<meta charset="UTF-8">
<?php include("inc/metaheader.php"); ?>
</head>
<body>

<?php
include("inc/navbar.php");
echo '<h1 align="center">Logsearch of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</h1><div class="hidden-xs hidden-sm"><br /><br /></div>';
include("inc/search_input.php");
?>

<?php
include("inc/search_proc.php");
?>

<?php 
$match_amount = $Logbook->count_qsos( $log_id );
switch ($match_amount) {
    case 0:
  echo '<div class="alert alert-danger ">' . "\n" .
    '<strong>NO </strong> QSO found' . "\n" .
  	'</div>';
	break;
    case 1:
  echo '<div class="alert alert-info">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSO found' . "\n" .
  	'</div>';

	break;
    default:
  echo '<div class="alert alert-info">' . "\n" .
    '<strong>' . $match_amount . '</strong> QSOs found' . "\n" .
  	'</div>';
}

if ($adif_export) {

  echo '<div class="alert alert-info">' . "\n" .
    '<strong>EXPORT</strong> complete, link at bottom of page' . "\n" .
  	'</div>';

}

include("inc/qsotable.php");


if ($adif_export)
{	
		include("inc/exportfile.php");
}
include("inc/metafooter.php"); 

?>
</body>
</html>
