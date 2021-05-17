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

    }

   function return_qso_assoc_array() {
       return
   }
}
