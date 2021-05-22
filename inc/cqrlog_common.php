<?php

class Cqrlog_common
{
    private $dbobj;
    private $band_list;

    function __construct($dbobj)
    {
        $this->dbobj = $dbobj;
        $this->dbobj->select_db("cqrlog_common");
        $this->band_list = $this->_fetch_band_list();
    }

    function adif_to_dxcc(int $adif)
    {
        $adif = $this->dbobj->real_escape_string($adif);
        $query = sprintf("SELECT pref FROM dxcc_ref WHERE adif = ?", $adif);
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("i", $adif);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object()->pref;
    }

    function get_iota(string $call, string $pref)
    {
        $query = 'SELECT * FROM iota_list WHERE dxcc_ref=? AND ? RLIKE CONCAT("^",pref) AND pref !=""';# $pref, $call);
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("ss", $pref, $call);
        $stmt->execute();
        $result = $stmt->get_result();
        $iota_nr = NULL;
        $island_name = NULL;
        if ($result->num_rows) {
            $result = $result->fetch_assoc();
            $island_name = $result["island_name"];
            $iota_nr = $result["iota_nr"];
        }
        return array($iota_nr, $island_name);
    }

    function logid_to_call(int $log_id)
    {
        $query = "SELECT log_name FROM log_list WHERE log_nr=?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("i", $log_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            return $result->fetch_object()->log_name;
        }
        return NULL;
    }

    function freq_to_band_mode($inputfreq)
    {
        $inputfreq = $this->dbobj->real_escape_string($inputfreq);
        $query = "SELECT cw,rtty,ssb,band FROM bands WHERE b_begin <= ? AND b_end >= ?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("ss", $inputfreq, $inputfreq);
        $stmt->execute();
        $result = $stmt->get_result();
        $returnmode = NULL;
        if ($result->num_rows) {
            $result = $result->fetch_assoc();
            $returnband = $result["band"];
            if ($inputfreq < $result["cw"]) {
                $returnmode = "CW";
            } else if (($inputfreq >= $result["rtty"] && ($inputfreq < $result["ssb"]))) {
                $returnmode = "RTTY";
            } else if ($inputfreq > $result["ssb"]) {
                $returnmode = "SSB";
            }
            return array($returnband, $returnmode);
        }
        return NULL;
    }

    function freq_to_band($inputfreq)
    {
        $bandmode = $this->freq_to_band_mode($inputfreq);
        return $bandmode[0];
    }

    function freq_to_mode($inputfreq)
    {
        $bandmode = $this->freq_to_band_mode($inputfreq);
        return $bandmode[1];
    }

    function get_manager($callsign)
    {
        $query = "SELECT qsl_via FROM qslmgr WHERE callsign = ?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("s", $callsign);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            return $result->fetch_object()->qsl_via;
        } else {
            return NULL;
        }
    }

    function band_to_freq($inputband)
    {
        $query = "SELECT b_begin FROM bands WHERE band = ?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("s", $inputband);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            return $result->fetch_object()->b_begin;
        } else {
            return NULL;
        }
    }

    function validate_freq($freq)
    {

        switch ($freq) {
                //check for lazy WARC band frequency input
            case '10':
                return $this->band_to_freq('30M');
                break;

            case '18':
                return $this->band_to_freq('17M');
                break;

            case '24':
                return $this->band_to_freq('12M');

            case '':
                return NULL;

                //Check if frequency input was in kHz, if true, convert to MHz
            default:
                if (!$this->freq_to_band($freq)) {

                    //kHz/1000 = MHz
                    $newfreq = $freq / 1000;

                    if ($this->freq_to_band($newfreq)) {

                        return $newfreq;
                    }
                }

                return $freq;
                break;
        }
    }

    function dxcc_to_adif($dxcc)
    {
        $query = "SELECT adif FROM dxcc_ref WHERE pref = ?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("s", $dxcc);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            return $result->fetch_object()->adif;
        } else {
            return NULL;
        }
    }

    function _fetch_band_list()
    {
        $query = "SELECT band FROM bands ORDER BY b_begin ASC";
        $result = $this->dbobj->query($query)->fetch_all();
        return $result;
    }

    function get_band_list()
    {
        return $this->band_list;
    }
}
