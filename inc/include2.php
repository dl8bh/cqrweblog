<?php

function check_adif2 ( $adif, $log_id, $band = 'ALL', $mode = 'ALL' , $paper = true , $lotw = true, $eqsl = true ) {
		
		global $dbconnect;
		$dbconnect -> select_db (logid_to_tableid( $log_id ));

		$adif = mysqli_real_escape_string($dbconnect ,$adif);
		$log_id = mysqli_real_escape_string($dbconnect ,$log_id);
		$band = mysqli_real_escape_string($dbconnect ,$band);
		$mode = mysqli_real_escape_string($dbconnect ,$mode);
		$paper = mysqli_real_escape_string($dbconnect ,$paper);
		$lotw = mysqli_real_escape_string($dbconnect ,$lotw);
		$eqsl = mysqli_real_escape_string($dbconnect ,$eqsl);

		$qslstring = qslstring( $paper, $lotw, $eqsl);
		if ($mode == "RTTY") {
				$mode = "DATA";
		}
		if ($band == "ALL") {
				$bandstring='';
		}
		
		else {
				$bandstring = ' and band="' . $band . '"';
		}

		$dbconnect -> select_db( logid_to_tableid( $log_id ) );
		switch ($mode) {
				case 'ALL' :
						$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . $qslstring  . ' limit 1');
				break;
				case 'DATA' :
						$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode!="SSB" and mode !="CW" and mode !="FM"'  . $qslstring  . ' limit 1');
				break;
				default :
						$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode="' . $mode . '"'  . $qslstring  . ' limit 1');
		}
		
		while($row = mysqli_fetch_object($ergebnis)) {
				return array ("C", '<td align="center" bgcolor="#40FF00">',  '</td>');
	}
	
	switch ($mode) {
			case 'ALL' :
					$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' limit 1');
					break;	
			case 'DATA' :
					$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and  mode!="SSB" and mode !="CW" and mode !="FM" limit 1');
					break;
	default:
			$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode="' . $mode . '" limit 1');
	}
	while($row = mysqli_fetch_object($ergebnis2)) {
			return array ('W', '<td align="center" bgcolor="Red">','</td>');
	}

	return array ( 'N', '<td>', '</td>' );
}

?> 
