<?php

date_default_timezone_set("UTC");
$datum=date("Y-m-d",time());
$time_on=date("H:i",time());

$where=array();
$where_export=" WHERE t1.id_cqrlog_main>0";

if (empty($pubsearch))
{
if (!empty($call))
{
    $where["callsign"] = $call;
	$where_export .= " AND t1.callsign like '" . $call . "'";
}

if (!empty($dxcc))
{
	$where["dxcc_ref"] = $dxcc;	
	$where_export .= " AND t1.dxcc_ref='" . $dxcc . "'";	
}

if (!empty($mode))
{
	$where["mode"] = $mode;
	$where_export .= " AND t1.mode='" .$mode ."'";

}

if (!empty($remarks))
{
	$where ["remarks"] = $remarks;
	$where_export .= " AND t1.remarks like '" . $remarks . "'";
}

if (!empty($band)) {
if ($band!="select"){
	$where["band"] = $band;
	$where_export .= " AND t1.band='" . $band . "'";
}
}

if (!empty($name))
{
	$where["name"] = $name;
	$where_export .= " AND t1.name like '" . $name . "'";
}

if (!empty($locator))
{
	$where["locator"] = $locator;
	$where_export .= " AND t1.loc like '" . $locator . "'";
}
}
else
{
		
if (!empty($call))
{
	$where["callsign"] = $call;
	$where_export .= " AND t1.callsign ='" . $call . "'";
}
}
?>
