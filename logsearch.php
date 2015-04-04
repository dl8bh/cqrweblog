<?php
include("inc/header.php");
include("inc/parse_search.php");
?>

<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s Logsearch</title>'
?>
<link rel="stylesheet" type="text/css" href="inc/log.css">
<meta charset="UTF-8">
</head>
<body>

<?php
echo '<h1 align="center">Logsearch of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/search_input.php");
?>
<br /><br />

<?php
include("inc/search_proc.php");
?>

<?php 
echo '<p align="right">' . count_qsos( $log_id ) . ' QSO matched your search</p>' . "\n";
?>
<hr>
<br><br>

<div id="main_wrap">
<div id="sidebar">
<?php include("inc/sidebar.php");?>
</div>
<div id="content">
<?php include("inc/qsotable.php");?>


</div>
</div>
<?php
if ($adif_export)
{	
		include("inc/exportfile.php");
}
?>
</body>
</html>
