<?php
include("config_defaults.php");
include("config.php");
include("inc/db.php");
?>
<html>
<head>
<title>
cqrlog Interface
</title>
<meta charset="UTF-8">
</head>
<body>
<h1 align=center>select log</h3>
<table align=center border="0" cellpadding="0" cellspacing="0">
<tr>
<h3>
	<th bgcolor="grey" width="100px">log_id</th>
	<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
	<th bgcolor="grey" width="100px">Log</th>
	<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
	<th bgcolor="grey" width="100px">Publog</th>
	<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
	<th bgcolor="grey" width="100px">Logsearch</th>
</h3>
<?php
$ergebnis = mysqli_query($dbconnect, "SELECT log_nr, log_name FROM log_list");
while($row = mysqli_fetch_object($ergebnis))
{
$log_nr = $row->log_nr;
$log_name = $row->log_name;
	echo '<tr>';
  echo '<td>' . $log_nr . '</td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
  echo '<td><a href=log.php?log_id=' . $log_nr . '>' . $log_name . '</a></td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
  echo '<td><a href=publog.php?log_id=' . $log_nr . '>' . $log_name . '</a></td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
  echo '<td><a href=logsearch.php?log_id=' . $log_nr . '>' . $log_name . '</a></td>' . "\n";
//	echo "<td><a href=log.php?" . $log_nr .">Log</a>";
	echo '</tr>'; 
}
?>
</table>
<p align=right><a href=CHANGELOG.txt>Changelog</a></p>
</body>
</html>
