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

function qslstring($paper, $lotw, $eqsl)
{


    $qslstring = "";

    if (($paper) && ($lotw) && ($eqsl)) {
        $qslstring = ' and ( (qsl_r !="" ) OR (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
    } elseif (($paper) && ($lotw)) {
        $qslstring = ' and ( (qsl_r !="" ) OR (lotw_qslrdate IS NOT NULL) )';
    } elseif (($paper) && ($eqsl)) {
        $qslstring = ' and ( (qsl_r !="" ) OR (eqsl_qslrdate IS NOT NULL) )';
    } elseif (($lotw) && ($eqsl)) {
        $qslstring = ' and ( (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
    } elseif ($lotw) {
        $qslstring = ' and lotw_qslrdate IS NOT NULL ';
    } elseif ($eqsl) {
        $qslstring = ' and eqsl_qslrdate IS NOT NULL ';
    } elseif ($paper) {
        $qslstring = ' and qsl_r !="" ';
    }

    return $qslstring;
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

function check_adif($adif, $log_id, $band = 'ALL', $mode = 'ALL', $paper = true, $lotw = true, $eqsl = true)
{

    global $dbconnect;
    $dbconnect->select_db(logid_to_tableid($log_id));

    $adif = mysqli_real_escape_string($dbconnect, $adif);
    $log_id = mysqli_real_escape_string($dbconnect, $log_id);
    $band = mysqli_real_escape_string($dbconnect, $band);
    $mode = mysqli_real_escape_string($dbconnect, $mode);
    $paper = mysqli_real_escape_string($dbconnect, $paper);
    $lotw = mysqli_real_escape_string($dbconnect, $lotw);
    $eqsl = mysqli_real_escape_string($dbconnect, $eqsl);

    $qslstring = qslstring($paper, $lotw, $eqsl);
    if ($mode == "RTTY") {
        $mode = "DATA";
    }
    if ($band == "ALL") {
        $bandstring = '';
    } else {
        $bandstring = ' and band="' . $band . '"';
    }

    $dbconnect->select_db(logid_to_tableid($log_id));
    switch ($mode) {
        case 'ALL':
            $ergebnis = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . $qslstring  . ' limit 1');
            break;
        case 'DATA':
            $ergebnis = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode!="SSB" and mode !="CW" and mode !="FM"'  . $qslstring  . ' limit 1');
            break;
        default:
            $ergebnis = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode="' . $mode . '"'  . $qslstring  . ' limit 1');
    }

    while ($row = mysqli_fetch_object($ergebnis)) {
        return array("C", '<td align="center" class="success">',  '</td>');
    }

    switch ($mode) {
        case 'ALL':
            $ergebnis2 = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' limit 1');
            break;
        case 'DATA':
            $ergebnis2 = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and  mode!="SSB" and mode !="CW" and mode !="FM" limit 1');
            break;
        default:
            $ergebnis2 = mysqli_query($dbconnect,    'select callsign from cqrlog_main where adif=' . $adif . $bandstring . ' and mode="' . $mode . '" limit 1');
    }
    while ($row = mysqli_fetch_object($ergebnis2)) {
        return array('W', '<td class="danger" align="center" >', '</td>');
    }

    return array('N', '<td align="center">', '</td>');
}

function count_dxcc($log_id, $band, $mode, $paper, $lotw, $eqsl)
{

    global $dbconnect;
    $dbconnect->select_db(logid_to_tableid($log_id));

    $log_id = mysqli_real_escape_string($dbconnect, $log_id);
    $band = mysqli_real_escape_string($dbconnect, $band);
    $mode = mysqli_real_escape_string($dbconnect, $mode);
    $paper = mysqli_real_escape_string($dbconnect, $paper);
    $lotw = mysqli_real_escape_string($dbconnect, $lotw);
    $eqsl = mysqli_real_escape_string($dbconnect, $eqsl);

    $qslstring = qslstring($paper, $lotw, $eqsl);
    $querystring = 'select count(distinct adif) from cqrlog_main where adif<>0 ';

    if ($band != "ALL") {
        $querystring .= 'and band="' . $band . '" ';
    }

    if ($mode == "DATA") {
        $querystring .= 'and mode!="SSB" and mode!="CW" and mode!="FM" ';
    } else if ($mode != "ALL") {
        $querystring .= 'and mode="' . $mode . '" ';
    }

    $querystring .= $qslstring;

    $ergebnis = mysqli_query($dbconnect, $querystring);
    $result = $ergebnis->fetch_row();
    return $result[0];
}


?> 
