<?php
include("qso.php");
class Logbook
{
    /*
    This class interfaces the cqrlogNNN tables.
    */
    private $dbobj;
    private $log_id;
    private $where_like = array("callsign", "remarks", "name", "loc");
    private $legal_fields = array(
        "id_cqrlog_main" => "i",
        "qsodate" => "s",
        "time_on" => "s",
        "time_off" => "s",
        "callsign" => "s",
        "freq" => "s",
        "mode" => "s",
        "rst_s" => "s",
        "rst_r" => "s",
        "name" => "s",
        "qth" => "s",
        "qsl_s" => "s",
        "qsl_r" => "s",
        "qsl_via" => "s",
        "iota" => "s",
        "pwr" => "s",
        "itu" => "i",
        "waz" => "i",
        "loc" => "s",
        "my_loc" => "s",
        "county" => "s",
        "award" => "s",
        "remarks" => "s",
        "adif" => "i",
        "band" => "s",
        "qso_dxcc" => "i",
        "profile" => "i",
        "idcall" => "s",
        "state" => "s",
        "lotw_qslsdate" => "s",
        "lotw_qslrdate" => "s",
        "lotw_qsls" => "s",
        "lotw_qslr" => "s",
        "cont" => "s",
        "qsls_date" => "s",
        "qslr_date" => "s",
        "club_nr1" => "s",
        "club_nr2" => "s",
        "club_nr3" => "s",
        "club_nr4" => "s",
        "club_nr5" => "s",
        "eqsl_qsl_sent" => "s",
        "eqsl_qslsdate" => "s",
        "eqsl_qsl_rcvd" => "s",
        "eqsl_qslrdate" => "s",
        "rxfreq" => "s",
        "satellite" => "s",
        "prop_mode" => "s",
        "stx" => "s",
        "srx" => "s",
        "stx_string" => "s",
        "srx_string" => "s",
        "contestname" => "s",
        "dok" => "s",
        "operator" => "s"
    );

    function __construct($dbobj, int $log_id)
    {
        $this->dbobj = $dbobj;
        $this->log_id = $log_id;
        $this->database_name = $this->logid_to_tableid($log_id);
        $this->dbobj->select_db($this->database_name);
    }

    function logid_to_tableid(int $log_id)
    {
        $log_id = sprintf("%03d", $log_id);
        return 'cqrlog' . $log_id;
    }

    function count_qsos()
    {
        $where = "1 = 1";
        $query = sprintf("SELECT COUNT(*) FROM view_cqrlog_main_by_qsodate WHERE %s", $where);
        $result = $this->dbobj->query($query);
        $result = $result->fetch_row();

        return $result[0];
    }

    function _fetch_log_assoc(int $num, array $assoc_where_array)
    {
        $query = "SELECT * FROM cqrlog_main";
        $wherestring = "";
        $key_array = array();
        $datatype_string = '';
        foreach ($assoc_where_array as $key => $value) {
            if (in_array($key, array_keys($this->legal_fields))) {
                array_push($key_array, $value);
                $datatype_string = $datatype_string . "s";
                if (in_array($key, $this->where_like)) {
                    $wherestring = $wherestring . sprintf("AND %s LIKE ? ", $key);
                } else {
                    $wherestring = $wherestring .  sprintf("AND %s=? ", $key);
                }
            }
        }
        if (!empty($wherestring)) {
            $query = $query . " WHERE 1=1 " . $wherestring;
        }

        $query = $query . " ORDER BY qsodate DESC, time_on DESC, id_cqrlog_main DESC";
        if ($num > 0) {
            $query = $query . " LIMIT " . $num;
        }
        $stmt = $this->dbobj->prepare($query);
        if (!empty($datatype_string) && !empty($key_array)) {
            $stmt->bind_param($datatype_string, ...$key_array);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->fetch_all(MYSQLI_ASSOC));
    }

    function get_log(int $num, array $assoc_where_array)
    {
        $fetched_assoc_array = $this->_fetch_log_assoc($num, $assoc_where_array);
        $output_array = array();
        foreach ($fetched_assoc_array as $row) {
            $qso = new Qso($row);
            $output_array[] = $qso;
        }
        return ($output_array);
    }

    function get_qso(int $qsoid)
    {
        $query = $this->dbobj->prepare("SELECT * FROM cqrlog_main WHERE id_cqrlog_main = ?");
        $query->bind_param("i", $qsoid);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc();
        $qso = new Qso($result);
        return $qso;
    }

