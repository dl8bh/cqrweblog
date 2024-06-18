<?php
include("adif.php");
$adif_helper = new Adif();
$filename = strtoupper($Cqrlog_common->logid_to_call($log_id)) . '.adi';
$filename = str_replace("/", "-", $filename);
$filepath = $exportdir . $filename;
$file = fopen($filepath, "w+");
$dbconnect->select_db(logid_to_tableid($log_id));
$qsotable = $Logbook->get_log(0, $where);
$qsotable = array_reverse($qsotable);
$filestring = $adif_helper->qsotable_to_adif_string($qsotable);
fwrite($file, $filestring);
fflush($file);

fclose($file);
echo '<h3><a href="' . $filepath . '">Download ADI</a></h3>';
