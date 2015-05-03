<?php
include("db.php");
?>

<?php



function call_to_dxcc2 ( $callsign ) {
		global $dbconnect;
		$dbconnect -> select_db("cqrlog_web");
		$callsign = mysqli_real_escape_string($dbconnect ,$callsign);
		$firstletter = substr($callsign, 0,1);
		$ergebnis = mysqli_query($dbconnect, 'SELECT * FROM singledat WHERE firstletter="' . $firstletter . '" AND  "' . $callsign . '" RLIKE dxcc_ref');	
		while($row = mysqli_fetch_object($ergebnis)) {
			$dxcc_name = $row->dxcc_name;
			$dxcc_itu = $row->dxcc_itu;
			$dxcc_waz = $row->dxcc_waz;
			$dxcc_adif = $row->dxcc_altadi;
			if (empty($dxcc_adif)) {
					$dxcc_adif= $row->dxcc_adif;	
					}
				return array ( $dxcc_adif, $dxcc_name, $dxcc_itu, $dxcc_waz );
	}
		if (empty($dxcc_adif)){
		$ergebnis = mysqli_query($dbconnect, 'SELECT * FROM countrydat WHERE firstletter="' . $firstletter . '" AND  "' . $callsign . '" RLIKE dxcc_ref');	
		while($row = mysqli_fetch_object($ergebnis)) {
			$dxcc_name = $row->dxcc_name;
			$dxcc_itu = $row->dxcc_itu;
			$dxcc_waz = $row->dxcc_waz;
			$dxcc_adif = $row->dxcc_altadi;
			if (empty($dxcc_adif)) {
					$dxcc_adif= $row->dxcc_adif;	
					}
	}
		}
		if (empty($dxcc_adif)){
		$ergebnis = mysqli_query($dbconnect, 'SELECT * FROM countrydat WHERE firstletter="[" AND  "' . $callsign . '" RLIKE dxcc_ref');	
		while($row = mysqli_fetch_object($ergebnis)) {
			$dxcc_name = $row->dxcc_name;
			$dxcc_itu = $row->dxcc_itu;
			$dxcc_waz = $row->dxcc_waz;
			$dxcc_adif = $row->dxcc_altadi;
			if (empty($dxcc_adif)) {
					$dxcc_adif= $row->dxcc_adif;	
					}
	}
		}
		if (empty($dxcc_adif)){
		$ergebnis = mysqli_query($dbconnect, 'SELECT * FROM countrydat WHERE "' . $callsign . '" RLIKE dxcc_ref');	
		while($row = mysqli_fetch_object($ergebnis)) {
			$dxcc_name = $row->dxcc_name;
			$dxcc_itu = $row->dxcc_itu;
			$dxcc_waz = $row->dxcc_waz;
			$dxcc_adif = $row->dxcc_altadi;
			if (empty($dxcc_adif)) {
					$dxcc_adif= $row->dxcc_adif;	
					}
	}
		}
		if (empty($dxcc_adif)){
				$dxcc_adif= NULL;
				$dxcc_name = "No matching DXCC found in database";
				$dxcc_itu= NULL;
				$dxcc_waz=NULL;
				}
		return array ( $dxcc_adif, $dxcc_name, $dxcc_itu, $dxcc_waz );
}

/* Maybe useful for other purposes, version with mysql-select is better approach
function freq_to_band2 ( $inputfreq )
{
  global $dbconnect;
	$dbconnect -> select_db("cqrlog_common");
	$ergebnis = mysqli_query($dbconnect, "SELECT distinct band, b_begin, b_end FROM bands");
	while($row = mysqli_fetch_object($ergebnis))
	{
	$band = $row->band;
	$begin = $row->b_begin;
	$end = $row->b_end;
	if ($inputfreq <= $end ) {
	
		if ($inputfreq >= $begin)
		{
	return $band;
		}
	}
	
	}
	return NULL;
}
*/
