<?php
$dbconnect = mysqli_connect($hostname, $dbuser, $dbpass, $db, $port);
$dbobj = new mysqli($hostname, $dbuser, $dbpass, $db, $port);
if(!$dbconnect)
{
  exit("verbindungsfehler: ".mysqli_connect_error());
}


?>
