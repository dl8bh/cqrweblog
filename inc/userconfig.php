<?php

/*
Class for user specific configuration, that uses the "cqrlog_web" database and the following table "settings":
Default values can be stored in log_nr 0.

CREATE TABLE IF NOT EXISTS `settings` (
  `log_nr` tinyint UNSIGNED NOT NULL,
  `cluster_enable` tinyint(1) NOT NULL DEFAULT '1',
  `help_enable` tinyint(1) NOT NULL DEFAULT '1',
  `searchcount_enable` tinyint(1) NOT NULL DEFAULT '1',
  `pubqslr_enable` tinyint(1) NOT NULL DEFAULT '1',
  `pubqsls_enable` tinyint(1) NOT NULL DEFAULT '1',
  `searchcount` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`log_nr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;
*/
class Userconfig {
    private $dbobj;
    private $log_nr;
    private $cluster_enable;
    private $help_enable;
    private $searchcount_enable;
    private $pubqslr_enable;
    private $pubqsls_enable;
    private $searchcount;
    
    private $config_exists;
    private $call;

  

    function __construct($dbobj, int $log_nr, bool $create) {
        
        $this->dbobj = $dbobj;
        $this->dbobj->select_db("cqrlog_web");
        $this->log_nr = $dbobj->real_escape_string($log_nr);
        $this->config_exists = $this->_check_if_config_exists($log_nr);
        if (!$create && $this->config_exists) {
            $this->_init_config_from_db($this->log_nr);
        } elseif ($create && !$this->config_exists) {
            $this->_init_config_to_db($this->log_nr);
        } else {
            $this->_init_config_from_db(0);
        }
    }

    private function _init_config_from_db(int $log_nr) {
        $query = sprintf("SELECT * from settings where log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        while($row = $result->fetch_assoc()) {
            #var_dump($row);
            foreach($row as $key => $value){
                $this->$key = $value;
            }
        }
    }

    function _check_if_config_exists(int $log_nr) {
        $query = sprintf("SELECT log_nr from settings where log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $result = $result->num_rows;
        return((boolean) $result);
    }

    private function _init_config_to_db(int $log_nr) {
        $query = sprintf("INSERT INTO settings(log_nr) VALUES (%u)", $this->log_nr);
        $result = $this->dbobj->query($query);
    }

    function get_cluster_enabled() {
        return $this->cluster_enable;
    }

    function enable_cluster() {
        $query = sprintf("UPDATE settings SET enable_cluster = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return($result);
    }
    
    function disable_cluster() {
        $query = sprintf("UPDATE settings SET enable_cluster = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return($result);
    }


    function get_help_enabled() {
        return $this->help_enable;
    }

    function enable_help() {
        $query = sprintf("UPDATE settings SET enable_help = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return($result);
    }
    
    function disable_help() {
        $query = sprintf("UPDATE settings SET enable_help = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return($result);
    }


}

function enable_pubqslr() {
    $query = sprintf("UPDATE settings SET enable_pubqslr = '1' WHERE log_nr='%u'", $this->log_nr);
    $result = $this->dbobj->query($query);
    return $result;
}

function disable_pubqslr() {
    $query = sprintf("UPDATE settings SET enable_pubqslr = '0' WHERE log_nr='%u'", $this->log_nr);
    $result = $this->dbobj->query

    function get_searchcount_enabled() {
        return $this->searchcount_enable;
    }

    function enable_searchcount() {
        $query = sprintf("UPDATE settings SET enable_searchcount = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }
    
    function disable_searchcount() {
        $query = sprintf("UPDATE settings SET enable_searchcount = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function get_searchcount() {
        return (int) $this->searchcount;
    }
    
    private function update_searchcount() {
        $query = sprintf("SELECT searchcount from settings where log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->searchcount = (int) $result->fetch_object()->searchcount;
    }

    function inc_searchcount() {
        $query = sprintf("UPDATE settings SET searchcount = searchcount + 1 WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->update_searchcount();
        return $result;
    }

    function set_searchcount(int $searchcount) {
        $searchcount = $this->dbobj->real_escape_string($searchcount);
        $query = sprintf("UPDATE settings SET searchcount='%u' WHERE log_nr='%u'", $searchcount, $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->update_searchcount();
        return $result;
    }


    function get_pubqslr_enabled() {
        return $this->pubqslr_enable;
    }

    function enable_pubqslr() {
        $query = sprintf("UPDATE settings SET enable_pubqslr = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }
    
    function disable_pubqslr() {
        $query = sprintf("UPDATE settings SET enable_pubqslr = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }


    function get_pubqsls_enabled() {
        return $this->pubqsls_enable;
    }

    function enable_pubqsls() {
        $query = sprintf("UPDATE settings SET enable_pubqsls = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }
    
    function disable_pubqsls() {
        $query = sprintf("UPDATE settings SET enable_pubqsls = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

}


?>