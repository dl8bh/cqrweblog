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
if (!empty($call))
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
if (!empty($state))
{
echo ', in US-State ' . $state ;
}
}
if (empty($call))
{
//		echo '<p><h3> <font color=red>Please insert Callsign</font></h3></p>' . "\n";
}
elseif (empty($band))
{
//		echo '<p><h3> <font color=red>Please insert Frequency</font></h3></p>' . "\n";
}
else
{
$insert="insert into cqrlog_main (qsodate,time_on,time_off,callsign,freq,mode,rst_s,rst_r,name,remarks,idcall,band,adif,itu,waz,qsl_via,iota,loc,state) " . 
"values('" . $datum . "','" . $time_on . "','" . $time_on . "','" . $call . "'," . $freq . ",'" . $mode . "','" . $rst_sent . "','" . $rst_rcvd . "','" . $name . 
"','" . $remarks . "','" . $id_call . "','" . $band . "','" . $adif . "','" . $itu . "','" . $waz . "','" . $manager . "','" . $iota_nr . "','" . $locator . "','" . $state . "')";
if ($debugmode) {
echo $insert;
}
else{
$dbconnect -> select_db( logid_to_tableid( $log_id ) );
mysqli_query($dbconnect, $insert);
}
//echo " <p class='hl'>last QSOs</p>";
}
?>
