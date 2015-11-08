<div class="table-responsive" id="qso">
<table id=qsotable class="table table-condensed table-hover" align="center"  cellpadding="0" cellspacing="0">
<tr>
<th bgcolor="grey" width="100px">Date</th>
<th bgcolor="grey" width="50px">Time</th>
<th bgcolor="grey" style="text-align:center" width="40px">Band</th>
<th bgcolor="grey" style="text-align:center" width="150px">Call sign</th>
<th bgcolor="grey" style="text-align:center" width="100px">Mode</th>
<th class="hidden-xs" bgcolor="grey" width="100px">RST Sent</th>
<th class="hidden-xs" bgcolor="grey" width="100px">RST Rcvd</th>
<th class="hidden-xs" bgcolor="grey" width="200px">Name</th>
<th class="hidden-xs" bgcolor="grey" width="450px">Remarks</th>
<th bgcolor="grey" width="40px">Edit</th>
</tr>
<?php
$dbconnect -> select_db( logid_to_tableid( $log_id ) );
$qso_count = mysqli_real_escape_string($dbconnect ,$qso_count);
$query = mysqli_query($dbconnect, "SELECT id_cqrlog_main, qsodate, time_on, callsign, band, mode, rst_r, rst_s, remarks, name FROM view_cqrlog_main_by_qsodate " . $where . " LIMIT " . $qso_count);
while($row = mysqli_fetch_object($query))
		{
		$date= $row->qsodate;
		$callsign = $row->callsign;
		$time = $row->time_on;
		$band = $row->band;
		$mode = $row->mode;
		$rst_r = $row->rst_r;	
		$rst_s = $row->rst_s;
		$remarks = $row->remarks;
		$name = $row->name;
		$qso_id_table = $row->id_cqrlog_main;
		echo '<tr>' . "\n";
		echo '<td>' . $date . '</td>' . "\n";
   	echo '<td>' . $time . '</td>' . "\n";
		echo '<td align="center">' . $band . '</td>' . "\n";
		echo '<td align="center"><font color="red"><b>' . $callsign . '</b></font></td>' . "\n";
   	echo '<td align="center"><i>' . $mode . '</i></td>' . "\n";
		echo '<td class="hidden-xs">' . $rst_s . '</td>' . "\n";
		echo '<td class="hidden-xs">' . $rst_r . '</td>' . "\n";
		echo '<td class="hidden-xs">' . $name . '</td>' . "\n";
		echo '<td class="hidden-xs">' . $remarks . '</td>' . "\n";
		echo '<td><a href="edit.php?log_id=' . $log_id . '&qso_id=' . $qso_id_table .'" target="_blank">Edit</a></td>' . "\n"; 
		echo '</tr>' . "\n";


}

?>
</table>
</div>
