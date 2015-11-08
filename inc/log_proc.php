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
echo '<div class="row"><div class="col-sm-9">' . "\n";
if (!empty($call))
{
$infostring = $dxcc_name;
if (!empty($manager)) {
$infostring .= ', QSL via ' . $manager;
}
if (!empty($iota_nr))
{
$infostring .= ', ' . $iota_name . ' with IOTA reference ' . $iota_nr ;
}
if (!empty($locator))
{
$infostring .= ', at locator ' . $locator ;
}
if (!empty($state))
{
$infostring .= ', in US-State ' . $state ;
}
echo '<div class=" clearfix alert alert-success ">' . "\n" .
  '<strong>Info: </strong>' . $infostring . "\n" .
'</div>';
}
echo '</div>' . "\n";
if (empty($call))
{
}
elseif (empty($band))
{
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
}
?>
