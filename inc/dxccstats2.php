<div class="table-responsive">
<table class="table table-hover table-condensed" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<th bgcolor="grey" width="30px">DXCC</th>
<!--<th bgcolor="grey" >DXCC</th>-->
<th bgcolor="grey" width="200px">Name / Mode</th>

<?php
	$i=0;
	$dbconnect -> select_db("cqrlog_common");
	$ergebnis = mysqli_query($dbconnect, 'SELECT DISTINCT t1.band from cqrlog_common.bands t1 join ' . logid_to_tableid( $log_id ) . '.cqrlog_main t2 on t1.band = t2.band order by t1.b_begin asc');
	while (	$band = mysqli_fetch_object($ergebnis))
	{
	$bands[] = $band->band;
	}
	foreach($bands as $band_in)
	{
	echo '<th bgcolor="grey" width="30px">' . $band_in . '</th>' . "\n";
	}
?>
</tr>
<?php

$dbconnect -> select_db("cqrlog_common");
$query = mysqli_query($dbconnect, 'SELECT distinct adif,pref,name from dxcc_ref ' . $wheredxcc );
while($row = mysqli_fetch_object($query)){
	$dxcc= $row->pref;
	$name= $row->name;
	$adif= $row->adif;
	echo '<tr>' . "\n";
	echo '<td>' . $dxcc . '</td>' . "\n";
	echo '<td>' . $name . '</td>' . "\n";

	foreach($bands as $band_in)
	{
	$checkadif = check_adif ( $adif, $log_id, $band_in, 'ALL',$paperqsl,$lotwqsl,$eqslqsl);
	if ($checkadif[0]=="N")
	{
			echo  '<td>' . $band_in . $checkadif[2] . "\n";
	}
	else
	{
			echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
	}
	}


foreach($mode as $mode_proc){
	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . '</font></td>' . "\n";
	
	foreach($bands as $band_in)
	{
	$checkadif = check_adif ( $adif, $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl);
	echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
	}
	echo '</tr>' . "\n";	
	}	
}
echo '</table></div>' . "\n";
if (empty($call)){
		echo '<div class="table-responsive">' . "\n";
		echo '<table class="table" align="center" cellpadding="0" cellspacing="0">' . "\n" ;
//	echo '<tr>' . "\n";
	echo '<td bgcolor="grey" ><font size=+1>DXCC Count</font></td>' . "\n";
//	echo '<td ><font size=+1></font></td>' . "\n";

	foreach($bands as $band_in)
	{
	echo '<td align="center" bgcolor="grey">' . $band_in . '</td>' . "\n";
	}
	echo '<td align="center" bgcolor="grey">Allband Count</td>' . "\n";
	echo '</tr>' . "\n";	

array_unshift($mode, 'ALL');
foreach($mode as $mode_proc){

	echo '<tr>' . "\n";
//	echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' confirmed</font></td>' . "\n";
	foreach($bands as $band_in)
	{
	echo '<td align="center" class="success">' . count_dxcc ( $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	}
	echo '<td align="center" class="success">' . count_dxcc ( $log_id, "ALL", $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	echo '</tr>' . "\n";


	echo '<tr>' . "\n";
	//echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' worked</font></td>' . "\n";
	foreach($bands as $band_in)
	{
	echo  '<td align="center" class="danger">' . count_dxcc (  $log_id, $band_in, $mode_proc,false,false,false) . '</td>' . "\n";
	}
	echo  '<td align="center" class="danger">' . count_dxcc (  $log_id, "ALL", $mode_proc,false,false,false) . '</td>' . "\n";
	echo '</tr>' . "\n";	
}
}
echo '</table></div>' . "\n";
?>

