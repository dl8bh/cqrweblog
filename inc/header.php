<?php

include("inc/include.php");
include("inc/cqrlog_common.php");
include("inc/checkdxcc.php");
$Cqrlog_common = new Cqrlog_common($DbSpawner->newdb());
$Checkdxcc = new Checkdxcc("https://api.dl8bh.de/lookup/json/");
$hamqthtimeout = FALSE;
include("inc/userconfig.php");
if (isset($_GET['log_id'])){
$log_id = filter_input(INPUT_GET, 'log_id', FILTER_VALIDATE_INT);
if (!is_int($log_id))
		{
				$log_id=$defaultlog;
		}
if (!$Cqrlog_common->logid_to_call($log_id))
		{
				$log_id=$defaultlog;
		}

}
else
{
	$log_id=$defaultlog;
}
$Userconfig = new Userconfig($DbSpawner->newdb(), $log_id, FALSE);
if (isset($_GET['qso_count'])){
$qso_count = filter_input(INPUT_GET, 'qso_count', FILTER_VALIDATE_INT);
if (!is_int($qso_count))
{
		 $qso_count=$defaultcount;
}
}
else
{
	$qso_count=$defaultcount;
}


if (isset($_GET['qso_id'])){
$qso_id = filter_input(INPUT_GET, 'qso_id', FILTER_VALIDATE_INT);
}

?>
