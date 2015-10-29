<table align="center" border="0">
	<td width="15">Your Callsign</td>
	<td width="10"></td>
<?php
if (!empty($publog))
{
//echo '<form action="pubsearch.php?log_id=' . $log_id . '" target="_blank" method="post">';
echo '<form action="pubsearch.php?log_id=' . $log_id . '" method="post">';
}
else
{
		echo '<form action="pubsearch.php?log_id=' . $log_id . '" method="post">';
}
?>
<tr>
	<td><input type="text" maxlength="15" size="15" name="call"></td>
	<td></td>
	<td><input class="btn btn-primary" type="submit" value="Am I in log?"></td>
</tr>
</form>
</table>
