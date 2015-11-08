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
echo '<br /><br />';
include ("inc/log_input.php");
?>
<!--<br /><br />-->
<div class="col-xs-*">
<br /></div>
<?php 
include("inc/log_proc.php");


//echo '<p align="right">';
//echo '<div class="col-sm-1">' . "\n";
$qso_amount=count_qsos( $log_id );
switch ($qso_amount) {
    case 0:
  echo '<div class=" hidden-xs col-md-3 col-sm-3 alert alert-danger">' . "\n" .
    '<strong>NO </strong> QSO found' . "\n" .
  	'</div>';
	break;
    case 1:
  echo '<div class="hidden-xs col-md-3 col-sm-3 alert alert-info">' . "\n" .
    '<strong>' . $qso_amount . '</strong> QSO found' . "\n" .
  	'</div>';

	break;
    default:
  echo '<div class="col-sm-2 col-md-3 hidden-xs alert alert-info">' . "\n" .
    '<strong>' . $qso_amount . '</strong> QSOs found' . "\n" .
  	'</div>';
	//echo '<font color="green">' . $qso_amount . ' QSOs found' . "\n";
}

//echo '</font></p>';
?>
</div>
<!--<hr>
<br><br> -->

<!--<div id="main_wrap">-->
<!--<div id="sidebar">
<?php //include("inc/sidebar.php");?>
</div>
<div id="content">-->

<?php
//include("inc/log_proc.php");
?>
<?php include("inc/qsotable.php");?>

</div>
</div>
</div>
<script src="inc/js/addshortcuts.js" type="text/javascript" name="addshortcuts/addshortcuts"></script>
<?php include("inc/metafooter.php");?>
</body>
</html>
