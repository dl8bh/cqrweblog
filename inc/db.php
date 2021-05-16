<?php
$dbconnect = mysqli_connect($hostname, $dbuser, $dbpass, $db, $port);
if(!$dbconnect)
{
  exit("verbindungsfehler: ".mysqli_connect_error());
}

class DbSpawner {
    /* spawns mysqli-objects for classes */
    private $hostname;
    private $dbuser;
    private $dbpass;
    private $dbname;
    private $dbport;

    function __construct($hostname, $dbuser, $dbpass, $dbname, $dbport){
        $this->hostname = $hostname;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbport = $dbport;
        $this->dbname = $dbname;
    }

    function newdb() {
        return new mysqli($this->hostname, $this->dbuser, $this->dbpass, $this->dbname, $this->dbport);
    }
}

$DbSpawner = new DbSpawner($hostname, $dbuser, $dbpass, $db, $port);

?>
