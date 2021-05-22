<?php
date_default_timezone_set("UTC");
$datum = date("Y-m-d", time());
$time_on = date("H:i", time());
if (!empty($time)) {
    $time_on = $time;
}
echo '<div class="row"><div class="col-sm-9">' . "\n";
if (!empty($call)) {
    $infostring = $dxcc_name;
    if (!empty($manager)) {
        $infostring .= ', QSL via ' . $manager;
    }
    if (!empty($iota_nr)) {
        $infostring .= ', ' . $iota_name . ' with IOTA reference ' . $iota_nr;
    }
    if (!empty($locator)) {
        $infostring .= ', at locator ' . $locator;
    }
    if (!empty($state)) {
        $infostring .= ', in US-State ' . $state;
    }
    echo '<div class=" clearfix alert alert-success ">' . "\n" .
        '<strong>Info: </strong>' . $infostring . "\n" .
        '</div>';
}
echo '</div>' . "\n";
if (empty($call)) {
} elseif (empty($band)) {
} else {

    $qso_array = array(
        "qsodate" => $datum,
        "time_on" => $time_on,
        "time_off" => $time_on,
        "callsign" => $call,
        "freq" => $freq,
        "mode" => $mode,
        "rst_s" => $rst_sent,
        "rst_r" => $rst_rcvd,
        "name" => $name,
        "remarks" => $remarks,
        "idcall" => $id_call,
        "band" => $band,
        "adif" => $adif,
        "itu" => $itu,
        "waz" => $waz,
        "qsl_via" => $manager,
        "iota" => $iota_nr,
        "loc" => $locator,
        "state" => $state
    );


    $qso = new Qso($qso_array);

    if ($debugmode) {
        echo $insert;
    } else {
        $Logbook->insert_qso($qso);
    }
}
