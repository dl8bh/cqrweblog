<?php
date_default_timezone_set("UTC");
$datum=date("Y-m-d",time());
$time_on=date("H:i",time());
if (!empty($time)){
	$time_on=$time;
}
if (!empty($call)&&$calledit){
    echo $dxcc_name;
    if (!empty($manager)) {
	echo ', QSL via ' . $manager;
    }
    if (!empty($iota_nr)){
	echo ', ' . $iota_name . ' with IOTA reference ' . $iota_nr ;
    }
    if (!empty($locator)){
	echo ', at locator ' . $locator ;
    }
}
if (empty($call)){
	echo '<p><b><center><font color="red">Edit qso details or check DELETE to delete qso. Click SAVE when ready.</font></center></b></p>' . "\n";
 }
 elseif (empty($band)){
	echo '<p><b><center><font color="red">Please insert Frequency</font></center></b></p>' . "\n";
 }
 else{
    if (isset($_POST['Delete'])){
    $update="DELETE from cqrlog_main WHERE id_cqrlog_main = '" . $qso_id . "'";
    }
    else {

				if (!isset($adif)) {

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
						"', iota = '" . $iota_nr .
						"', loc = '" . $loc .
						"', waz = '" . $waz .
						"', qsl_s = '" . $qsls .
						"', qsl_r = '" . $qslr .
						"', state = '" . $state .
						"', qsl_via = '" . $manager .
						"', itu = '" . $itu . "'

						WHERE id_cqrlog_main = '" . $qso_id . "'";
				}
				else {

						$update="UPDATE cqrlog_main SET" .
						" qsodate = '" . $qsodate . 
						"', time_on = '" .$time_on .
						"', adif = '" .$adif .
						"', band = '" . $band .
						"', freq = '" . $freq .
						"', callsign = '" . $call . 
						"', rst_r = '". $rst_rcvd .
						"', rst_s = '" . $rst_sent .
						"', remarks = '" . $remarks .
						"', mode = '" . $mode .
						"', name = '" . $name .
						"', qth = '" . $qth .
						"', iota = '" . $iota_nr .
						"', loc = '" . $loc .
						"', waz = '" . $waz .
						"', qsl_s = '" . $qsls .
						"', qsl_r = '" . $qslr .
						"', state = '" . $state .
						"', qsl_via = '" . $manager .
						"', itu = '" . $itu . "'

						WHERE id_cqrlog_main = '" . $qso_id . "'";
		}

		}
    if ($debugmode) {
	echo $update;
    }
     else{
	$dbconnect -> select_db( logid_to_tableid( $log_id ) );
	mysqli_query($dbconnect, $update);
	if (isset($_POST['Delete'])){
	    echo '<p><font color="red"><b><center>QSO DELETED!</center></b></font></p>' . "\n";
	}
	else {
	    echo '<p><font color="red"><b><center>Changes saved!</center></b></font></p>' . "\n";
	}
    }
//    echo " <p class='hl'>last QSOs</p>";
    echo '<center><a href='.$cqrweblog_root.'logold.php?log_id=' . $log_id . '>Back to Log</a></center>' . "\n";

}

?>
