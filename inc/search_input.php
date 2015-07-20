<table align="center" border="0">
	<td width="40">Band</td>
	<td width="10"></td>
	<td width="150">Callsign</td>
	<td width="10"></td>
	<td width="150">DXCC</td>
	<td width="10"></td>
	<td width="15">Mode</td>
	<td width="10"></td>
	<td width="150">Name</td>
	<td width="10"></td>
	<td width="150">Remarks</td>
	<td width="10"></td>
	<td width="150">Locator</td>

<?php


echo '<form action="logsearch.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post">'
?>
<tr>
	<td><select name="band">
	<?php
	echo '<option>select</option>';
	$dbconnect -> select_db("cqrlog_main");
	$ergebnis = mysqli_query($dbconnect, "SELECT band FROM bands order by b_begin asc");
	while($row = mysqli_fetch_object($ergebnis))
	{
	$band_in = $row->band;
	echo '<option>' . $band_in . '</option>';
	}
	?>
	</select></td>

	<td></td>
	<td><input type="text" maxlength="55" size="15" name="call" title="use % as wildcard"></td>
	<td></td>
	<td><input type="text" maxlength="55" size="15" name="dxcc"></td>
	<td></td>
	
	<td><input type="text" name="mode" size="5" value="" maxlength="7"></td>
	<td></td>
	<td><input type="text" name="name" maxlength="55" title="use % as wildcard" ></td>
	<td></td>
	<td><input type="text" name="remarks" maxlength="55" title="use % as wildcard" ></td>
	<td></td>
	<td><input type="text" name="locator" maxlength="55" title="use % as wildcard" ></td>
	</tr><tr>
	<td>&nbsp</td>
	</tr><tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>

	<td width="150"><input type="checkbox" name="adif_export" value="export">Export ADIF</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><input type="submit" value="Search"></td>
<?php
if ($inlog){
	echo '<input type="hidden" name="inlog" value="1">';
}
?>
	


</tr>
</form>
</table>
