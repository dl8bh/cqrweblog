<?php
// Parse Input

if (isset($_POST['frequency'])){
$freq = htmlentities($_POST["frequency"]);
$freq = str_replace(',', '.', $freq);
$freq = validate_freq($freq);
}

if (isset($_POST['band'])){

if ($_POST['band']!='select'){
$band = (htmlentities($_POST["band"]));
$freq=band_to_freq($band);
}
elseif (!empty($freq)) {
		
$band = freq_to_band($freq);

}}

if (isset($_POST["call"])) {
	$call = strtoupper(htmlentities($_POST["call"]));
	if (preg_match("/(?P<teil1>\w+)\/(?P<teil2>\w+)\/{0,1}(?P<teil3>\w*)/",$call, $treffer)){
		$id_call = $treffer[1];
		if (strlen($id_call)<strlen($treffer[2]))
		{
		$id_call = $treffer[2];
		}
		if (strlen($id_call)<strlen($treffer[3]))
		{
		$id_call = $treffer[3];
		}
	}
	else
	{
	$id_call = $call;
	}
	$adif = call_to_dxcc($call)[0];
	$dxcc_name = call_to_dxcc($call)[1];
	$itu = call_to_dxcc($call)[2];
	$waz = call_to_dxcc($call)[3];
}

if (isset($_POST["time"])) {
	$time = htmlentities($_POST["time"]);
	if (preg_match("/\b(?<hour>\d{2})(?P<minute>\d{2})\b/",$time, $treffer)){
			$time = $treffer[1] . ':' . $treffer[2];
	}
}


if (isset($_POST["mode"])) {
$mode = strtoupper(htmlentities($_POST["mode"]));
}

if (isset($_POST["name"])) {
$name = strtoupper(htmlentities($_POST["name"]));
}

if (!empty($_POST["rst_sent"])) {
	$rst_sent = htmlentities($_POST["rst_sent"]);
} else {
		$rst_sent = $default_cw_rapport;
}
$rst_sent_proc = $rst_sent;

if (!empty($_POST["rst_rcvd"])) {
$rst_rcvd = htmlentities($_POST["rst_rcvd"]);
} else {
		$rst_rcvd = $default_cw_rapport;
}
$rst_rcvd_proc = $rst_rcvd;


if (isset ($mode))
{
if (($mode == "CW")&&($rst_sent == $default_ssb_rapport)) {
		$rst_sent = $default_cw_rapport;
}
elseif (($mode =="SSB")&&($rst_sent == $default_cw_rapport)) {
		$rst_sent = $default_ssb_rapport;
}

if (($mode == "CW")&&($rst_rcvd == $default_ssb_rapport)){
		$rst_rcvd = $default_cw_rapport;
}
elseif (($mode =="SSB")&&($rst_rcvd == $default_cw_rapport)) {
		$rst_rcvd = $default_ssb_rapport;
}
}

if (isset($_POST["remarks"])) {
$remarks = strtoupper(htmlentities($_POST["remarks"]));
}
?>
