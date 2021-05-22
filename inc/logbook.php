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
        "id_cqrlog_main",
        "qsodate",
        "time_on",
        "time_off",
        "callsign",
        "freq",
        "mode",
        "rst_s",
        "rst_r",
        "name",
        "qth",
        "qsl_s",
        "qsl_r",
        "qsl_via",
        "iota",
        "pwr",
        "itu",
        "waz",
        "loc",
        "my_loc",
        "county",
        "award",
        "remarks",
        "adif",
        "band",
        "qso_dxcc",
        "profile",
        "idcall",
        "state",
        "lotw_qslsdate",
        "lotw_qslrdate",
        "lotw_qsls",
        "lotw_qslr",
        "cont",
        "qsls_date",
        "qslr_date",
        "club_nr1",
        "club_nr2",
        "club_nr3",
        "club_nr4",
        "club_nr5",
        "eqsl_qsl_sent",
        "eqsl_qslsdate",
        "eqsl_qsl_rcvd",
        "eqsl_qslrdate",
        "rxfreq",
        "satellite",
        "prop_mode",
        "stx",
        "srx",
        "stx_string",
        "srx_string",
        "contestname",
        "dok",
        "operator"
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
            if (in_array($key, $this->legal_fields)) {
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
            if ($key != "id_cqrlog_main" && !empty($value) && in_array($key, $this->legal_fields)) {
                array_push($keys_array, $key);
                array_push($values_array, $value);
                array_push($value_questionmarks, "?");
                $datatype_string = $datatype_string . "s";
            }
        }
        $keys_string = implode(",", $keys_array);
        $values_string = implode(',', $value_questionmarks);
        $query = $this->dbobj->prepare(sprintf("INSERT INTO cqrlog_main (%s) VALUES (%s)", $keys_string, $values_string));
        $query->bind_param($datatype_string, ...$values_array);
        $query->execute();
    }
}
