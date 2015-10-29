<table align=center border="0" cellpadding="0" cellspacing="0">
<tr>
<h3>
        <th bgcolor="grey" width="100px">Navigation</th>
</h3>
</tr>
<?php
echo '<tr><td><a href='.$cqrweblog_root.'/>Index</a></td></tr>' . "\n";
echo '<tr><td><a href='.$cqrweblog_root.'logold.php?log_id=' . $log_id . '>Log</a></td></tr>' . "\n";
echo '<tr><td><a href='.$cqrweblog_root.'logsearchold.php?log_id=' . $log_id . '>Search</a></td></tr>' . "\n";
if ($altstats[$log_id])
{
	echo '<tr><td><a href='.$cqrweblog_root.'stats2old.php?log_id=' . $log_id . '>Statistics</a></td></tr>' . "\n";
}
else
{
		echo '<tr><td><a href='.$cqrweblog_root.'statsold.php?log_id=' . $log_id . '>Statistics</a></td></tr>' . "\n";
}
echo '<tr><td><a href='.$cqrweblog_root.'publogold.php?log_id=' . $log_id . '>Public</a></td></tr>' . "\n";
?>

</table>

