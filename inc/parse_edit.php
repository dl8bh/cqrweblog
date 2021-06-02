<?php
// Parse Input

$qso = $Logbook->get_qso($qso_id);

    $date = $qso->get_qsodate();
    $callsign = $qso->get_callsign();
    $time = $qso->get_time_on();
    $band = $qso->get_band();
    $freq = $qso->get_freq();
    $mode = $qso->get_mode();
    $rst_r = $qso->get_rst_r();
    $rst_s = $qso->get_rst_s();
    $remarks = $qso->get_remarks();
    $name = $qso->get_name();
    $qth = $qso->get_qth();
    $iota_nr = $qso->get_iota();
    $loc = $qso->get_loc();
    $itu = $qso->get_itu();
    $waz = $qso->get_waz();
    $qsls = $qso->get_qsl_s();
    $qsls_date = $qso->get_qsls_date();
    $qslr = $qso->get_qsl_r();
    $qslr_date = $qso->get_qslr_date();
    $state = $qso->get_state();
    $manager = $qso->get_qsl_via();

if (!isset($callsign)) {
    $date = "";
    $callsign = "";
    $time = "";
    $band = "";
    $freq = "";
    $mode = "";
    $rst_r = "";
    $rst_s = "";
    $remarks = "";
    $name = "";
    $qth = "";
    $iota_nr = "";
    $loc = "";
    $itu = "";
    $waz = "";
    $qsls = "";
    $qslr = "";
}
if (isset($_POST['frequency_input'])) {
    $freq = htmlentities($_POST["frequency_input"]);
    $freq = str_replace(',', '.', $freq);
    $freq = $Cqrlog_common->validate_freq($freq);
}

if (isset($_POST['band_input'])) {

    if ($_POST['band_input'] != 'select') {
        $band = (htmlentities($_POST["band_input"]));
        $freq = $Cqrlog_common->band_to_freq($band);
    } elseif (!empty($freq)) {

        $band = $Cqrlog_common->freq_to_band($freq);
    }
}

if (isset($_POST["iota_input"])) {
    $iota_nr = strtoupper(htmlentities($_POST["iota_input"]));
}

if (isset($_POST["manager_input"])) {
    $manager = strtoupper(htmlentities($_POST["manager_input"]));
}

if (isset($_POST["itu_input"])) {
    $itu = htmlentities($_POST["itu_input"]);
}

if (isset($_POST["waz_input"])) {
    $waz = htmlentities($_POST["waz_input"]);
}

$calledit = false;
if (isset($_POST["call_input"])) {
    $call = strtoupper(htmlentities($_POST["call_input"]));
    if (isset($callsign) && ($callsign != $call)) {
        //echo "editiert";
        $calledit = true;
        $callsign = $call; {
            if (preg_match("/(?P<teil1>\w+)\/(?P<teil2>\w+)\/{0,1}(?P<teil3>\w*)/", $call, $treffer)) {
                $id_call = $treffer[1];
                if (strlen($id_call) < strlen($treffer[2])) {
                    $id_call = $treffer[2];
                }
                if (strlen($id_call) < strlen($treffer[3])) {
                    $id_call = $treffer[3];
                }
            } else {
                $id_call = $call;
            }
            $fetchqso = $Checkdxcc->call_to_dxcc($call);
            $adif = $fetchqso["adif"];
            $dxcc_name = $fetchqso["details"];
            $itu = $fetchqso["itu"];
            $waz = $fetchqso["waz"];
            $manager = $Cqrlog_common->get_manager($call);
            $fetchiota = $Cqrlog_common->get_iota($call, $Cqrlog_common->adif_to_dxcc($adif));
            if (!empty($fetchiota[0])) {
                $iota_nr = $fetchiota[0];
            }
            $iota_name = $fetchiota[1];
        }
    }
}
if (isset($_POST["time_input"])) {
    $time = htmlentities($_POST["time_input"]);
    if (preg_match("/\b(?<hour>\d{2})(?P<minute>\d{2})\b/", $time, $treffer)) {
        $time = $treffer[1] . ':' . $treffer[2];
    }
}


if (isset($_POST["mode_input"])) {
    $mode = strtoupper(htmlentities($_POST["mode_input"]));
}

if (isset($_POST["name_input"])) {
    $name = strtoupper(htmlentities($_POST["name_input"]));
}

if (!empty($_POST["rst_sent_input"])) {
    $rst_sent = htmlentities($_POST["rst_sent_input"]);
} else {
    $rst_sent = $default_cw_rapport;
}
$rst_sent_proc = $rst_sent;

if (!empty($_POST["rst_rcvd_input"])) {
    $rst_rcvd = htmlentities($_POST["rst_rcvd_input"]);
} else {
    $rst_rcvd = $default_cw_rapport;
}
$rst_rcvd_proc = $rst_rcvd;


if (isset($mode)) {
    if (($mode == "CW") && ($rst_sent == $default_ssb_rapport)) {
        $rst_sent = $default_cw_rapport;
    } elseif (($mode == "SSB") && ($rst_sent == $default_cw_rapport)) {
        $rst_sent = $default_ssb_rapport;
    }

    if (($mode == "CW") && ($rst_rcvd == $default_ssb_rapport)) {
        $rst_rcvd = $default_cw_rapport;
    } elseif (($mode == "SSB") && ($rst_rcvd == $default_cw_rapport)) {
        $rst_rcvd = $default_ssb_rapport;
    }
}

if (isset($_POST["remarks_input"])) {
    $remarks = strtoupper(htmlentities($_POST["remarks_input"]));
    if (preg_match("/(I:\s*)(\S+)/", $remarks, $iota_treffer)) {
        $iota_nr = $iota_treffer[2];
    }

    if (preg_match("/(M:\s*)(\S+)/", $remarks, $manager_treffer)) {
        $manager = $manager_treffer[2];
    }

    if (preg_match("/(L:\s*)(\S+)/", $remarks, $locator_treffer)) {
        $locator = $locator_treffer[2];
    }
}

if (isset($_POST["date_input"])) {
    $qsodate = htmlentities($_POST["date_input"]);
}


if (isset($_POST["waz_input"])) {
    $waz = htmlentities($_POST["waz_input"]);
}


if (isset($_POST["qth_input"])) {
    $qth = htmlentities($_POST["qth_input"]);
}

if (isset($_POST["loc_input"])) {
    $loc = strtoupper(htmlentities($_POST["loc_input"]));
}

if (isset($_POST['qsls_input'])) {
    $qsls = (htmlentities($_POST["qsls_input"]));
}

if (isset($_POST['qsls_date'])) {
    $qsls_date = (htmlentities($_POST["qsls_date"]));
}

if (isset($_POST['qslr_input'])) {
    $qslr = (htmlentities($_POST["qslr_input"]));
}

if (isset($_POST['qslr_date'])) {
    $qslr_date = (htmlentities($_POST["qslr_date"]));
}

if (isset($_POST['state_input'])) {
    $state = strtoupper(htmlentities($_POST["state_input"]));
}
