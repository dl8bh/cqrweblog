<?php
include("qso.php");
class Logbook
{
    /*
    This class interfaces the cqrlogNNN tables.
    */
    private $dbobj;
    private $log_id;

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

    function get_log(int $num, $where)
    {
    }

    function get_qso(int $qsoid)
    {
        $query = sprintf("SELECT * FROM cqrlog_main WHERE id_cqrlog_main = %u", $qsoid);
        $result = $this->dbobj->query($query)->fetch_assoc();
        $qso = new Qso($result);
        return $qso;
    }

    function save_qso(Qso $qso)
    {
    }
}