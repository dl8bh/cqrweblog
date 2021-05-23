<?php
include("db.php");
?>

<?php

function logid_to_tableid($log_id)
{
    $log_id = sprintf("%03d", $log_id);
    return 'cqrlog' . $log_id;
}

function parse_remarks($remarks, $field)
{
}

function get_cluster_spots($number, $band)
{
    global $apitimeout;
    global $clusterurl;
    $ctx = stream_context_create(array('http' => array('timeout' => $apitimeout,)));

    if ($number != 0) {
        $clusterurl .= 'limit=' . $number;
    } else {
        $clusterurl .= 'limit=10';
    }
    if ($band != 'ALL') {
        $clusterurl .= '&band=' . $band;
    }
    $csvData = @file_get_contents($clusterurl, false, $ctx);
    $csvData = htmlentities($csvData);
    $csvData = str_replace('\^', '\ ^', $csvData);
    $csvData = str_replace('^', '"^"', $csvData);
    $csvData = preg_replace('/^/', '"', $csvData);
    $csvData = str_replace("\n", '"' .  "\n" . '"', $csvData);
    $csvData = str_replace("^", ",", $csvData);
    $arrayData = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $csvData));
    $devnull = array_pop($arrayData);

    if (!empty($arrayData)) {
        return $arrayData;
    } else {
        echo "Cluster timed out";
        $hamqthtimeout = true;
        return $arrayData;
    }
}

function call_to_dxcc($callsign)
{
    global $hamqthurl;
    global $hamqth_api;
    global $hamqthtimeout;
    if (empty($callsign)) {
        return array(NULL, NULL, NULL, NULL);
    }
    // fallback to old call_to_dxcc withouth hamqth
    if (!$hamqth_api || $hamqthtimeout) {
        include("oldinclude.php");
        return call_to_dxcc2($callsign);
    }
    $ctx = stream_context_create(array('http' => array('timeout' => 12,)));
    $jsonurl= 'https://api.dl8bh.de/lookup/json/' . $callsign;
    $jsonData = @file_get_contents($jsonurl, false, $ctx);
    $jsonData = str_replace('".', '",', $jsonData);
    $data = json_decode($jsonData, true);
    $dxcc_adif = $data['adif'];
    $dxcc_name = $data['details'];
    $dxcc_itu = $data['itu'];
    $dxcc_waz = $data['waz'];
    // if timeout => fallback to old call_to_dxcc
    if (empty($dxcc_waz)) {
        //$hamqthtimeout=true;
        include("oldinclude.php");
        return call_to_dxcc2($callsign);
    }

    return array($dxcc_adif, $dxcc_name, $dxcc_itu, $dxcc_waz);
}


function check_dupe($log_id, $callsign, $band = 'ALL', $mode = 'ALL')
{
    global $dbconnect;
    $dbconnect->select_db(logid_to_tableid($log_id));

    $log_id = mysqli_real_escape_string($dbconnect, $log_id);
    $band = mysqli_real_escape_string($dbconnect, $band);
    $mode = mysqli_real_escape_string($dbconnect, $mode);
    $callsign = mysqli_real_escape_string($dbconnect, $callsign);



    $ergebnis = mysqli_query($dbconnect,    'select callsign from cqrlog_main where callsign="' . $callsign . '" and mode="' . $mode . '" and band="' . $band    . '" limit 1');

    while ($row = mysqli_fetch_object($ergebnis)) {
        return true;
    }
    return false;
}


?> 