    function insert_qso(Qso $qso)
    {
        $assoc_qso_array = $qso->return_qso_assoc_array();
        $keys_array = array();
        $values_array = array();
        $value_questionmarks = array();
        $datatype_string = "";
        foreach ($assoc_qso_array as $key => $value) {
            if ($key != "id_cqrlog_main" && !empty($value) && in_array($key, array_keys($this->legal_fields))) {
                array_push($keys_array, $key);
                array_push($values_array, $value);
                array_push($value_questionmarks, "?");
                $datatype_string = $datatype_string . $this->legal_fields[$key];
            }
        }
        $keys_string = implode(",", $keys_array);
        $values_string = implode(',', $value_questionmarks);
        $query = $this->dbobj->prepare(sprintf("INSERT INTO cqrlog_main (%s) VALUES (%s)", $keys_string, $values_string));
        $query->bind_param($datatype_string, ...$values_array);
        $query->execute();
    }
    function edit_qso(int $qso_id, array $update_array)
    {
        $keys_array = array();
        $values_array = array();
        $value_questionmarks = array();
        $datatype_string = "";
        $setstring = "";
        $counter = 0;
        foreach ($update_array as $key => $value) {
            if ($key != "id_cqrlog_main" && !empty($value) && in_array($key, array_keys($this->legal_fields))) {
                if ($counter == 0) {
                    $setstring = sprintf("%s=?", $key);
                } else {
                    $setstring = $setstring . sprintf(", %s=?", $key);
                }
                array_push($values_array, $value);
                $datatype_string = $datatype_string . $this->legal_fields[$key];
                $counter += 1;
            }
        }
        array_push($values_array, $qso_id);
        $datatype_string = $datatype_string . "i";
        $query = $this->dbobj->prepare(sprintf("UPDATE cqrlog_main SET %s WHERE id_cqrlog_main=?", $setstring));
        $query->bind_param($datatype_string, ...$values_array);
        $query->execute();
    }

    function get_active_bands()
    {
        $query = "SELECT DISTINCT t2.band FROM cqrlog_main t1 JOIN cqrlog_common.bands t2 ON t1.band = t2.band ORDER BY t2.b_begin ASC";
        $result = $this->dbobj->query($query)->fetch_all();
        $bands = array();
        foreach ($result as $band) {
            array_push($bands, $band[0]);
        }
        return $band;
    }

    private function get_qsl_string(array $qslarray)
    {
        $qslstring = "";

        if (($qslarray["paper"]) && ($qslarray["lotw"]) && ($qslarray["eqsl"])) {
            $qslstring = ' and ( (qsl_r !="" ) OR (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
        } elseif (($qslarray["paper"]) && ($qslarray["lotw"])) {
            $qslstring = ' and ( (qsl_r !="" ) OR (lotw_qslrdate IS NOT NULL) )';
        } elseif (($qslarray["paper"]) && ($qslarray["eqsl"])) {
            $qslstring = ' and ( (qsl_r !="" ) OR (eqsl_qslrdate IS NOT NULL) )';
        } elseif (($qslarray["lotw"]) && ($qslarray["eqsl"])) {
            $qslstring = ' and ( (lotw_qslrdate IS NOT NULL) OR (eqsl_qslrdate IS NOT NULL) )';
        } elseif ($qslarray["lotw"]) {
            $qslstring = ' and lotw_qslrdate IS NOT NULL ';
        } elseif ($qslarray["eqsl"]) {
            $qslstring = ' and eqsl_qslrdate IS NOT NULL ';
        } elseif ($qslarray["paper"]) {
            $qslstring = ' and qsl_r !="" ';
        }

        return $qslstring;
    }

    function get_stats(int $adif_dxcc, array $qslarray)
    {
        $qslstring = $this->get_qsl_string($qslarray);
        if (!empty($qslstring)) {
        }
        $query = "SELECT DISTINCT adif,band,mode FROM cqrlog_main ORDER BY adif, band DESC";
        $result = $this->dbobj->query($query)->fetch_all(MYSQLI_ASSOC);
        $resultarray = array();
        foreach ($result as $row) {
            $adif = $row["adif"];
            $band = $row["band"];
            $mode = $row["mode"];
            if (!in_array($adif, array_keys($resultarray))) {
                $resultarray[$adif] = array();
            }
            if (!in_array($band, array_keys($resultarray[$adif]))) {
                $resultarray[$adif][$band] = array();
            }
            $resultarray[$adif][$band][] = $mode;
        }
        return $resultarray;
    }
}
