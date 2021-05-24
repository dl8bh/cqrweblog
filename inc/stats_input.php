<?php
echo '<form class="form" role="form" action="stats.php?log_id=' . $log_id . '" method="post">'
?>	
<?php if (empty($call)) {
		?>
<div class="row">
<div class="col-sm-4"></div>
		<div class="form-group col-sm-1 col-xs-4">
				<label for="prefix" class="control-label">DXCC-Prefix</label>
				<input type="text" maxlength="7" size="5" id="prefix" data-toggle="tooltip" class="form-control" name="prefix" title="use % as wildcard">
		</div>
		
		<div class="form-group col-sm-1 col-xs-4">
				
				<label for="mode" class="control-label">Mode</label>
				<div id="mode">
						
						<div class="checkbox">
								<label><input type="checkbox" name="mode[]" value="CW" >CW</label>
						</div>

						<div class="checkbox">
								<label><input type="checkbox" name="mode[]" value="SSB" >SSB</label>
						</div>
						
						<div class="checkbox">
								<label><input type="checkbox" name="mode[]" value="DATA" >DATA</label> 
						</div>
				</div>	
		</div> 

		<div class="form-group col-sm-1 col-xs-4">
				<label for="qsl" class="control-label">QSL</label>
				<div id="qsl">
						<div class="checkbox">
							<label><input type="checkbox" name="confirmation_paper" value="paper" checked>Paper</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="confirmation_lotw" value="lotw" checked>LotW</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="confirmation_eqsl" value="eqsl" checked>Eqsl</label>
						</div>
   			</div>
		</div> 
</div>	
<div class="row">
<div class="col-sm-5"></div>
<input class="btn btn-primary col-sm-1 col-xs-12" type="submit" value="Submit">
</div>
</form>
<?php } ?>
