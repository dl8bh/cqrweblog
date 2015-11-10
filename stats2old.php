<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/include2.php");
include("inc/parse_oldstats2.php");
?>

<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s DXCC statistics</title>'
?>
<link rel="stylesheet" type="text/css" href="inc/css/logold.css">
</head>
<body>

<?php
echo '<h1 align="center">DXCC statistics of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/stats_input2old.php");
?>
<br /><br />

<?php
include("inc/stats_oldproc.php");
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

<div id="main_wrap">
<div id="sidebar">
<?php include("inc/sidebar.php");?>
</div>
<div id="content">
<?php include("inc/dxccstats2old.php");?>

<?php include("inc/metafooter.php");?>
</div>
</div>
</body>
</html>
