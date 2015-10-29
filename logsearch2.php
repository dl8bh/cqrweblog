<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_search.php");
?>

<html>
<head>
<?php 
$searchactive=true;
include("inc/navbar.php");
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s Logsearch</title>'
?>
<link rel="stylesheet" type="text/css" href="inc/log.css">
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php
echo '<h1 align="center">Logsearch of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/search_input2.php");
?>
<br /><br />

<?php
include("inc/search_proc.php");
?>

<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr><td width="300" align="center" >
<?php 
$match_amount =count_qsos( $log_id );
switch ($match_amount) {
    case 0:
	echo '<font color="red"><b>Nothing found!</b>' . "\n";
	break;
    case 1:
	echo '<font color="green">' . $match_amount . ' QSO found' . "\n";
	break;
    default :
	echo '<font color="green">' . $match_amount . ' QSOs found' . "\n";
}
echo '</font>';
if ($inlog){
    echo '</td><td width="300" align="center">';
    echo '<a href="javascript:window.close();">Close window</a>';
}
?>
</td></tr>
</table>
<hr>
<br><br>

<?php include("inc/qsotable2.php");
?>


<?php
if ($adif_export)
{	
		include("inc/exportfile.php");
}
?>
</body>
</html>
