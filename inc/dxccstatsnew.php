<div class="table-responsive table-condensed">
<table class="table table-condensed" align="center" cellpadding="0" cellspacing="0">
<tr>
<th bgcolor="grey" width="100px">DXCC</th>
<th bgcolor="grey" width="350px">Name / Mode</th>

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
	echo '<td bgcolor="#E6E6E6"><font size=+1>' . $dxcc . '</font></td>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1>' . $name . '</font></td>' . "\n";

	foreach($bands as $band_in)
	{
	echo '<td align="center" bgcolor="#E6E6E6">' . $band_in . '</td>' . "\n";
	}


foreach($mode as $mode_proc){
	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . '</font></td>' . "\n";
	
	foreach($bands as $band_in)
	{
	$checkadif = check_adif ( $adif, $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl);
	if ($checkadif[0] == 'N')
	{
			$checkadif[0] ="";
	}
	echo  $checkadif[1] . $checkadif[0] . $checkadif[2] . "\n";
//	echo  check_adif ( $adif, $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . "\n";
	}
	echo '</tr>' . "\n";	
	}	
}
echo '</table></div>' . "\n";


if (empty($call)) {
	echo '<div class="table-responsive">' . "\n";
  echo '<table class="table" align="center" cellpadding="0" cellspacing="0">' . "\n" ;
	echo '<tr>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1>DXCC Count</font></td>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1></font></td>' . "\n";

	foreach($bands as $band_in)
	{
	echo '<td align="center" bgcolor="#E6E6E6">' . $band_in . '</td>' . "\n";
	}
	echo '<td align="center" bgcolor="#E6E6E6">Allband Count</td>' . "\n";
	echo '</tr>' . "\n";	

foreach($mode as $mode_proc){

	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' confirmed</font></td>' . "\n";
	foreach($bands as $band_in)
	{
	echo '<td align="center" bgcolor="#40FF00">' . count_dxcc ( $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	}
	echo '<td align="center" bgcolor="#40FF00">' . count_dxcc ( $log_id, "ALL", $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	echo '</tr>' . "\n";


	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' worked</font></td>' . "\n";
	foreach($bands as $band_in)
	{
	echo  '<td align="center" bgcolor="Red">' . count_dxcc (  $log_id, $band_in, $mode_proc,false,false,false) . '</td>' . "\n";
	}
	echo  '<td align="center" bgcolor="Red">' . count_dxcc (  $log_id, "ALL", $mode_proc,false,false,false) . '</td>' . "\n";
	echo '</tr>' . "\n";	
}
}
?>
</table>
</div>
