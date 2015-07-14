<?php
include("inc/header.php");
include("inc/parse_log.php");
?>

<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s Logbook</title>';
//include("inc/copy.php");
?>
<link rel="stylesheet" type="text/css" href="inc/log.css">
<meta charset="UTF-8">
<script src="inc/shortcut.js" type="text/javascript" name="shortcut/shortcut"></script>
<script src="inc/copy.js" type="text/javascript" name="copycall/copycall"></script>
</head>
<body style="overflow:auto;">
<div id="root">
<?php
echo '<div id="head">' . "\n";
echo '<h1 align="center">Logbook of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
echo '</div>' . "\n";
if ($enable_cluster[$log_id])
{
include ("inc/cluster.php");
}
include ("inc/log_input.php");
?>
<br /><br />

<?php 
include("inc/log_proc.php");
echo '<p align="right">' . count_qsos( $log_id ) . ' QSO in Log</p>' . "\n";
?>
<hr>
<br><br>

<div id="main_wrap">
<div id="sidebar">
<?php include("inc/sidebar.php");?>
</div>
<div id="content">

<?php
//include("inc/log_proc.php");
?>
<?php include("inc/qsotable.php");?>

</div>
</div>
</div>
</body>
</html>
