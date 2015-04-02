<?php
include("db.php");
?>

<?php

function logid_to_tableid ( $log_id )
{
	$log_id = sprintf("%03d", $log_id);	
	return 'cqrlog' . $log_id;
}


function call_to_dxcc ( $callsign ) {
		global $dbconnect;
		$dbconnect -> select_db("cqrlog_web");
		$callsign = mysqli_real_escape_string($dbconnect ,$callsign);
		$firstletter = substr($callsign, 0,1);
//		echo $firstletter;
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
				$dxcc_adif= NULL;
				$dxcc_name = "No matching DXCC found in database";
				$dxcc_itu= NULL;
				$dxcc_waz=NULL;
				}
		return array ( $dxcc_adif, $dxcc_name, $dxcc_itu, $dxcc_waz );
}

function count_qsos ( $log_id ) {
	global $where;
	global $dbconnect;
	$log_id = mysqli_real_escape_string($dbconnect ,$log_id);
	if (logid_to_call( $log_id)) {
	$dbconnect -> select_db( logid_to_tableid( $log_id ) );
	$ergebnis = mysqli_query($dbconnect, "SELECT COUNT(*) FROM view_cqrlog_main_by_qsodate " . $where );
	$result=$ergebnis->fetch_row();
		return $result[0];
	}
	else return NULL;

}

function logid_to_call ( $log_id ) {
		global $dbconnect;		
		$dbconnect -> select_db("cqrlog_common" );
		$log_id = mysqli_real_escape_string($dbconnect ,$log_id);
		$ergebnis = mysqli_query($dbconnect, "SELECT log_name FROM log_list WHERE log_nr=" . $log_id);
		while($row = mysqli_fetch_object($ergebnis))
		{
				return $row->log_name;
		}
				return NULL;
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
function freq_to_band ( $inputfreq )
{
		global $dbconnect;
		$dbconnect -> select_db("cqrlog_common");
		$inputfreq = mysqli_real_escape_string($dbconnect ,$inputfreq);
		$ergebnis = mysqli_query($dbconnect, "select band from bands where b_begin <= " . $inputfreq . " and b_end >=" . $inputfreq  );
		while($row = mysqli_fetch_object($ergebnis))
			{
					return $row->band;
			}
		return NULL ;
}



function band_to_freq ( $inputband )
{
		global $dbconnect;
		$dbconnect -> select_db("cqrlog_common");
		$inputband = mysqli_real_escape_string($dbconnect ,$inputband);
		$ergebnis = mysqli_query($dbconnect, "select b_begin from bands where band = '" . $inputband ."'"  );
		while($row = mysqli_fetch_object($ergebnis))
			{
					return $row->b_begin;
			}
			return NULL;
}

function validate_freq ( $freq )
{
		switch ($freq) {
			//check for lazy WARC band frequency input
			case '10' :
				return band_to_freq( '30M' );
				break;
			case '18' :
				return band_to_freq( '17M' );
				break;
			case '24' :
				return band_to_freq( '12M' );
			default:
			//Check if frequency input was in kHz, if true, convert to MHz
			if (!freq_to_band($freq))
				{
						//kHz/1000 = MHz
						$newfreq=$freq/1000;
						if (freq_to_band( $newfreq ))
						{
								return $newfreq;
						}
				}
				
				return $freq;
				break;
		}
}

function dxcc_to_adif ( $dxcc )
{

		global $dbconnect;
		$dbconnect -> select_db("cqrlog_common");
	  $dxcc = mysqli_real_escape_string($dbconnect ,$dxcc);
		$ergebnis = mysqli_query($dbconnect, "select adif from dxcc_ref where pref = '" . $pref ."'"  );
		while($row = mysqli_fetch_object($ergebnis))
			{
					return $row->adif;
			}
			return NULL;


}

function adif_to_dxcc ( $adif )
{

		global $dbconnect;
		$dbconnect -> select_db("cqrlog_common");
		$adif = mysqli_real_escape_string($dbconnect , $adif);
		$ergebnis = mysqli_query($dbconnect, "select pref from dxcc_ref where adif = '" . $adif ."'"  );
		while($row = mysqli_fetch_object($ergebnis))
			{
					return $row->pref;
			}
			return NULL;


}

function check_adif ( $adif, $log_id, $band, $mode, $paper, $lotw, $eqsl )
{
	global $dbconnect;
	$dbconnect -> select_db (logid_to_tableid( $log_id ));
	$adif = mysqli_real_escape_string($dbconnect ,$adif);
	$log_id = mysqli_real_escape_string($dbconnect ,$log_id);
	$band = mysqli_real_escape_string($dbconnect ,$band);
	$mode = mysqli_real_escape_string($dbconnect ,$mode);
	$paper = mysqli_real_escape_string($dbconnect ,$paper);
	$lotw = mysqli_real_escape_string($dbconnect ,$lotw);
	$eqsl = mysqli_real_escape_string($dbconnect ,$eqsl);
	
	if (($paper) && ($lotw) && ($eqsl))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif (($paper) && ($lotw))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (lotw_qslrdate IS NOT NULL) )';
	}
	elseif (($paper) && ($eqsl))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif (($lotw) && ($eqsl))
	{
			$qslstring=' and ( (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif ($paper)
	{
			$qslstring=' and qslr_date IS NOT NULL ';
	}
	elseif ($lotw)
	{
			$qslstring=' and lotw_qslrdate IS NOT NULL ';
	}
	elseif ($eqsl)
	{
			$qslstring=' and eqsl_qslrdate IS NOT NULL ';
	}

	$dbconnect -> select_db( logid_to_tableid( $log_id ) );
	if ($mode=="ALL"){
		$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '"' . $qslstring  . ' limit 1');
	}
	else
	{
		$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" and mode="' . $mode . '"'  . $qslstring  . ' limit 1');
	}
	while($row = mysqli_fetch_object($ergebnis)){
			return '<td align="center" bgcolor="#40FF00"><font color=black >C</font></td>';
	}

	
	if ($mode=="ALL"){
	$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" limit 1');
	}
	else
	{
	$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" and mode="' . $mode . '" limit 1');
	}
	while($row = mysqli_fetch_object($ergebnis2)){
			return '<td align="center" bgcolor="Red"><font color=black >W</font></td>';
	}
			return "<td></td>";
}

