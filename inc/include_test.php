<?php
function check_adif2 ( $adif, $log_id, $band, $mode, $paper, $lotw, $eqsl )
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

	$qslstring = qslstring( $paper, $lotw, $eqsl);

	$dbconnect -> select_db( logid_to_tableid( $log_id ) );
	if ($mode=="ALL"){
		$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '"' . $qslstring  . ' limit 1');
	}
	else
	{
		$ergebnis = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" and mode="' . $mode . '"'  . $qslstring  . ' limit 1');
	}
	while($row = mysqli_fetch_object($ergebnis)){
			return array ("C", '<td align="center" bgcolor="#40FF00">',  '</td>');// '<td align="center" bgcolor="#40FF00"><font color=black >C</font></td>';
	}

	
	if ($mode=="ALL"){
	$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" limit 1');
	}
	else
	{
	$ergebnis2 = mysqli_query($dbconnect,	'select callsign from cqrlog_main where adif=' . $adif . ' and band="' . $band . '" and mode="' . $mode . '" limit 1');
	}
	while($row = mysqli_fetch_object($ergebnis2)){
			return array ('W', '<td align="center" bgcolor="Red">','</td>');// '<td align="center" bgcolor="Red"><font color=black >W</font></td>';
	}
			return array ( 'N', '<td>', '</td>' );
}
?>
