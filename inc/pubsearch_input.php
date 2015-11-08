<?php
if (!empty($publog))
{
echo '<form class="form" role="form" action="pubsearch.php?log_id=' . $log_id . '" method="post">';
}
else
{
		echo '<form class="form" role="form" action="pubsearch.php?log_id=' . $log_id . '" method="post">';
}
?>
	<div class="row">
	<div class="col-xs-3 col-sm-5"></div>
	<div class="col-xs-6 col-sm-2">
	<div class="form-group">
		<label for="call" class="control-label">Your Callsign</label>
	<input class="form-control" type="text" maxlength="15" size="15" name="call" id="call">
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-xs-3 col-sm-5"></div>
	<input class="col-xs-6 col-sm-2 btn btn-primary" type="submit" value="Am I in log?">
	</div>
	</form>
