<?php
?>	
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_id)) {
		$urlparameter .= '&qso_id=' . $qso_id;
}


?>
<form class="form" role="form" name="input" action="edit.php<?php echo  $urlparameter; ?>" method="post">
<div class="row">
	<div class="form-group col-sm-1">
			<label for="band" class="control-label">Band</label> 
			<select class="form-control" id="band_input" name="band_input">
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



	<div class="form-group col-sm-1">
		<label for="freq" class="control-label">Frequency</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" id="freq" class="form-control" type="text" maxlength="55" size="15" name="frequency_input" value="<?php echo $freq ;?>" tabindex=1" data-toggle="tooltip" title="only band or frequency is needed" >
	</div>

	<div class="form-group col-sm-2">
		<label for="call" class="control-label">Callsign</label>
		<input id="call" class="form-control" type="text" maxlength="55" size="15" name="call_input" value="<?php echo $callsign; ?>" tabindex="2" onchange="data_copy()" autofocus >
	</div>


	<div class="form-group col-sm-1">
		<label for="mode_input" class="control-label">Mode</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="mode_input" class="form-control" name="mode_input" size="5" value="<?php echo $mode ; ?>" tabindex="3" maxlength="7">
	</div>
	
	
	<div class="form-group col-sm-1">
		<label for="rst_sent_input" class="control-label">RST_S</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" id="rst_sent_input" class="form-control" type="text" name="rst_sent_input" size="8" value="<?php echo $rst_s; ?>" maxlength="10" tabindex="4">
	</div>
	
	
	<div class="form-group col-sm-1">
		<label for="rst_rcvd_input" class="control-label">RST_R</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="rst_rcvd_input" class="form-control" name="rst_rcvd_input" size="8" value="<?php echo $rst_r; ?>" maxlength="10" tabindex="5">
	</div>
	
	<div class="form-group col-sm-2">
		<label for="name_input" class="control-label">Name</label>
		<input type="text" id="name_input" class="form-control" name="name_input" value="<?php echo $name ;?>" maxlength="55" tabindex="6">
	</div>
	
	<div class="form-group col-sm-3">
		<label for="remarks_input" class="control-label">Remarks</label>
		<input type="text" id="remarks_input" class="form-control" name="remarks_input" value="<?php echo $remarks ;?>" maxlength="55" tabindex="7">
	</div>





</div>
<?php
$urlparameter = '?log_id=' . $log_id;

if (isset($qso_id)) {
		$urlparameter .= '&qso_id=' . $qso_id;
}
?>
<div class="row">

	<div class="form-group col-sm-1">
		<label for="time_input" class="control-label">Time</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="time_input" type="text" name="time_input" size="5" maxlength="5" tabindex="1" value ="<?php echo $time ;?>">
	</div>
	


	<div class="form-group col-sm-1">
		<label for="date_input" class="control-label">Date</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="date_input"  type="date" name="date_input" size="10" maxlength="10" value="<?php echo $date ;?>">
	</div>

	<div class="col-sm-3">
	<div class="form-group col-sm-3">
		<label for="state_input" class="control-label">State</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="state_input" class="form-control" name="state_input" size="4" maxlength="4" tabindex="1" value ="<?php echo $state; ?>">
	</div>


	<div class="form-group col-sm-3">
		<label for="itu_input" class="control-label">ITU</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="itu_input" class="form-control" maxlength="2" size="1" name="itu_input" value="<?php echo $itu; ?>"  >
	</div>


	<div class="form-group col-sm-3">
		<label for="waz_input" class="control-label">WAZ</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" id="waz_input" class="form-control" type="text" maxlength="2" size="1" name="waz_input" value="<?php echo $waz; ?>">
	</div>
	
	
	<div class="form-group col-sm-3">
		<label for="iota_input" class="control-label">IOTA</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="iota_input" class="form-control" name="iota_input" size="8" value="<?php echo $iota_nr; ?>" maxlength="8">
	</div>
	</div>

	<div class="form-group col-sm-1">
			<label for="qsls_input" class="control-label">QSL_S</label> 
				<select class="form-control" id="qsls_input" name="qsls_input">
						<option><?php echo $qsls ;?></option>
						<option></option> 
						<option>N</option>
						<option>B</option>
						<option>SB</option>
						<option>D</option>
						<option>SD</option> 
						<option>M</option>
						<option>SM</option> 
						<option>OQRS</option>
				</select>
	</div>


	<div class="form-group col-sm-1">
			<label for="qslr_input" class="control-label">QSL_R</label> 
				<select class="form-control" id="qslr_input" name="qslr_input">
						<option><?php echo $qslr ?></option>
						<option>Q</option>
						<option></option>
				</select> 
	</div>

	<div class="form-group col-sm-2">
		<label for="qth_input" class="control-label">QTH</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="qth_input" class="form-control" name="qth_input" value="<?php echo $qth; ?>" maxlength="55" tabindex="6">
	</div>
	
	<div class="form-group col-sm-1">
		<label for="loc_input" class="control-label">Locator</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="loc_input" class="form-control" name="loc_input" value="<?php echo $loc; ?>" maxlength="55" tabindex="7">
	</div>
	
	<div class="form-group col-sm-2">
		<label for="manager_input" class="control-label">Manager</label>
		<input onClick="this.setSelectionRange(0,this.value.length)" type="text" id="manager_input" class="form-control" name="manager_input" value="<?php echo $manager ?>" maxlength="55" tabindex="7">
	</div>



</div>
<div class="row">
<div class="col-sm-5"></div>
<div class="checkbox col-sm-1">
<label class="bg-danger" data-toggle="tooltip" title="DELETES QSO IF CHECKED"><input type="checkbox" name="Delete" value="1" id="CheckDel"><strong>DELETE</strong></label>
</div>
	<input class="btn btn-primary col-sm-1" type="submit" value="SAVE">
</div>
</form>
