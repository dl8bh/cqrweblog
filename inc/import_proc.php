<?php
$adif_parser = new Adif();
if (!empty($_FILES["import_adif_file"]["tmp_name"])) {
    $ignore_dupes = false;
    if (isset($_POST["import_settings"])) {
        $import_settings = $_POST["import_settings"];
        if (in_array("ignore_dupes", $import_settings)) {
            $ignore_dupes = true;
        }
    }
    $uploaded_file = $_FILES["import_adif_file"]["tmp_name"];
    $filestring = file_get_contents($uploaded_file);
    $adif_table = $adif_parser->read_adif_file($filestring);
    foreach ($adif_table as $qso) {
        if ($ignore_dupes) {
            $Logbook->insert_qso($qso);
        } else {
            if ($Logbook->check_exact_dupe($qso)) {
            } else {
                $Logbook->insert_qso($qso);
            }
        }
    }
}
