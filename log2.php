<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_log.php");
?>

<html>
<head>
<?php 
$logactive=true;
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s Logbook</title>';
//include("inc/copy.php");
include("inc/metaheader.php");
?>
</head>
<body style="overflow:auto;">
<div id="root">
<?php
include("inc/navbar.php");
echo '<div id="head">' . "\n";
echo '<h1 align="center">Logbook of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
echo '</div>' . "\n";
if ($enable_cluster[$log_id]&&$hamqth_api&&!($hamqthtimeout))
{
include ("inc/cluster.php");
}
include ("inc/log_input2.php");
?>
<br /><br />

<?php 
include("inc/log_proc.php");

echo '<p align="right">';
$qso_amount=count_qsos( $log_id );
switch ($qso_amount) {
    case 0:
	echo '<font color="red"><b>Nothing found!</b>' . "\n";
	break;
    case 1:
	echo '<font color="green">' . $qso_amount . ' QSO found' . "\n";
	break;
    default:
	echo '<font color="green">' . $qso_amount . ' QSOs found' . "\n";
}
echo '</font></p>';
?>
<hr>
<br><br>

<div id="main_wrap">
<!--<div id="sidebar">
<?php //include("inc/sidebar.php");?>
</div>
<div id="content">-->

<?php
//include("inc/log_proc.php");
?>
<?php include("inc/qsotable2.php");?>

</div>
</div>
</div>
<script src="inc/addshortcuts.js" type="text/javascript" name="addshortcuts/addshortcuts"></script>
</body>
</html>
