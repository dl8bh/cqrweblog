<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
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
if ($publog_enabled) {
$publog=true;
		if ($qso_count > $max_public_count)
		{
				$qso_count = $max_public_count;
		}
		echo '<h1 align="center">Last ' . $qso_count . ' QSOs of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />' . "\n";
		if ($pubsearch_enabled)
				{
				include ("inc/pubsearch_inputold.php");
				}

		if ($enable_searchcount[$log_id]) {
		echo '<p><center>There have been ' . get_search_count ($log_id) . "\n";
		echo ' searches from ' . count_qsos( $log_id ) . ' QSOs in Log </center></p>' . "\n";
		echo '<hr>' . "\n";
		echo '<br><br>' . "\n";
		}
		else {
				echo '<p align="right">' . count_qsos( $log_id ) . ' QSO in Log</p>' . "\n";
				echo '<hr>' . "\n";
				echo '<br><br>' . "\n";
		}
		include("inc/pubqsotableold.php");
}
else
{
		echo '<h1 align="center">Publog not enabled</h1><br /><br />' . "\n";
}
?>

<p align="center"><a href="http://www.dl8bh.de/cqrweblog/">cqrweblog</a>, a simple webinterface for <a href="http://cqrlog.com">CQRLOG</a></p>

</body>
</html>
