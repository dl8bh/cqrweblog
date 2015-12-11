<div class="table-responsive" id=qso>
<table align="center" class="table table-condensed table-hover" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th width="100px">Date</th>
<th width="50px">Time</th>
<th style="text-align:center" width="40px">Band</th>
<th style="text-align:center" width="150px">Call sign</th>
<th style="text-align:center" width="100px">Mode</th>
<th class="hidden-xs" width="90px">RST Sent</th>
<th class="hidden-xs" width="90px">RST Rcvd</th>
<th class="hidden-xs" width="100px">Name</th>
<?php if ($enable_pubqslr[$log_id]) {
echo '<th class="hidden-xs" width="100px">QSL Rcvd</th>' ."\n";
} 
if ($enable_pubqsls[$log_id]) {
echo '<th class="hidden-xs" width="100px">QSL Sent</th>' . "\n";
} ?>
</thead>
</tr>
<?php
$dbconnect -> select_db( logid_to_tableid( $log_id ) );
//$dbconnect -> select_db("cqrlog001");
$qso_count = mysqli_real_escape_string($dbconnect ,$qso_count);
$query = mysqli_query($dbconnect, "SELECT qsodate, time_on, callsign, band, mode, rst_r, rst_s, remarks, name, qsl_r, qsl_s, qslr_date, qsls_date FROM view_cqrlog_main_by_qsodate " . $where . " LIMIT " . $qso_count);
while($row = mysqli_fetch_object($query))
		{
		$date= $row->qsodate;
		$callsign = $row->callsign;
		$time = $row->time_on;
		$band = $row->band;
		$mode = $row->mode;
		$rst_r = $row->rst_r;	
		$rst_s = $row->rst_s;
		$qsl_s = $row->qsl_s;
		$qsl_r = $row->qsl_r;
		$qslrdate = $row->qslr_date;
		$qslsdate = $row->qsls_date;
		$name = $row->name;
		
		if ($enable_pubqslr[$log_id]) {
				switch ($qsl_r) {
					case 'Q' :
						$qsl_r= $qslrdate;
						break;
					case '' :
				}	
		}
		
		if ($enable_pubqsls[$log_id]) {
				switch ($qsl_s) {
					case 'B' :
						$qsl_s= $qslsdate . ' via Bureau';
						break;
					case 'D' :
						$qsl_s= $qslsdate . ' via Direct';
						break;
					case 'SB' :
						$qsl_s= '';
						break;


					case '' :
					default :
						$qsl_s='';
						break;
				}
		}
		echo '<tr>' . "\n";
		echo '<td>' . $date . '</td>' . "\n";
   	echo '<td>' . $time . '</td>' . "\n";
		echo '<td align="center">' . $band . '</td>' . "\n";
		echo '<td align="center"><font color="red"><b>' . $callsign . '</b></font></td>' . "\n";
   	echo '<td align="center"><i>' . $mode . '</i></td>' . "\n";
		echo '<td class="hidden-xs">' . $rst_s . '</td>' . "\n";
		echo '<td class="hidden-xs">' . $rst_r . '</td>' . "\n";
		echo '<td class="hidden-xs">' . $name . '</td>' . "\n";
		if ($qslrstat[$log_id]) {
		echo '<td class="hidden-xs">' . $qsl_r . '</td>' . "\n";
		}

		if ($qslsstat[$log_id]) {
		echo '<td class="hidden-xs">' . $qsl_s . '</td>' . "\n";
		}
		echo '</tr>' . "\n";



}
?>
</table>
