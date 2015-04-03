<?php

date_default_timezone_set("UTC");
$datum=date("Y-m-d",time());
$time_on=date("H:i",time());

$where=" WHERE id_cqrlog_main>0";

if (empty($pubsearch))
{
if (!empty($call))
{
	$where .= " AND callsign like '" . $call . "'";
}

if (!empty($dxcc))
{
	$where .= " AND dxcc_ref='" . $dxcc . "'";	
}

if (!empty($mode))
{
	$where .= " AND mode='" .$mode ."'";
}

if (!empty($remarks))
{
	$where .= " AND remarks like '" . $remarks . "'";
}

if (!empty($band)) {
if ($band!="select"){
	$where .= " AND band='" . $band . "'";
}
}

if (!empty($name))
{
	$where .= " AND name like '" . $name . "'";
}

if (!empty($locator))
{
	$where .= " AND loc like '" . $locator . "'";
}
}
else
{
		
if (!empty($call))
{
	$where .= " AND callsign ='" . $call . "'";
}
}
?>
