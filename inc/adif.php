<?php
include_once("qso.php");
class Adif
{
    /*
    This class handles adif entries and files.
    */

    function read_adif_file($adif_file)
    {
        /* TODO: for line in file, parse header... */
        $line = "TODO";
        $exploded = (explode("<", $line));
        $adif_array = array();
        foreach ($exploded as $item) {
            if (preg_match('/(?P<FIELDNAME>\V+):(?P<LENGTH>\d+)>(?P<RAWVALUE>\V+)/', $item, $matches)) {
                $fieldname = strtoupper($matches["FIELDNAME"]);
                $length = $matches["LENGTH"];
                $rawvalue = $matches["RAWVALUE"];
                $value = substr($rawvalue, 0, $length);
                $adif_array[$fieldname] = $value;
            } elseif (str_contains($item, "EOR>")) {
                $qso_array = array();
                if (array_key_exists("QSO_DATE", $adif_array)) {
                    $qso_array["qsodate"] = $adif_array["QSO_DATE"];
                }
                if (array_key_exists("TIME_ON", $adif_array)) {
                    $qso_array["time_on"] = $adif_array["TIME_ON"];
                }
                if (array_key_exists("TIME_OFF", $adif_array)) {
                    $qso_array["time_off"] = $adif_array["TIME_OFF"];
                }
                if (array_key_exists("CALL", $adif_array)) {
                    $qso_array["callsign"] = $adif_array["CALL"];
                }
                if (array_key_exists("FREQ", $adif_array)) {
                    $qso_array["freq"] = $adif_array["FREQ"];
                }
                if (array_key_exists("MODE", $adif_array)) {
                    $qso_array["mode"] = $adif_array["MODE"];
                }
                if (array_key_exists("RST_SENT", $adif_array)) {
                    $qso_array["rst_s"] = $adif_array["RST_SENT"];
                }
                if (array_key_exists("RST_RCVD", $adif_array)) {
                    $qso_array["rst_r"] = $adif_array["RST_RCVD"];
                }
                if (array_key_exists("NAME", $adif_array)) {
                    $qso_array["name"] = $adif_array["NAME"];
                }
                if (array_key_exists("QTH", $adif_array)) {
                    $qso_array["qth"] = $adif_array["QTH"];
                }
                if (array_key_exists("QSL_SENT", $adif_array)) {
                    $qso_array["qsl_s"] = $adif_array["QSL_SENT"];
                }
                if (array_key_exists("QSL_RCVD", $adif_array)) {
                    $qso_array["qsl_r"] = $adif_array["QSL_RCVD"];
                }
                if (array_key_exists("QSL_VIA", $adif_array)) {
                    $qso_array["qsl_via"] = $adif_array["QSL_VIA"];
                }
                if (array_key_exists("QSL_VIA", $adif_array)) {
                    $qso_array["qsl_via"] = $adif_array["QSL_VIA"];
                }
                if (array_key_exists("IOTA", $adif_array)) {
                    $qso_array["iota"] = $adif_array["IOTA"];
                }
                /* Check for correct format of IOTA */
                if (array_key_exists("RX_PWR", $adif_array)) {
                    $qso_array["pwr"] = $adif_array["RX_PWR"];
                }
                if (array_key_exists("ITUZ", $adif_array)) {
                    $qso_array["itu"] = $adif_array["ITUZ"];
                }
                if (array_key_exists("CQZ", $adif_array)) {
                    $qso_array["waz"] = $adif_array["CQZ"];
                }
                if (array_key_exists("CQZ", $adif_array)) {
                    $qso_array["waz"] = $adif_array["CQZ"];
                }
                if (array_key_exists("GRIDSQUARE", $adif_array)) {
                    $qso_array["loc"] = $adif_array["GRIDSQUARE"];
                }
                if (array_key_exists("MY_GRIDSQUARE", $adif_array)) {
                    $qso_array["my_loc"] = $adif_array["MY_GRIDSQUARE"];
                }
                if (array_key_exists("CNTY", $adif_array)) {
                    $qso_array["county"] = $adif_array["CNTY"];
                }
                /* TODO: find out, how "award" in cqrlog is used */
                if (array_key_exists("COMMENT", $adif_array)) {
                    $qso_array["remarks"] = $adif_array["COMMENT"];
                }
                /* adif vs qso_dxcc....
                    if (array_key_exists("DXCC", $adif_array))
                    {
                        $qso_array["adif"] = $adif_array["DXCC"];
                    }
                */
                if (array_key_exists("BAND", $adif_array)) {
                    $qso_array["band"] = $adif_array["BAND"];
                }
                /* TODO: check for valid band */
                if (array_key_exists("STATE", $adif_array)) {
                    $qso_array["state"] = $adif_array["STATE"];
                }
                if (array_key_exists("LOTW_QSLSDATE", $adif_array)) {
                    $qso_array["lotw_qslsdate"] = $adif_array["LOTW_QSLSDATE"];
                }
                if (array_key_exists("LOTW_QSLRDATE", $adif_array)) {
                    $qso_array["lotw_qslrdate"] = $adif_array["LOTW_QSLRDATE"];
                }
                if (array_key_exists("LOTW_QSL_SENT", $adif_array)) {
                    $qso_array["lotw_qsls"] = $adif_array["LOTW_QSL_SENT"];
                }
                if (array_key_exists("LOTW_QSL_RCVD", $adif_array)) {
                    $qso_array["lotw_qslr"] = $adif_array["LOTW_QSL_RCVD"];
                }
                if (array_key_exists("CONT", $adif_array)) {
                    $qso_array["cont"] = $adif_array["CONT"];
                }
                /* Check for {NA, SA, EU , AF, OC, AS, AN} */
                if (array_key_exists("QSLRDATE", $adif_array)) {
                    $qso_array["qslr_date"] = $adif_array["QSLRDATE"];
                }
                if (array_key_exists("QSLSDATE", $adif_array)) {
                    $qso_array["qsls_date"] = $adif_array["QSLSDATE"];
                }
                if (array_key_exists("EQSL_QSLRDATE", $adif_array)) {
                    $qso_array["eqsl_qslrdate"] = $adif_array["EQSL_QSLRDATE"];
                }
                if (array_key_exists("EQSL_QSLSDATE", $adif_array)) {
                    $qso_array["eqsl_qslsdate"] = $adif_array["EQSL_QSLSDATE"];
                }
                if (array_key_exists("EQSL_QSL_SENT", $adif_array)) {
                    $qso_array["eqsl_qsl_sent"] = $adif_array["EQSL_QSL_SENT"];
                }
                if (array_key_exists("EQSL_QSL_RCVD", $adif_array)) {
                    $qso_array["eqsl_qsl_rcvd"] = $adif_array["EQSL_QSL_RCVD"];
                }
                if (array_key_exists("FREQ_RX", $adif_array)) {
                    $qso_array["rxfreq"] = $adif_array["FREQ_RX"];
                }
                if (array_key_exists("SAT_NAME", $adif_array)) {
                    $qso_array["satellite"] = $adif_array["SAT_NAME"];
                }
                if (array_key_exists("PROP_MODE", $adif_array)) {
                    $qso_array["prop_mode"] = $adif_array["PROP_MODE"];
                }
                if (array_key_exists("STX", $adif_array)) {
                    $qso_array["stx"] = $adif_array["STX"];
                }
                if (array_key_exists("SRX", $adif_array)) {
                    $qso_array["srx"] = $adif_array["SRX"];
                }
                if (array_key_exists("STX_STRING", $adif_array)) {
                    $qso_array["stx_string"] = $adif_array["STX_STRING"];
                }
                if (array_key_exists("SRX_STRING", $adif_array)) {
                    $qso_array["srx_string"] = $adif_array["SRX_STRING"];
                }
                if (array_key_exists("CONTEST_ID", $adif_array)) {
                    $qso_array["contestname"] = $adif_array["CONTEST_ID"];
                }
                /* DOK relevant? */
                if (array_key_exists("CONTEST_ID", $adif_array)) {
                    $qso_array["contestname"] = $adif_array["CONTEST_ID"];
                }
                if (array_key_exists("OPERATOR", $adif_array)) {
                    $qso_array["operator"] = $adif_array["OPERATOR"];
                }
                /* STATION-CALLSIGN, OPERATOR could be both CALLSIGN */

                /* print("END OF QSO");
                print_r($qso_array);
                */
                /* TODO: return QSO */
                return new Qso($qso_array);
            }
        }
    }

