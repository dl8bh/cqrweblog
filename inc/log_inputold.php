	<table align="center" border="0">
	<td width="40">Band</td>
	<td width="10"></td>
	<td width="40">Time</td>
	<td width="10"></td>
	<?php
	if (!empty($band)) {	
			echo '<p id=frequency><td width="40">Frequency</td></p>' ."\n";
	}
	else {
			echo '<p id=frequency><td width="40"><b><font color=red>Frequency</font></b></td></p>' ."\n";
	}
	echo '<td width="10"></td>' . "\n";
	if (!empty($call)) {
			echo '<p id=callsign><td width="150">Callsign</td></p>' . "\n";
	}
	else {
			echo '<p id=callsign><td width="150"><b><font color=red>Callsign</font></b></td></p>' . "\n";
	}
	?>
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
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_count)) {
		$urlparameter .= '&qso_count=' . $qso_count;
}

echo '<form name="input" action="logold.php' . $urlparameter . '" method="post">';
?>
<tr>
	<td><select name="band" tabindex=1>
	<?php
	echo '<option>select</option>';
	$dbconnect -> select_db("cqrlog_common");
	$ergebnis = mysqli_query($dbconnect, "SELECT band FROM bands order by b_begin asc");
	while($row = mysqli_fetch_object($ergebnis))
	{
	$band_in = $row->band;
	echo '<option>' . $band_in . '</option>';
	}
	?>
	</select></td>
	<td></td>
	<td><input onClick="this.setSelectionRange(0,this.value.length)" type="text" name="time" size="5" value="" maxlength="5" tabindex="1" title="optional, if empty: time in UTC, input format: hh:mm or hhmm"></td>
	<td></td>
	<?php
	if (isset($freq))
	{
	echo '<td><input onClick="this.setSelectionRange(0,this.value.length)" id="freq" type="text" maxlength="55" size="15" name="frequency" value="' . $freq . '" tabindex=1" title="only band or frequency is needed" ></td> ';
	}
	else
	{
	echo '<td><input  onClick="this.setSelectionRange(0,this.value.length)" id="freq" type="text" maxlength="55" size="15" name="frequency" tabindex="1" value="" title="only band or frequency is needed" ></td> ';
	}
	?>
	<td></td>
	<td><input id="call" type="text" maxlength="55" size="15" name="call" tabindex="2" onchange="data_copy()" autofocus ></td>
	<td></td>
	<?php
	if (empty($mode))
			{
					$mode=$defaultmode;
			}
	if ($mode == "CW")
	{
			$rapport=$default_cw_rapport;
	}
	elseif ($mode=="SSB")
	{
			$rapport=$default_ssb_rapport;
	}
	else {
			$rapport=$default_cw_rapport;
	}
	echo '<td><input onClick="enable_space(); this.setSelectionRange(0,this.value.length); enable_space();" type="text" name="mode" size="5" value="' . $mode . '" tabindex="3" maxlength="7"></td>';
	echo '<td></td>';
	echo '<td><input onClick="this.setSelectionRange(0,this.value.length)" type="text" name="rst_sent" size="8" value="' . $rapport  . '" maxlength="10" tabindex="4"></td>';
	echo '<td></td>';
	echo '<td><input onClick="this.setSelectionRange(0,this.value.length)" type="text" name="rst_rcvd" size="8" value="' . $rapport . '" maxlength="10" tabindex="5"></td>';
	echo '<td></td>';
	echo '<td><input onClick="this.setSelectionRange(0,this.value.length)" type="text" name="name" maxlength="55" tabindex="6"></td>';
	echo '<td></td>';
	echo '<td><input onClick="this.setSelectionRange(0,this.value.length)" type="text" name="remarks" maxlength="55" tabindex="7"></td>';
	echo '</tr><tr><td>&nbsp</td></tr><tr><td></td><td></td>';
	echo '<td><input type="submit" value="Log"></td>';
	echo '</form>' . "\n";
	echo '<td></td>';
?>

<?php
	if ($altstats[$log_id])
	{
			echo '<form name="stats" action="stats2.php' . $urlparameter . '" target="_blank"  method="post">';
	}
	else
	{
			echo '<form name="stats" action="stats.php' . $urlparameter . '" target="_blank"  method="post">';
	}
	echo '<td><input type="submit" value="Check DXCC" accesskey="C" title="shortcut browser accesskey + C"></td>';

echo '<input type="hidden" name="callsign" value="">' . "\n";
echo '<input type="hidden" name="inlog" value="1">' . "\n";
echo '</form>' . "\n" ;
echo '<td></td>' . "\n";


echo '<form name="search" action="logsearch.php' . $urlparameter . '" target="_blank"  method="post">';
echo '<td><input type="submit" value="In log?" accesskey="S" title="shortcut browser accesskey + S" >' . "\n";
echo '<input type="hidden" name="call" value="">' . "\n";
echo '<input type="hidden" name="inlog" value="1">' . "\n";
echo '</form>';
?>
<input type="submit" value="QRZ?" onclick="qrz_call()" title="shortcut: Alt+q"></td>
<td></td>
<td><input type="submit" value="Cancel" onclick="wipe_data()" title="shortcut: Alt+w/F11"></td>
<tr>
</tr>
</table>
<?php
if ($enable_help[$log_id]) {
		echo '</br>' ."\n" ;
		echo 'Shortcuts: Alt+w/F11: Wipe Alt+q: qrz.com </br>' . "\n";
		echo 'Remarks-Strings: I:IOTA L:LOCATOR M:MANAGER S:STATE</br>' . "\n";
		echo '<a href="./README.txt" target="_blank" >Complete Manual</a> ' . "\n";
}
