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
        $updatearray = array();
				if (!isset($adif)) {
						$updatearray["qsodate"] =  $qsodate; 
						$updatearray["time_on"] = $time_on;
						$updatearray["band"] =  $band;
						$updatearray["freq"] =  $freq;
						$updatearray["callsign"] =  $call; 
						$updatearray["rst_r"] = $rst_rcvd;
						$updatearray["rst_s"] =  $rst_sent;
						$updatearray["remarks"] =  $remarks;
						$updatearray["mode"] =  $mode;
						$updatearray["name"] =  $name;
						$updatearray["qth"] =  $qth;
						$updatearray["iota"] =  $iota_nr;
						$updatearray["loc"] =  $loc;
						$updatearray["waz"] =  $waz;
						$updatearray["qsl_s"] =  $qsls;
						$updatearray["qsls_date"] =  $qsls_date;
						$updatearray["qsl_r"] =  $qslr;
						$updatearray["qslr_date"] =  $qslr_date;
						$updatearray["state"] =  $state;
						$updatearray["qsl_via"] =  $manager;
						$updatearray["itu"] =  $itu;
				}
				else {
						$updatearray["qsodate"] = $qsodate; 
						$updatearray["time_on"] =$time_on;
						$updatearray["adif"] =$adif;
						$updatearray["band"] = $band;
						$updatearray["freq"] = $freq;
						$updatearray["callsign"] = $call; 
						$updatearray["rst_r"] =$rst_rcvd;
						$updatearray["rst_s"] = $rst_sent;
						$updatearray["remarks"] = $remarks;
						$updatearray["mode"] = $mode;
						$updatearray["name"] = $name;
						$updatearray["qth"] = $qth;
						$updatearray["iota"] = $iota_nr;
						$updatearray["loc"] = $loc;
						$updatearray["waz"] = $waz;
						$updatearray["qsl_s"] = $qsls;
						$updatearray["qsls_date"] = $qsls_date;
						$updatearray["qsl_r"] = $qslr;
						$updatearray["qslr_date"] = $qslr_date;
						$updatearray["state"] = $state;
						$updatearray["qsl_via"] = $manager;
						$updatearray["itu"] = $itu;
		}

		}
    if ($debugmode) {
	echo $update;
    }
     else{
         $Logbook->edit_qso($qso_id, $updatearray);
	#$dbconnect -> select_db( logid_to_tableid( $log_id ) );
	#mysqli_query($dbconnect, $update);
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
