<?php

date_default_timezone_set("UTC");
$datum = date("Y-m-d", time());
$time_on = date("H:i", time());

$wheredxcc = ' WHERE deleted="0"';


if (!empty($dxcc)) {
    $wheredxcc .= ' AND pref LIKE "' . $dxcc . '"';
}
