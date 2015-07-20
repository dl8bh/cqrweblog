<?php
?>

<table align=center border="0" cellpadding="0" cellspacing="0">
<tr>
<h3>
        <th bgcolor="grey" width="100px">Navigation</th>
</h3>
</tr>
<?php
echo '<tr><td><a href='.$cqrweblog_root.'>Index</a></td></tr>' . "\n";
echo '<tr><td><a href='.$cqrweblog_root.'log.php?log_id=' . $log_id . '>Log</a></td></tr>' . "\n";
echo '<tr><td><a href='.$cqrweblog_root.'logsearch.php?log_id=' . $log_id . '>Search</a></td></tr>' . "\n";
if ($altstats[$log_id])
{
	echo '<tr><td><a href='.$cqrweblog_root.'stats2.php?log_id=' . $log_id . '>Statistics</a></td></tr>' . "\n";
}
else
{
		echo '<tr><td><a href='.$cqrweblog_root.'stats.php?log_id=' . $log_id . '>Statistics</a></td></tr>' . "\n";
}
echo '<tr><td><a href='.$cqrweblog_root.'publog.php?log_id=' . $log_id . '>Public</a></td></tr>' . "\n";
?>

</table>

