<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<th bgcolor="grey" width="100px">Date</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="50px">Time</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15px"></td>
<th bgcolor="grey" width="40px">Band</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="150px">Call sign</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="100px">Mode</th>
<td width="5"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="100px">RST Sent</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="100px">RST Rcvd</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="200px">Name</th>
<td width="15"></td><td bgcolor="Black" width="1px"></td><td width="15"></td>
<th bgcolor="grey" width="450px">Remarks</th>
</tr>
<?php
$dbconnect -> select_db( logid_to_tableid( $log_id ) );
//$dbconnect -> select_db("cqrlog001");
$qso_count = mysqli_real_escape_string($dbconnect ,$qso_count);
$query = mysqli_query($dbconnect, "SELECT qsodate, time_on, callsign, band, mode, rst_r, rst_s, remarks, name FROM view_cqrlog_main_by_qsodate " . $where . " LIMIT " . $qso_count);
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

		echo '<tr>' . "\n";
		echo '<td>' . $date . '</td>' . "\n";
	  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
   	echo '<td>' . $time . '</td>' . "\n";
	  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td align="center">' . $band . '</td>' . "\n";
		echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td align="center"><font color="red"><b>' . $callsign . '</b></font></td>' . "\n";
		echo ' <td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
   	echo '<td align="center"><i>' . $mode . '</i></td>' . "\n";
		echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td>' . $rst_s . '</td>' . "\n";
		echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td>' . $rst_r . '</td>' . "\n";
		echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td>' . $name . '</td>' . "\n";
		echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
		echo '<td>' . $remarks . '</td>' . "\n";
		echo '</tr>' . "\n";



}

</table>
?>
