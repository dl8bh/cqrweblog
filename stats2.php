<?php
include("inc/header.php");
include("inc/parse_stats2.php");
//include("inc/include_test.php");
?>

<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s DXCC statistics</title>'
?>
<link rel="stylesheet" type="text/css" href="inc/log.css">
</head>
<body>

<?php
echo '<h1 align="center">DXCC statistics of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/stats_input2.php");
?>
<br /><br />

<?php
include("inc/stats_proc2.php");
?>

<?php
echo '<p align="right">' . count_qsos( $log_id ) . ' QSO in Log</p>' . "\n";
?>
<hr>
<br><br>

<div id="main_wrap">
<div id="sidebar">
<?php include("inc/sidebar.php");?>
</div>
<div id="content">
<?php include("inc/dxccstats2.php");?>

</div>
</div>
</body>
</html>