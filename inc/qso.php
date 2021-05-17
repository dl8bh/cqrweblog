<?php
class Qso
{
    /*
    This class describes a qso.
    */
    private $id_cqrlog_main;
    private $qsodate;
    private $time_on;
    private $time_off;
    private $callsign;
    private $freq;
    private $mode;
    private $rst_s;
    private $rst_r;
    private $name;
    private $qth;
    private $qsl_s;
    private $qsl_r;
    private $qsl_via;
    private $iota;
    private $pwr;
    private $itu;
    private $waz;
    private $loc;
    private $my_loc;
    private $county;
    private $award;
    private $remarks;
    private $adif;
    private $band;
    private $qso_dxcc;
    private $profile;
    private $idcall;
    private $state;
    private $lotw;
    private $lotw_qslsdate;
    private $lotw_qslrdate;
    private $lotw_qsls;
    private $lotw_qslr;
    private $cont;
    private $qsls_date;
    private $qslr_date;
    private $club_nr1;
    private $club_nr2;
    private $club_nr3;
    private $club_nr4;
    private $club_nr5;
    private $eqsl_qsl_sent;
    private $eqsl_qslsdate;
    private $eqsl_qsl_rcvd;
    private $eqsl_qslrdate;
    private $rxfreq;
    private $satellite;
    private $prop_mode;
    private $stx;
    private $srx;
    private $stx_string;
    private $srx_string;
    private $contestname;
    private $dok;
    private $operator;

    function __construct($assoc_qso_array)
    {
        foreach ($assoc_qso_array as $key => $value) {
            $this->$key = $value;
        }
    }

    function return_qso_assoc_array()
    {

        return;
    }

    function get_id_cqrlog_main() {return $this->id_cqrlog_main;}
    function get_qsodate() {return $this->qsodate;}
    function get_time_on() {return $this->time_on;}
    function get_time_off() {return $this->time_off;}
    function get_callsign() {return $this->callsign;}
    function get_freq() {return $this->freq;}
    function get_mode() {return $this->mode;}
    function get_rst_s() {return $this->rst_s;}
    function get_rst_r() {return $this->rst_r;}
    function get_name() {return $this->name;}
    function get_qth() {return $this->qth;}
    function get_qsl_s() {return $this->qsl_s;}
    function get_qsl_r() {return $this->qsl_r;}
    function get_qsl_via() {return $this->qsl_via;}
    function get_iota() {return $this->iota;}
    function get_pwr() {return $this->pwr;}
    function get_itu() {return $this->itu;}
    function get_waz() {return $this->waz;}
    function get_loc() {return $this->loc;}
    function get_my_loc() {return $this->my_loc;}
    function get_county() {return $this->county;}
    function get_award() {return $this->award;}
    function get_remarks() {return $this->remarks;}
    function get_adif() {return $this->adif;}
    function get_band() {return $this->band;}
    function get_qso_dxcc() {return $this->qso_dxcc;}
    function get_profile() {return $this->profile;}
    function get_idcall() {return $this->idcall;}
    function get_state() {return $this->state;}
    function get_lotw() {return $this->lotw;}
    function get_lotw_qslsdate() {return $this->lotw_qslsdate;}
    function get_lotw_qslrdate() {return $this->lotw_qslrdate;}
    function get_lotw_qsls() {return $this->lotw_qsls;}
    function get_lotw_qslr() {return $this->lotw_qslr;}
    function get_cont() {return $this->cont;}
    function get_qsls_date() {return $this->qsls_date;}
    function get_qslr_date() {return $this->qslr_date;}
    function get_club_nr1() {return $this->club_nr1;}
    function get_club_nr2() {return $this->club_nr2;}
    function get_club_nr3() {return $this->club_nr3;}
    function get_club_nr4() {return $this->club_nr4;}
    function get_club_nr5() {return $this->club_nr5;}
    function get_eqsl_qsl_sent() {return $this->eqsl_qsl_sent;}
    function get_eqsl_qslsdate() {return $this->eqsl_qslsdate;}
    function get_eqsl_qsl_rcvd() {return $this->eqsl_qsl_rcvd;}
    function get_eqsl_qslrdate() {return $this->eqsl_qslrdate;}
    function get_rxfreq() {return $this->rxfreq;}
    function get_satellite() {return $this->satellite;}
    function get_prop_mode() {return $this->prop_mode;}
    function get_stx() {return $this->stx;}
    function get_srx() {return $this->srx;}
    function get_stx_string() {return $this->stx_string;}
    function get_srx_string() {return $this->srx_string;}
    function get_contestname() {return $this->contestname;}
    function get_dok() {return $this->dok;}
    function get_operator() {return $this->operator;}

}
