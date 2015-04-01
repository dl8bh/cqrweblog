<?php
// Parse Input
if (isset($_POST["frequency"])){
$freq = htmlentities($_POST["frequency"]);
}

if (isset($_POST["band"])){
$band=htmlentities($_POST["band"]);
}

if (isset($_POST["call"])){
$call = strtoupper(htmlentities($_POST["call"]));
$id_call = $call;
}

if (isset($_POST["dxcc"])){
$dxcc = strtoupper(htmlentities($_POST["dxcc"]));
}

if (isset($_POST["mode"])){
$mode = strtoupper(htmlentities($_POST["mode"]));
}

if (isset($_POST["name"])){
$name = htmlentities($_POST["name"]);
}

if (isset($_POST["remarks"])){
$remarks = htmlentities($_POST["remarks"]);
}

if (isset($_POST["locator"])){
$locator = strtoupper(htmlentities($_POST["locator"]));
}
?>


