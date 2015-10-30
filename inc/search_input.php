<?php


echo '<form class="form" role="form" action="logsearch.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post">'
?>
	<div class="row">
	
	<div class="col-sm-1"></div>
	<div class="col-sm-10">

					<div class="form-group col-sm-2 ">
					<label for="band" class="control-label">Band</label> 
					<select class="form-control" id="band" name="band">
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
						
					<div class="form-group col-sm-2">
					<label for="call" class="control-label" >Callsign</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="callsign" type="text" maxlength="55" size="15" name="call" title="use % as wildcard">
					</div>
					
					<div class="form-group col-sm-1">
					<label for="dxcc" class="control-label" >DXCC</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="dxcc" type="text" maxlength="55" size="15" name="dxcc">
					</div>
						
					<div class="form-group col-sm-1">
					<label for="mode" class="control-label" >Mode</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="mode" type="text" name="mode" size="5" value="" maxlength="7">
					</div>

					<div class="form-group col-sm-2">
					<label for="name" class="control-label" >Name</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="name" type="text" name="name" maxlength="55" title="use % as wildcard" >
					</div>

					<div class="form-group col-sm-2">
					<label for="remarks" class="control-label" >Remarks</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="remarks" type="text" name="remarks" maxlength="55" title="use % as wildcard" >
					</div>

					<div class="form-group col-sm-2">
					<label for="locator" class="control-label" >Locator</label>
					<input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="locator" type="text" name="locator" maxlength="55" title="use % as wildcard" >
					</div>
	
	</div>
	<div class="col-sm-1"></div>
	</div>
	
	<div class="row">
  	
	<div class="col-sm-9"></div>
	<div class="col-sm-2">
	<div class"checkbox">
		<label><input type="checkbox" name="adif_export" value="export">Export ADIF</label>
	</div>
	<input class="btn btn-primary " type="submit" value="Search">
	</div>
	</div>
<?php
if ($inlog){
	echo '<input type="hidden" name="inlog" value="1">';
}
?>
	


</tr>
</form>
</table>
