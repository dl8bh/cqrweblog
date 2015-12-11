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
?>

		
<div class="alert alert-info">
  <strong>Edit</strong> QSO details or check DELETE to delete qso. Click SAVE when ready.
</div>
<?php
 }
 elseif (empty($freq)){
?>


<div class="alert alert-danger">
  <strong>Please</strong> insert frequency or choose band!
</div>
<?php 
	
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
						"', qsls_date = '" . $qsls_date .
						"', qsl_r = '" . $qslr .
						"', qslr_date = '" . $qslr_date .
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
						"', qsls_date = '" . $qsls_date .
						"', qsl_r = '" . $qslr .
						"', qslr_date = '" . $qslr_date .
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
			?>
						<div class="alert alert-warning">
							<strong>SUCCESS </strong> QSO has been deleted, you may close this window now!
						</div>
			<?php
	}
	else {
?>
<div class="alert alert-success">
  <strong>Success!</strong> Changes saved! You may close this window now or re-edit!
</div>	   

<?php	
}
    }
//back
}

?>
