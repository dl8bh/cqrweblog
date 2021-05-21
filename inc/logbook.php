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
        foreach ($assoc_where_array as $key => $value) {
            $key = $this->dbobj->real_escape_string($key);
            $value = $this->dbobj->real_escape_string($value);
            if (in_array($key, $this->where_like)) {
                $wherestring = $wherestring . sprintf("AND %s LIKE '%s' ", $key, $value);
            } else {
                $wherestring = $wherestring .  sprintf("AND %s='%s' ", $key, $value);
            }
        }
        if (!empty($wherestring)) {
            $query = $query . " WHERE 1=1 " . $wherestring;
        }

        $query = $query . " ORDER BY qsodate DESC, time_on DESC";
        if ($num > 0) {
            $query = $query . " LIMIT " . $num;
        }
        echo ($query);
        $result = $this->dbobj->query($query);
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
        foreach ($assoc_qso_array as $key => $value) {
            if ($key != "id_cqrlog_main" && !empty($value)) {
                array_push($keys_array, $key);
                array_push($values_array, $value);
            }
        }
        $keys_string = implode(",", $keys_array);
        $values_string = implode('","', $values_array);
        $values_string = '"' . $values_string . '"';

        $query = (sprintf("INSERT INTO cqrlog_main (%s) VALUES (%s)", $keys_string, $values_string));
        $this->dbobj->query($query);
    }
}
