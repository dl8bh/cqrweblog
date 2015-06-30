<?php
?>	
	<table align="center" border="0">
	<tr>
	<td width="40">Band</td>
	<td width="10"></td>
	<td width="40">Time</td>
	<td width="10"></td>
	<td width="40">Frequency</td>
	<td width="10"></td>
	<td width="150">Callsign</td>
	<td width="10"></td>
	<td width="15">Mode</td>
	<td width="10"></td>
	<td width="15">RST_S</td>
	<td width="10"></td>
	<td width="15">RST_R</td>
	<td width="10"></td>
	<td width="150">Name</td>
	<td width="10"></td>
	<td width="150">Remarks</td>
	<td width="10"></td>
	<td width="10"></td>
	<td width="10"></td>
	</tr>
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_id)) {
		$urlparameter .= '&qso_id=' . $qso_id;
}

echo '<form name="input" action="edit.php' . $urlparameter . '" method="post">';
?>
<tr>
	<td><select name="band_input" tabindex=1>
	<?php
	echo '<option>select</option>';
	$dbconnect -> select_db("cqrlog_common");
	$ergebnis = mysqli_query($dbconnect, "SELECT band FROM bands order by b_begin asc");
	while($row = mysqli_fetch_object($ergebnis))
	{
	$band_in = $row->band;
	echo '<option>' . $band_in . '</option>';
	}
	echo '</select></td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input type="text" name="time_input" size="5" maxlength="5" tabindex="1" value ="' . $time . '" </td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input id="freq" type="text" maxlength="55" size="15" name="frequency_input" value="' . $freq . '" tabindex=1" title="only band or frequency is needed" ></td> ';
	echo '<td></td>' . "\n";
	echo '<td><input id="call" type="text" maxlength="55" size="15" name="call_input" value="' . $callsign . '" tabindex="2" onchange="data_copy()" autofocus ></td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input type="text" name="mode_input" size="5" value="' . $mode . '" tabindex="3" maxlength="7"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="rst_sent_input" size="8" value="' . $rst_s  . '" maxlength="10" tabindex="4"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="rst_rcvd_input" size="8" value="' . $rst_r . '" maxlength="10" tabindex="5"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="name_input" value="' . $name . '" maxlength="55" tabindex="6"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="remarks_input" value="' . $remarks . '" maxlength="55" tabindex="7"></td>';
	echo '<td></td>';
	echo '<td><input type="submit" value="save QSO"></td>';
	?>

<?php
	echo '<td></td>';
?>
</tr>
</table>



	<table align="center" border="0">
	<tr>
	<td width="10">Date</td>
	<td width="10"></td>
	<td width="40">STATE</td>
	<td width="10"></td>
	<td width="40">ITU</td>
	<td width="10"></td>
	<td width="15">WAZ</td>
	<td width="10"></td>
	<td width="15">IOTA</td>
	<td width="10"></td>
	<td width="15">QSL_S</td>
	<td width="10"></td>
	<td width="15">QSL_R</td>
	<td width="10"></td>
	<td width="150">QTH</td>
	<td width="10"></td>
	<td width="150">Locator</td>
	<td width="10"></td>
	<td width="150">Manager</td>
	<td width="10"></td>
	<td width="10"></td>
	</tr>
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_id)) {
		$urlparameter .= '&qso_id=' . $qso_id;
}

  echo '<tr>' . "\n";
	echo '<td><input type="date" name="date_input" size="10" maxlength="10" value ="' . $date . '" </td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input type="text" name="state_input" size="4" maxlength="4" tabindex="1" value ="' . $state . '" </td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input type="text" maxlength="2" size="1" name="itu_input" value="' . $itu . '"  ></td> ';
	echo '<td></td>' . "\n";
	echo '<td><input id="call" type="text" maxlength="2" size="1" name="waz_input" value="' . $waz . '"></td>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td><input type="text" name="iota_input" size="8" value="' . $iota_nr . '" maxlength="8"></td>';
	echo '<td></td>';
	echo '<td><select name=qsls_input>' ."\n";
	echo '<option>' . $qsls . '</option>' . "\n";
	echo '<option></option>' . "\n";
	echo '<option>N</option>' . "\n";
	echo '<option>B</option>' . "\n";
	echo '<option>SB</option>' . "\n";
	echo '<option>D</option>' . "\n";
	echo '<option>SD</option>' . "\n";
	echo '<option>M<o/ption>' . "\n";
	echo '<option>SM</option>' . "\n";
	echo '<option>OQRS</option>' . "\n";
	echo '</select></td>' . "\n";
//	echo '<td><input type="text" name="rst_sent_input" size="8" value="' . $rst_s  . '" maxlength="10" tabindex="4"></td>';
	echo '<td></td>';
	echo '<td><select name=qslr_input>' ."\n";
	echo '<option>' . $qslr . '</option>' . "\n";
	echo '<option>Q</option>' . "\n";
	echo '<option></option>' . "\n";
	echo '</select></td>' . "\n";
//	echo '<td><input type="text" name="rst_rcvd_input" size="8" value="' . $rst_r . '" maxlength="10" tabindex="5"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="qth_input" value="' . $qth . '" maxlength="55" tabindex="6"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="loc_input" value="' . $loc . '" maxlength="55" tabindex="7"></td>';
	echo '<td></td>';
	echo '<td><input type="text" name="manager_input" value="' . $manager . '" maxlength="55" tabindex="7"></td>';
	echo '<td></td>';

	echo '<td></td>';
?>
</tr>
</table>















</form>
