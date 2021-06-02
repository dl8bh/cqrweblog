<?php
// Parse Input
$prefix = "";
if (isset($_POST["prefix"])) {
    $prefix = strtoupper(htmlentities($_POST["prefix"]));
    $dxcc = $Cqrlog_common->dxcc_to_adif($prefix);
}

if (isset($_POST["band"])) {
    $band = htmlentities($_POST["band"]);
}

if (isset($_POST["mode"])) {
    $mode = $_POST["mode"];
}

if (!isset($mode)) {
    $mode = array();
}

if (isset($_POST["callsign"])) {
    $call = strtoupper(htmlentities($_POST["callsign"]));
    if (!empty($call)) {
        $dxcc = $Checkdxcc->call_to_dxcc($call)["adif"];
        $prefix = $Cqrlog_common->adif_to_dxcc($dxcc);
        $mode = array("CW", "SSB", "DATA");
    }
}

if (isset($_POST["name"])) {
    $name = htmlentities($_POST["name"]);
}

$paperqsl = false;
$lotwqsl = false;
$eqslqsl = false;

if (isset($_POST["confirmation_paper"])) {
    $paperqsl = true;
}

if (isset($_POST["confirmation_lotw"])) {
    $lotwqsl = true;
}

if (isset($_POST["confirmation_eqsl"])) {
    $eqslqsl = true;
}

if (!($paperqsl) && !($lotwqsl) && !$eqslqsl) {
    $paperqsl = true;
    $lotwqsl    = true;
    $eqslqsl    = true;
}


if (isset($_POST["locator"])) {
    $locator = strtoupper(htmlentities($_POST["locator"]));
}
$inlog = false;
if (isset($_POST["inlog"])) {
    $inlog = true;
}
