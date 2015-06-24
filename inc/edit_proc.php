<?php
date_default_timezone_set("UTC");
$datum=date("Y-m-d",time());
$time_on=date("H:i",time());
if (!empty($time))
{
	$time_on=$time;
}
//echo foo;
//echo $time_on;
if (!empty($call)&&$calledit)
{
echo $dxcc_name;
if (!empty($manager)) {
echo ', QSL via ' . $manager;
}
if (!empty($iota_nr))
{
echo ', ' . $iota_name . ' with IOTA reference ' . $iota_nr ;
}
if (!empty($locator))
{
echo ', at locator ' . $locator ;
}
}
if (empty($call))
{
		echo '<p><h3> <font color=red>Please edit QSO</font></h3></p>' . "\n";
}
elseif (empty($band))
{
		echo '<p><h3> <font color=red>Please insert Frequency</font></h3></p>' . "\n";
}
else
{
	/*	$date= $row->qsodate;
		$iota = $row->iota;
		$loc = $row->loc;
		$waz = $row->waz;
		$qsls = $row->qsl_s;
		$qslr = $row->qsl_r; */
$update="UPDATE cqrlog_main SET" .
" qsodate = '" . $qsodate . 
"', time_on = '" .$time_on .
"', band = '" . $band .
"', freq = '" . $freq .
"', callsign = '" . $call . 
"', rst_r = '". $rst_rcvd .
"', rst_s = '" . $rst_sent .
"', remarks = '" . $remarks .
"', mode = '" . $mode .
"', name = '" . $name .
"', qth = '" . $qth .
"', iota = '" . $iota .
"', loc = '" . $loc .
"', waz = '" . $waz .
"', qsl_s = '" . $qsls .
"', qsl_r = '" . $qslr .
"', state = '" . $state .
"', itu = '" . $itu . "'

WHERE id_cqrlog_main = '" . $qso_id . "'";
//$insert="insert into cqrlog_main (qsodate,time_on,time_off,callsign,freq,mode,rst_s,rst_r,name,remarks,idcall,band,adif,itu,waz,qsl_via,iota,loc) " . 
//"values('" . $datum . "','" . $time_on . "','" . $time_on . "','" . $call . "'," . $freq . ",'" . $mode . "','" . $rst_sent . "','" . $rst_rcvd . "','" . $name . 
//"','" . $remarks . "','" . $id_call . "','" . $band . "','" . $adif . "','" . $itu . "','" . $waz . "','" . $manager . "','" . $iota_nr . "','" . $locator . "')";
if ($debugmode) {
echo $update;
}
else{
echo $update;
$dbconnect -> select_db( logid_to_tableid( $log_id ) );
mysqli_query($dbconnect, $update);
}
echo " <p class='hl'>last QSOs</p>";
}
?>
