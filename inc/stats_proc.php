<?php

date_default_timezone_set("UTC");
$datum = date("Y-m-d", time());
$time_on = date("H:i", time());

$wheredxcc = "";
if (!empty($dxcc)) {
    $wheredxcc = $dxcc;
}
