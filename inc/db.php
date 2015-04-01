<?php
include("config.php");
$dbconnect = mysqli_connect($hostname, $dbuser, $dbpass, $db);
if(!$dbconnect)
{
  exit("verbindungsfehler: ".mysqli_connect_error());
}


?>
