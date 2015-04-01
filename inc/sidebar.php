<?php
//include("/db.php");
/*
echo '<a href=/>Index</a>' . "\n";
echo '<br>' . "\n";
echo '<a href=log.php?log_id=' . $log_id . '>Log</a>' . "\n";
echo '<br>' . "\n";
echo '<a href=logsearch.php?log_id=' . $log_id . '>Search</a>' . "\n";
echo '<br>' . "\n";
echo '<a href=publog.php?log_id=' . $log_id . '>Public</a>' . "\n";
*/
?>

<table align=center border="0" cellpadding="0" cellspacing="0">
<tr>
<h3>
        <th bgcolor="grey" width="100px">Navigation</th>
</h3>
</tr>
<?php
echo '<tr><td><a href=/>Index</a></td></tr>' . "\n";
echo '<tr><td><a href=log.php?log_id=' . $log_id . '>Log</a></td></tr>' . "\n";
echo '<tr><td><a href=logsearch.php?log_id=' . $log_id . '>Search</a></td></tr>' . "\n";
echo '<tr><td><a href=stats.php?log_id=' . $log_id . '>Statistics</a></td></tr>' . "\n";
echo '<tr><td><a href=publog.php?log_id=' . $log_id . '>Public</a></td></tr>' . "\n";
?>

</table>

