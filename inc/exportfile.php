<?php

$filename = strtoupper(logid_to_call($log_id)) . '.adi';
$filename = str_replace("/","-",$filename);
$filepath = $exportdir . $filename;
$file = fopen($filepath,"w+");
$fileheader =  '<ADIF_VER:5>2.2.1' . "\n";
$fileheader .= 'ADIF export from cqrweblog' . "\n\n";
$fileheader .= 'Internet: http://www.dl8bh.de/cqrweblog/' . "\n\n";
$fileheader .= '<PROGRAMID:9>CQRWEBLOG' . "\n";
$fileheader .= '<PROGRAMVERSION:3>0.9' . "\n";
$fileheader .= '<EOH>' . "\n";
fwrite($file, $fileheader);
$dbconnect -> select_db( logid_to_tableid( $log_id ) );

$query = mysqli_query($dbconnect, "SELECT * FROM view_cqrlog_main_by_qsodate t1 join cqrlog_main t2 on t1.id_cqrlog_main = t2.id_cqrlog_main " . $where_export , MYSQLI_USE_RESULT );
while($row = mysqli_fetch_object($query))
		{
		$qsodate= $row->qsodate;
		$call = $row->callsign;
		$timeon = $row->time_on;
		$timeoff = $row->time_off;
		$band = $row->band;
		$mode = $row->mode;
		$freq = $row->freq;
		$rst_rcvd = $row->rst_r;	
		$rst_sent = $row->rst_s;
		$comment = $row->remarks;
		$name = $row->name;
		$qsl_sent = $row->qsl_s;
		$qsl_rcvd = $row->qsl_r;
		$qsl_via = $row->qsl_via;
		$iota = $row->iota;
		$adif = $row->adif;
		$itu = $row->itu;
		$cqz = $row->waz;
		$state = $row->state;
		$lotws = $row->lotw_qsls;
		$lotwr = $row->lotw_qslr;
		$lotwsdate = $row->lotw_qslsdate;
		$lotwrdate = $row->lotw_qslrdate;
		$eqsls = $row->eqsl_qsl_sent;
		$eqslr = $row->eqsl_qsl_rcvd;
		$eqslsdate = $row->eqsl_qslsdate;
		$eqslrdate = $row->eqsl_qslrdate;
		$qslrdate = $row->qslr_date;
		$qslsdate = $row->qsls_date;

$fileinput = qso_to_adif( $qsodate, $timeon, $timeoff, $call, $mode, $freq, $band, $rst_sent, $rst_rcvd, $name, $comment, $qsl_sent, $qsl_rcvd, $qsl_via, $iota, $adif, $itu, $cqz, $state, $qslrdate, $qslsdate , $lotws, $lotwr, $lotwsdate, $lotwrdate, $eqsls, $eqslr, $eqslsdate, $eqslrdate  ) . "\n";
fwrite ($file, $fileinput);
fflush ($file);

}
mysqli_free_result($query);

fclose($file);
echo '<h3><a href="' . $filepath . '">Download ADI</a></h3>';
?>
