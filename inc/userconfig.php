<?php

/*
Class for user specific configuration, that uses the "cqrlog_web" database and the following table "settings":
Default values can be stored in log_nr 0.

CREATE TABLE `settings` (
  `log_nr` tinyint(3) UNSIGNED NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `cluster_spot_number` tinyint(1) NOT NULL DEFAULT 50 COMMENT 'Number of Spots',
  `cluster_skimmer_mode` tinyint(4) NOT NULL DEFAULT 3 COMMENT '0 => disabled, 1 => cluster only, 2 => skimmer only, 3 => both',
  `cluster_bands` varchar(255) DEFAULT NULL COMMENT 'serialized array of band-strings',
  `cluster_modes` varchar(255) DEFAULT NULL COMMENT 'serialized array of mode-strings',
  `help_enable` tinyint(1) NOT NULL DEFAULT 1,
  `searchcount_enable` tinyint(1) NOT NULL DEFAULT 1,
  `pubqslr_enable` tinyint(1) NOT NULL DEFAULT 1,
  `pubqsls_enable` tinyint(1) NOT NULL DEFAULT 1,
  `searchcount` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


ALTER TABLE `settings`
  ADD PRIMARY KEY (`log_nr`);
*/

class Userconfig
{
    private $dbobj;
    private $log_nr;
    private $cluster_spot_number;
    private $cluster_skimmer_mode;
    private $help_enable;
    private $searchcount_enable;
    private $pubqslr_enable;
    private $pubqsls_enable;
    private $searchcount;
    private $cluster_bands;
    private $cluster_modes;
    private $allowed_bands;
    private $config_exists;
    private $call;
    private $Cqrlog_common;



    function __construct($dbobj, int $log_nr, bool $create)
    {

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
        $this->Cqrlog_common = new Cqrlog_common($dbobj);
        $this->allowed_bands = $this->Cqrlog_common->get_band_list();
    }

    private function _init_config_from_db(int $log_nr)
    {
        $query = "SELECT * from settings where log_nr=?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("i", $log_nr);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        }
        $this->cluster_bands = json_decode($this->cluster_bands);
        $this->cluster_modes = json_decode($this->cluster_modes);
    }

    function _check_if_config_exists(int $log_nr)
    {
        $query = $this->dbobj->prepare("SELECT log_nr from settings where log_nr=?");
        $query->bind_param("i", $log_nr);
        $query->execute();
        $result = $query->get_result();
        $result = $result->num_rows;
        return (bool) $result;
    }

    private function _init_config_to_db(int $log_nr)
    {
        $query = $this->dbobj->prepare("INSERT INTO settings(log_nr) VALUES (?)");
        $query->bind_param("i", $log_nr);
        $query->execute();
        $result = $query->get_result();
        $result = $result->num_rows;
        return (bool) $result;
    }

