<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<th bgcolor="grey" width="100px">DXCC</th>
<td width="15" bgcolor="grey"></td><td bgcolor="Black" width="1px"></td><td width="15" bgcolor="grey"></td>
<th bgcolor="grey" width="350px">Name / Mode</th>
<!--<td width="15" bgcolor="grey"></td><td bgcolor="Black" width="1px"></td><td width="15px" bgcolor="grey"></td>-->

<?php
	$i=0;
	$dbconnect -> select_db("cqrlog_common");
	$ergebnis = mysqli_query($dbconnect, 'SELECT DISTINCT t1.band from cqrlog_common.bands t1 join ' . logid_to_tableid( $log_id ) . '.cqrlog_main t2 on t1.band = t2.band order by t1.b_begin asc');
	while (	$band = mysqli_fetch_object($ergebnis))
	{
	$bands[] = $band->band;
	}
	foreach((array) $bands as $band_in)
	{
	echo '<td width="15" bgcolor="grey"></td><td bgcolor="Black" width="1px"></td><td width="15" bgcolor="grey"></td>' . "\n";
	echo '<th bgcolor="grey" width="30px">' . $band_in . '</th>' . "\n";
	}
	echo '<td width="15" bgcolor="grey"></td><td bgcolor="Black" width="1px"></td>' . "\n";
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
	echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1>' . $name . '</font></td>' . "\n";

	foreach((array) $bands as $band_in)
	{
	$checkadif = check_adif ( $adif, $log_id, $band_in, 'ALL',$paperqsl,$lotwqsl,$eqslqsl);
echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";
	//echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	if ($checkadif[0]=="N")
	{
			echo  '<td bgcolor="#E6E6E6">' . $band_in . $checkadif[2] . "\n";
	}
	else
	{
			echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
	}
	}

  echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";

foreach($mode as $mode_proc){
	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . '</font></td>' . "\n";
	
	foreach((array) $bands as $band_in)
	{
	$checkadif = check_adif ( $adif, $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl);
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
	}
  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '</tr>' . "\n";	
	}	
}
if (empty($call)){
	echo '<tr>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1>DXCC Count</font></td>' . "\n";
	echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";
	echo '<td bgcolor="#E6E6E6"><font size=+1></font></td>' . "\n";

	foreach((array) $bands as $band_in)
	{
  echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";
	echo '<td align="center" bgcolor="#E6E6E6">' . $band_in . '</td>' . "\n";
	}
  echo '<td bgcolor="#E6E6E6"></td><td bgcolor="Black" width="0.3px"></td><td bgcolor="#E6E6E6"></td>' . "\n";
	echo '<td align="center" bgcolor="#E6E6E6">Allband Count</td>' . "\n";
	echo '</tr>' . "\n";	

array_unshift($mode, 'ALL');
foreach($mode as $mode_proc){

	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' confirmed</font></td>' . "\n";
	foreach((array) $bands as $band_in)
	{
  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '<td align="center" bgcolor="#40FF00">' . count_dxcc ( $log_id, $band_in, $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	}
  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '<td align="center" bgcolor="#40FF00">' . count_dxcc ( $log_id, "ALL", $mode_proc,$paperqsl,$lotwqsl,$eqslqsl) . '</td>' . "\n";
	echo '</tr>' . "\n";


	echo '<tr>' . "\n";
	echo '<td></td>' . "\n";
	echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo '<td align="right"><font size=+1>' . $mode_proc . ' worked</font></td>' . "\n";
	foreach((array) $bands as $band_in)
	{
  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo  '<td align="center" bgcolor="Red">' . count_dxcc (  $log_id, $band_in, $mode_proc,false,false,false) . '</td>' . "\n";
	}
  echo '<td></td><td bgcolor="Black" width="0.3px"></td><td></td>' . "\n";
	echo  '<td align="center" bgcolor="Red">' . count_dxcc (  $log_id, "ALL", $mode_proc,false,false,false) . '</td>' . "\n";
	echo '</tr>' . "\n";	
}
}
?>

