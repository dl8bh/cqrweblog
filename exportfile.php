<?php
include("inc/header.php");
include("inc/parse_log.php");

header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="downloaded.csv"');

echo '<ADIF_VER:5>2.2.1' . "\n";
echo 'ADIF export from cqrweblog' . "\n\n";
echo 'Internet: http://www.dl8bh.de/cqrweblog/' . "\n\n";
echo '<PROGRAMID:9>CQRWEBLOG' . "\n";
echo '<PROGRAMVERSION:3>0.9' . "\n";
echo '<EOH>' . "\n";

$dbconnect -> select_db( logid_to_tableid( $log_id ) );


$query = mysqli_query($dbconnect, "SELECT * FROM view_cqrlog_main_by_qsodate t1 join cqrlog_main t2 on t1.id_cqrlog_main = t2.id_cqrlog_main " . $where . " LIMIT " . $qso_count);
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

echo qso_to_adif( $qsodate, $timeon, $timeoff, $call, $mode, $freq, $band, $rst_sent, $rst_rcvd, $name, $comment, $qsl_sent, $qsl_rcvd, $qsl_via, $iota, $adif, $itu, $cqz, $qslrdate, $qslsdate , $lotws, $lotwr, $lotwsdate, $lotwrdate, $eqsls, $eqslr, $eqslsdate, $eqslrdate  );

}

?>
