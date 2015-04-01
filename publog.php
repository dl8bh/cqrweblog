<?php
include("inc/header.php");
//include("inc/parseinput.php");
?>

<html>
<head>
<title>Logbook</title>
<style type="text/css">
.hl	{
	font-size: 12pt;
	font-style: italic;
	color:blue;
	}
</style>
<meta charset="UTF-8">
</head>
<body>


<?php
echo '<h1 align="center">Last ' . $qso_count . ' QSOs of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
?>

<?php 
echo '<p align="right">' . count_qsos( $log_id ) . ' QSO in Log</p>' . "\n";
?>
<hr>
<br><br>
<?php include("inc/qsotable.php");?>
</body>
</html>
