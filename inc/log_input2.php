<table>
</table>
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_count)) {
		$urlparameter .= '&qso_count=' . $qso_count;
}

echo '<form class="form-inline" role="form" name="input" action="log2.php' . $urlparameter . '" method="post">';
?>
	<div class="form-group " >
	<label for="band" class="control-label">Band</label>
	<select class="form-control" id="band" name="band" tabindex=1>
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
	</select>
	</div>
	<div class="form-group ">
    <label for="time" class="control-label">Time</label>
	<input id="time" class="form-control" onClick="this.setSelectionRange(0,this.value.length)" type="text" name="time" size="5" value="" maxlength="5" tabindex="1" title="optional, if empty: time in UTC, input format: hh:mm or hhmm">
</div>
  <div class="form-group <?php if (!isset($freq)) { echo "has-error has-feedback" ; }  ?>">	
    <label for="freq" class="control-label">Frequency</label>
	<?php
	if (isset($freq))
	{
	echo '<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="freq" type="text" maxlength="55" size="15" name="frequency" value="' . $freq . '" tabindex=1" title="only band or frequency is needed" > ';
	}
	else
	{
	echo '<input  onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="freq" type="text" maxlength="55" size="15" name="frequency" tabindex="1" value="" title="only band or frequency is needed" >';
	echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
	}
	?>
	</div>
  <div class="form-group <?php if (empty($call)) { echo "has-error has-feedback" ; }  ?>">
    <label for="call" class="control-label">Callsign</label>
	<input id="call" class="form-control	" type="text" maxlength="55" size="15" name="call" tabindex="2" onchange="data_copy()" autofocus >
	<?php if (empty($call)) { echo' <span class="glyphicon glyphicon-remove form-control-feedback"></span>';} ?>
	</div>
  <div class="form-group ">
    <label for="mode">Mode</label>
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
	echo '<input onClick="enable_space(); this.setSelectionRange(0,this.value.length); enable_space();" id="mode" class="form-control" type="text" name="mode" size="5" value="' . $mode . '" tabindex="3" maxlength="7"></div>';
	echo '<div class="form-group "><label for="rst_sent">RST_S</label>';
	echo '<input onClick="this.setSelectionRange(0,this.value.length)" type="text" class="form-control" id="rst_sent" name="rst_sent" size="8" value="' . $rapport  . '" maxlength="10" tabindex="4"></div>';
	echo '<div class="form-group "><label for="rst_rcvd">RST_R</label>';
	echo '<input onClick="this.setSelectionRange(0,this.value.length)" type="text" class="form-control" id="rst_rcvd" name="rst_rcvd" size="8" value="' . $rapport . '" maxlength="10" tabindex="5"></div>';
	?>
	<div class="form-group "><label for="name">Name</label>
	<input onClick="this.setSelectionRange(0,this.value.length)" type="text" class="form-control" id="name" name="name" maxlength="55" tabindex="6"></div>
	<div class="form-group "><label for="remarks">Remarks</label>
	<input onClick="this.setSelectionRange(0,this.value.length)" type="text" class="form-control" id="remarks" name="remarks" maxlength="55" tabindex="7"></div>
	<input class="btn btn-primary " type="submit" value="Log">
	</form>


</div>
</div>
<div class="row"><div class="col-sm-1">
<?php
	if ($altstats[$log_id])
	{
			echo '<form name="stats" action="stats2new.php' . $urlparameter . '" target="_blank"  method="post">';
	}
	else
	{
			echo '<form name="stats" action="statsnew.php' . $urlparameter . '" target="_blank"  method="post">';
	}
	echo '<input class="btn btn-info" type="submit" value="Check DXCC" accesskey="C" title="shortcut browser accesskey + C">';

echo '<input type="hidden" name="callsign" value="">' . "\n";
echo '<input type="hidden" name="inlog" value="1">' . "\n";
echo '</form></div>' . "\n" ;
echo '' . "\n";


echo '<div class="col-sm-1"><form name="search" action="logsearch2.php' . $urlparameter . '" target="_blank"  method="post">';
echo '<input class="btn btn-info" type="submit" value="In log?" accesskey="S" title="shortcut browser accesskey + S" >' . "\n";
echo '<input type="hidden" name="call" value="">' . "\n";
echo '<input type="hidden" name="inlog" value="1">' . "\n";
echo '</form></div>';
?>
<input class="btn btn-info" type="submit" value="QRZ?" onclick="qrz_call()" title="shortcut: Alt+q">
<input class="btn btn-warning" type="submit" value="Cancel" onclick="wipe_data()" title="shortcut: Alt+w/F11">
</div>
<?php
if ($enable_help[$log_id]) {
		echo '</br>' ."\n" ;
		echo 'Shortcuts: Alt+w/F11: Wipe Alt+q: qrz.com </br>' . "\n";
		echo 'Remarks-Strings: I:IOTA L:LOCATOR M:MANAGER S:STATE</br>' . "\n";
		echo '<a href="./README.txt" target="_blank" >Complete Manual</a> ' . "\n";
}
