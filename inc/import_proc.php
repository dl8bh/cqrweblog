<?php
$adif_parser = new Adif();
$uploaded_file = $_FILES["import_adif_file"]["tmp_name"];
$filestring = file_get_contents($uploaded_file);
$adif_table = $adif_parser->read_adif_file($filestring);
foreach ($adif_table as $qso) {
	$Logbook->insert_qso($qso);
}