    function get_cluster_enabled()
    {
        if ($this->get_cluster_skimmer_mode() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_cluster_spot_number()
    {
        return $this->cluster_spot_number;
    }

    function disable_cluster()
    {
        $query = $this->dbobj->prepare("UPDATE settings SET cluster_skimmer_mode = 0 WHERE log_nr = ?");
        $query->bind_param("i", $this->log_nr);
        $query->execute();
        $result = $query->get_result();
        return $result;
    }


    function get_help_enabled()
    {
        return $this->help_enable;
    }

    function enable_help()
    {
        $query = sprintf("UPDATE settings SET enable_help = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function disable_help()
    {
        $query = sprintf("UPDATE settings SET enable_help = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }


    function get_searchcount_enabled()
    {
        return $this->searchcount_enable;
    }

    function enable_searchcount()
    {
        $query = sprintf("UPDATE settings SET enable_searchcount = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function disable_searchcount()
    {
        $query = sprintf("UPDATE settings SET enable_searchcount = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function get_searchcount()
    {
        return (int) $this->searchcount;
    }

    private function update_searchcount()
    {
        $query = sprintf("SELECT searchcount FROM settings WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->searchcount = (int) $result->fetch_object()->searchcount;
    }

    function inc_searchcount()
    {
        $query = sprintf("UPDATE settings SET searchcount = searchcount + 1 WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->update_searchcount();
        return $result;
    }

    function set_searchcount(int $searchcount)
    {
        $query = "UPDATE settings SET searchcount=? WHERE log_nr=?";
        $stmt = $this->dbobj->prepare($query);
        $stmt->bind_param("ii", $searchcount, $this->log_nr);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->update_searchcount();
        return $result;
    }

    function get_cluster_bands()
    {
        if ($this->cluster_bands) {
            return $this->cluster_bands;
        }
        return array();
    }

    function set_cluster_bands(array $bands)
    {
        foreach ($bands as $band) {
            if (!in_array($band, $this->allowed_bands)) {
                throw new Exception($band . " is not a valid band");
            }
        }
        $json_bands = json_encode($bands);
        if (!isset($json_bands[0])) {
            $json_bands = null;
        }
        $querystring = "UPDATE settings SET cluster_bands = ? WHERE log_nr=?";
        $query = $this->dbobj->prepare($querystring);
        $query->bind_param("si", $json_bands, $this->log_nr);
        $query->execute();
        $this->update_cluster_bands();
    }

    private function update_cluster_bands()
    {
        $query = sprintf("SELECT cluster_bands FROM settings WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->cluster_bands = json_decode($result->fetch_object()->cluster_bands);
    }

    function get_cluster_modes()
    {
        if ($this->cluster_modes) {
            return $this->cluster_modes;
        } else {
            return array();
        }
    }

    function set_cluster_modes(array $modes)
    {
        foreach ($modes as $mode) {
            if (!in_array($mode, ["CW", "SSB", "RTTY"])) {
                throw new Exception($mode . " is not a valid mode");
            }
        }
        $json_modes = json_encode($modes);
        if (!isset($json_modes[0])) {
            $json_modes = null;
        }
        $querystring = "UPDATE settings SET cluster_modes = ? WHERE log_nr=?";
        $query = $this->dbobj->prepare($querystring);
        $query->bind_param("si", $json_modes, $this->log_nr);
        $query->execute();
        $this->update_cluster_modes();
    }

    private function update_cluster_modes()
    {
        $query = sprintf("SELECT cluster_modes FROM settings WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        $this->cluster_modes = json_decode($result->fetch_object()->cluster_modes);
    }


    function get_cluster_skimmer_mode()
    {
        return $this->cluster_skimmer_mode;
    }

    function set_cluster_skimmer_mode(int $cluster_skimmer_mode)
    {
        if ($cluster_skimmer_mode > 3 || $cluster_skimmer_mode < 0) {
            throw new Exception("invalid cluster mode");
        }
        $query = $this->dbobj->prepare("UPDATE settings SET cluster_skimmer_mode = ? WHERE log_nr = ?");
        $query->bind_param("ii", $cluster_skimmer_mode, $this->log_nr);
        $query->execute();
        $result = $query->get_result();
        return $result;
    }

    function disable_skimmer()
    {
        $this->set_cluster_skimmer_mode(0);
    }
    function get_pubqslr_enabled()
    {
        return $this->pubqslr_enable;
    }

    function enable_pubqslr()
    {
        $query = sprintf("UPDATE settings SET enable_pubqslr = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function disable_pubqslr()
    {
        $query = sprintf("UPDATE settings SET enable_pubqslr = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }


    function get_pubqsls_enabled()
    {
        return $this->pubqsls_enable;
    }

    function enable_pubqsls()
    {
        $query = sprintf("UPDATE settings SET enable_pubqsls = '1' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }

    function disable_pubqsls()
    {
        $query = sprintf("UPDATE settings SET enable_pubqsls = '0' WHERE log_nr='%u'", $this->log_nr);
        $result = $this->dbobj->query($query);
        return $result;
    }
}
