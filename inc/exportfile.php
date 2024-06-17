<?php
include("adif.php");
$adif = new Adif();
$filename = strtoupper($Cqrlog_common->logid_to_call($log_id)) . '.adi';
$filename = str_replace("/", "-", $filename);
$filepath = $exportdir . $filename;
$file = fopen($filepath, "w+");
$fileheader =  '<ADIF_VER:5>2.2.1' . "\n";
$fileheader .= 'ADIF export from cqrweblog' . "\n\n";
$fileheader .= 'Internet: http://www.dl8bh.de/cqrweblog/' . "\n\n";
$fileheader .= '<PROGRAMID:9>CQRWEBLOG' . "\n";
$fileheader .= '<PROGRAMVERSION:3>0.9' . "\n";
$fileheader .= '<EOH>' . "\n";
fwrite($file, $fileheader);
$dbconnect->select_db(logid_to_tableid($log_id));
$qsotable = $Logbook->get_log(0, $where);
$qsotable = array_reverse($qsotable);
foreach ($qsotable as $qso) {
    $fileinput = $adif->return_adif($qso) . "\n";
    fwrite($file, $fileinput);
    fflush($file);
}
// mysqli_free_result($query);

fclose($file);
echo '<h3><a href="' . $filepath . '">Download ADI</a></h3>';
