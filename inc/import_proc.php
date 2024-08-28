<?php
$adif_parser = new Adif();
$testfile = $_FILES["upload_file"]["tmp_name"];
$filestring = file_get_contents($testfile);
$adif_table = $adif_parser->read_adif_file($filestring);
foreach ($adif_table as $qso) {
	$Logbook->insert_qso($qso);
}
