<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_stats.php");
?>

<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s DXCC statistics</title>';
include("inc/metaheader.php");
?>
</head>
<body style="overflow:auto;">

<?php
$statsactive=true;
include("inc/navbar.php");
echo '<h1 align="center">DXCC statistics of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/stats_inputnew.php");
?>
<br /><br />

<?php
include("inc/stats_proc.php");
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

<?php include("inc/dxccstatsnew.php");?>
<?php include("inc/metafooter.php");?>

</body>
</html>
