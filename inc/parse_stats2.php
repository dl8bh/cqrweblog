<?php
// Parse Input
if (isset($_POST["dxcc"])){
$dxcc = strtoupper(htmlentities($_POST["dxcc"]));
}

if (isset($_POST["band"])){
$band=htmlentities($_POST["band"]);
}

if (isset($_POST["mode"])){
$mode = $_POST["mode"];
}

if (!isset($mode)){
$mode =array();
}

if (isset($_POST["callsign"])){
$call = strtoupper(htmlentities($_POST["callsign"]));
if (!empty($call)) {
		$dxcc = adif_to_dxcc(call_to_dxcc($call)[0]);
		$mode = array("CW","SSB");
}
}

if (isset($_POST["name"])){
$name = htmlentities($_POST["name"]);
}

$paperqsl = false;
$lotwqsl = false;
$eqslqsl = false;

if (isset($_POST["confirmation_paper"])){
$paperqsl = true;
}

if (isset($_POST["confirmation_lotw"])){
$lotwqsl = true;
}

if (isset($_POST["confirmation_eqsl"])){
$eqslqsl = true;
}

if (!($paperqsl) && !($lotwqsl) && !$eqslqsl)
{
		$paperqsl = true;
		$lotwqsl	= true;
		$eqslqsl	= true;
}


if (isset($_POST["locator"])){
$locator = strtoupper(htmlentities($_POST["locator"]));
}
?>


