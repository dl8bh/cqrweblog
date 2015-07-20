<?php
// Parse Input
if (isset($_POST["frequency"])){
$freq = htmlentities($_POST["frequency"]);
$freq = mysqli_real_escape_string($dbconnect ,$freq);
}

if (isset($_POST["band"])){
$band=htmlentities($_POST["band"]);
$band = mysqli_real_escape_string($dbconnect , $band);
}

if (isset($_POST["call"])){
$call = strtoupper(htmlentities($_POST["call"]));
$call = mysqli_real_escape_string($dbconnect ,$call);
$id_call = $call;
}

if (isset($_POST["dxcc"])){
$dxcc = strtoupper(htmlentities($_POST["dxcc"]));
$dxcc = mysqli_real_escape_string($dbconnect ,$dxcc);
}

if (isset($_POST["mode"])){
$mode = strtoupper(htmlentities($_POST["mode"]));
$mode = mysqli_real_escape_string($dbconnect ,$mode);
}

if (isset($_POST["name"])){
$name = htmlentities($_POST["name"]);
$name = mysqli_real_escape_string($dbconnect ,$name);
}

if (isset($_POST["remarks"])){
$remarks = htmlentities($_POST["remarks"]);
$remarks = mysqli_real_escape_string($dbconnect ,$remarks);
}

if (isset($_POST["locator"])){
$locator = strtoupper(htmlentities($_POST["locator"]));
$locator = mysqli_real_escape_string($dbconnect ,$locator);
}

$adif_export = false;

if (isset($_POST["adif_export"])){
$adif_export = true;
}
$inlog = false;
if (isset($_POST["inlog"])){
$inlog = true;
}
?>


