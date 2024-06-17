<?php
class Adif
{
    /*
    This class handles adif entries and files.
    */

    function read_adif_line($adifline)
    {
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