    function return_adif(Qso $qso)
    {

        $adifline = '';

        if (!empty($qso->get_qsodate())) {
            $qsodate = str_replace("-", "", $qso->get_qsodate());
            $adifline .= '<QSO_DATE:8>' . $qsodate;
        }

        if (!empty($qso->get_time_on())) {
            $timeon = str_replace(":", "", $qso->get_time_on());
            $adifline .= '<TIME_ON:4>' . $timeon;
        }

        if (!empty($qso->get_time_off())) {
            $timeoff = str_replace(":", "", $qso->get_time_off());
            $adifline .= '<TIME_OFF:4>' . $timeoff;
        }

        if (!empty($qso->get_callsign())) {
            $adifline .= '<CALL:' . strlen($qso->get_callsign()) . '>' . $qso->get_callsign();
        }

        if (!empty($qso->get_mode())) {
            $adifline .= '<MODE:' . strlen($qso->get_mode()) . '>' . $qso->get_mode();
        }

        if (!empty($qso->get_freq())) {
            $adifline .= '<FREQ:' . strlen($qso->get_freq()) . '>' . $qso->get_freq();
        }

        if (!empty($qso->get_band())) {
            $adifline .= '<BAND:' . strlen($qso->get_band()) . '>' . $qso->get_band();
        }

        if (!empty($qso->get_rst_s())) {
            $adifline .= '<RST_SENT:' . strlen($qso->get_rst_s()) . '>' . $qso->get_rst_s();
        }

        if (!empty($qso->get_rst_r())) {
            $adifline .= '<RST_RCVD:' . strlen($qso->get_rst_r()) . '>' . $qso->get_rst_r();
        }

        if (!empty($qso->get_name())) {
            $adifline .= '<NAME:' . strlen($qso->get_name()) . '>' . $qso->get_name();
        }

        if (!empty($qso->get_remarks())) {
            $adifline .= '<COMMENT:' . strlen($qso->get_remarks()) . '>' . $qso->get_remarks();
        }

        if (!empty($qso->get_qsl_s())) {
            $qsl_sent = "";
            if ($qso->get_qsl_s() == "D" or $qso->get_qsl_s() == "B") {
                $qsl_sent = "Y";
            } else {
                $qsl_sent = "N";
            }

            $adifline .= '<QSL_SENT:1>' . $qsl_sent;
        } else {
            $adifline .= '<QSL_SENT:1>N';
        }

        if (!empty($qso->get_qsl_r())) {
            $qsl_rcvd = "Y";
            $adifline .= '<QSL_RCVD:1>' . $qsl_rcvd;
        } else {

            $adifline .= '<QSL_RCVD:1>N';
        }

        if (!empty($qso->get_qsl_via())) {
            $adifline .= '<QSL_VIA:' . strlen($qso->get_qsl_via()) . '>' . $qso->get_qsl_via();
        }

        if (!empty($qso->get_iota())) {
            $adifline .= '<IOTA:' . strlen($qso->get_iota()) . '>' . $qso->get_iota();
        }

        if (!empty($qso->get_adif())) {
            $adifline .= '<DXCC:' . strlen($qso->get_adif()) . '>' . $qso->get_adif();
        }

        if (!empty($qso->get_itu())) {
            $adifline .= '<ITUZ:' . strlen($qso->get_itu()) . '>' . $qso->get_itu();
        }

        if (!empty($qso->get_waz())) {
            $adifline .= '<CQZ:' . strlen($qso->get_waz()) . '>' . $qso->get_waz();
        }

        if (!empty($qso->get_state())) {
            $adifline .= '<STATE:' . strlen($qso->get_state()) . '>' . $qso->get_state();
        }

        if (!empty($qso->get_qsls_date())) {
            $qslsdate = str_replace("-", "", $qso->get_qsls_date());
            $adifline .= '<QSLSDATE:8>' . $qslsdate;
        }

        if (!empty($qso->get_qslr_date())) {
            $qslrdate = str_replace("-", "", $qso->get_qslr_date());
            $adifline .= '<QSLRDATE:8>' . $qslrdate;
        }

        if (!empty($qso->get_lotw_qsls())) {
            $adifline .= '<LOTW_QSL_SENT:1>Y';
        }

        if (!empty($qso->get_lotw_qslsdate())) {
            $lotwsdate = str_replace("-", "", $qso->get_lotw_qslsdate());
            $adifline .= '<LOTW_QSLSDATE:8>' . $lotwsdate;
        }

        if (!empty($qso->get_lotw_qsls())) {
            $adifline .= '<LOTW_QSL_RCVD:1>Y';
        }

        if (!empty($qso->get_lotw_qslrdate())) {
            $lotwrdate = str_replace("-", "", $qso->get_lotw_qslrdate());
            $adifline .= '<LOTW_QSLRDATE:8>' . $lotwrdate;
        }

        if (!empty($qso->get_eqsl_qsl_sent())) {
            $adifline .= '<EQSL_QSL_SENT:1>Y';
        }

        if (!empty($qso->get_eqsl_qslsdate())) {
            $eqslsdate = str_replace("-", "", $qso->get_eqsl_qslsdate());
            $adifline .= '<EQSL_QSLSDATE:8>' . $eqslsdate;
        }

        if (!empty($qso->get_eqsl_qsl_rcvd())) {
            $adifline .= '<EQSL_QSL_RECEIVED:1>Y';
        }

        if (!empty($qso->get_eqsl_qslrdate())) {
            $eqslrdate = str_replace("-", "", $qso->get_eqsl_qslrdate());
            $adifline .= '<EQSL_QSLRDATE:8>' . $eqslrdate;
        }

        $adifline .=  '<EOR>';

        return $adifline;
    }
}