function count_dxcc ( $log_id, $band, $mode, $paper, $lotw, $eqsl )
{

	global $dbconnect;
	$dbconnect -> select_db (logid_to_tableid( $log_id ));
	$log_id = mysqli_real_escape_string($dbconnect ,$log_id);
	$band = mysqli_real_escape_string($dbconnect ,$band);
	$mode = mysqli_real_escape_string($dbconnect ,$mode);
	$paper = mysqli_real_escape_string($dbconnect ,$paper);
	$lotw = mysqli_real_escape_string($dbconnect ,$lotw);
	$eqsl = mysqli_real_escape_string($dbconnect ,$eqsl);
	
	if (!($paper) && !($lotw) && !($eqsl))
	{
			$qslstring=' ';
	}
	if (($paper) && ($lotw) && ($eqsl))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif (($paper) && ($lotw))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (lotw_qslrdate IS NOT NULL) )';
	}
	elseif (($paper) && ($eqsl))
	{
			$qslstring=' and ( (qslr_date IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif (($lotw) && ($eqsl))
	{
			$qslstring=' and ( (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
	}
	elseif ($paper)
	{
			$qslstring=' and qslr_date IS NOT NULL ';
	}
	elseif ($lotw)
	{
			$qslstring=' and lotw_qslrdate IS NOT NULL ';
	}
	elseif ($eqsl)
	{
			$qslstring=' and eqsl_qslrdate IS NOT NULL ';
	}
	
	$querystring = 'select count(distinct adif) from cqrlog_main where adif<>0 ' ;
	if ($band != "ALL")
	{
			$querystring .= 'and band="' . $band .'" ';
	}
	if ($mode != "ALL")
	{
			$querystring .= 'and mode="' . $mode .'" ';
	}
	
	$querystring .= $qslstring;

	$ergebnis = mysqli_query($dbconnect, $querystring );
	$result=$ergebnis->fetch_row();
		return $result[0];
}
?> 
