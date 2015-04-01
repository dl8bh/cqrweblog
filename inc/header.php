<?php
include("inc/db.php");
include("inc/include.php");

if (isset($_GET['log_id'])){
$log_id = filter_input(INPUT_GET, 'log_id', FILTER_VALIDATE_INT);
if (!is_int($log_id))
		{
				$log_id=$defaultlog;
		}
if (!logid_to_call($log_id))
		{
				$log_id=$defaultlog;
		}

}
else
{
	$log_id=$defaultlog;
}
if (isset($_GET['qso_count'])){
$qso_count = htmlentities($_GET['qso_count']);
}
else
{
	$qso_count=$defaultcount;
}
?>
