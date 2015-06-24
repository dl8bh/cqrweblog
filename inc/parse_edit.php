<?php
// Parse Input

$dbconnect -> select_db( logid_to_tableid( $log_id ) );
$query = mysqli_query($dbconnect, "SELECT * FROM cqrlog_main WHERE id_cqrlog_main = '" . $qso_id . "'");
while($row = mysqli_fetch_object($query))
		{
		$date= $row->qsodate;
		$callsign = $row->callsign;
		$time = $row->time_on;
		$band = $row->band;
		$freq = $row->freq;
		$mode = $row->mode;
		$rst_r = $row->rst_r;	
		$rst_s = $row->rst_s;
		$remarks = $row->remarks;
		$name = $row->name;
		$qth = $row->qth;
		$iota = $row->iota;
		$loc = $row->loc;
		$itu = $row->itu;
		$waz = $row->waz;
		$qsls = $row->qsl_s;
		$qslr = $row->qsl_r;
		$state = $row->state;
		}
if (!isset($callsign)) {
		$date="";
		$callsign="";
		$time="";
		$band="";
		$freq="";
		$mode="";
		$rst_r="";
		$rst_s="";
		$remarks="";
		$name="";
		$qth="";
		$iota="";
		$loc="";
		$itu="";
		$waz="";
		$qsls="";
		$qslr="";
}
if (isset($_POST['frequency_input'])){
$freq = htmlentities($_POST["frequency_input"]);
$freq = str_replace(',', '.', $freq);
$freq = validate_freq($freq);
}

if (isset($_POST['band_input'])){

if ($_POST['band_input']!='select'){
$band = (htmlentities($_POST["band_input"]));
$freq=band_to_freq($band);
}
elseif (!empty($freq)) {
		
$band = freq_to_band($freq);

}}


if (isset($_POST["itu_input"])) {
	$itu=htmlentities($_POST["itu_input"]);
}

if (isset($_POST["waz_input"])) {
	$waz=htmlentities($_POST["waz_input"]);
}

$calledit=false;
if (isset($_POST["call_input"])) { 
$call = strtoupper(htmlentities($_POST["call_input"]));
if (isset($callsign)&&($callsign != $call)) 
{
//echo "editiert";
$calledit=true;
$callsign=$call;
{
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
	$fetchqso = call_to_dxcc($call);
	$adif = $fetchqso[0];
	$dxcc_name = $fetchqso[1];
	$itu = $fetchqso[2];
	$waz = $fetchqso[3];
	$manager = get_manager($call);
	$fetchiota = get_iota($call, adif_to_dxcc($adif));
	$iota_nr = $fetchiota[0];
	$iota_name = $fetchiota[1];
}
}
}
if (isset($_POST["time_input"])) {
	$time = htmlentities($_POST["time_input"]);
	if (preg_match("/\b(?<hour>\d{2})(?P<minute>\d{2})\b/",$time, $treffer)){
			$time = $treffer[1] . ':' . $treffer[2];
	}
}


if (isset($_POST["mode_input"])) {
$mode = strtoupper(htmlentities($_POST["mode_input"]));
}

if (isset($_POST["name_input"])) {
$name = strtoupper(htmlentities($_POST["name_input"]));
}

if (!empty($_POST["rst_sent_input"])) {
	$rst_sent = htmlentities($_POST["rst_sent_input"]);
} else {
		$rst_sent = $default_cw_rapport;
}
$rst_sent_proc = $rst_sent;

if (!empty($_POST["rst_rcvd_input"])) {
$rst_rcvd = htmlentities($_POST["rst_rcvd_input"]);
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

if (isset($_POST["remarks_input"])) {
		$remarks = strtoupper(htmlentities($_POST["remarks_input"]));
		if (preg_match("/(I:\s*)(\S+)/",$remarks, $iota_treffer) ){
				$iota_nr=$iota_treffer[2];
		}

		if (preg_match("/(M:\s*)(\S+)/",$remarks, $manager_treffer) ){
				$manager=$manager_treffer[2];
		}

		if (preg_match("/(L:\s*)(\S+)/",$remarks, $locator_treffer) ){
				$locator=$locator_treffer[2];
		}

}

if (isset($_POST["date_input"])) {
		$qsodate = htmlentities($_POST["date_input"]);
}


if (isset($_POST["waz_input"])) {
		$waz = htmlentities($_POST["waz_input"]);
}


if (isset($_POST["qth_input"])) {
		$qth = htmlentities($_POST["qth_input"]);
}

if (isset($_POST["loc_input"])) {
		$loc = strtoupper(htmlentities($_POST["loc_input"]));
}
if (isset($_POST["iota_input"])) {
		$iota = strtoupper(htmlentities($_POST["iota_input"]));
}

if (isset($_POST['qsls_input'])){
$qsls = (htmlentities($_POST["qsls_input"]));
}
if (isset($_POST['qslr_input'])){
$qslr = (htmlentities($_POST["qslr_input"]));
}
if (isset($_POST['state_input'])){
$state = strtoupper(htmlentities($_POST["state_input"]));
}
?>
