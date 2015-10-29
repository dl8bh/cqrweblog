<div id="cluster" >
<?php

if (isset($band)) {
		$spots=get_cluster_spots($cluster_spot_num, $band);
}
else {
		$spots=get_cluster_spots($cluster_spot_num, "ALL");
}
$out  = "";
echo '<table class="cluster" align="center" >' . "\n";

foreach($spots as $key => $qso){
		$dxmessage='';
		$clusterbandmode = freq_to_band_mode($qso[1]/1000);
		$checkadif = check_adif($qso[10], $log_id, $clusterbandmode[0], $clusterbandmode[1]);
    switch ($checkadif[0]) {
				case "N":
				  // ATNO
					$checkadif = check_adif($qso[10], $log_id);
					if ($checkadif[0]=="N") {
							$fontcolor=$atnocolor;
							$dxmessage='<b><font color="' . $fontcolor . '">NEW ONE</font></b>';
							break;
					}
					else {
							$checkadif = check_adif($qso[10], $log_id, $clusterbandmode[0]);
							if ($checkadif[0]!="N") {
									$fontcolor=$newmodecolor;
									$dxmessage='<b><font color="' . $fontcolor . '">NEW MODE</font></b>';
									break;
							}
							else {
									$fontcolor=$newbandcolor;
									$dxmessage='<b><font color="' . $fontcolor . '">NEW BAND</font></b>';
							}
					}
					break;
				case "C":
					$fontcolor=$confirmedcolor;
					break;
				case "W":
					$fontcolor=$workedcolor;
					break;
				default:
		}
		$out .= "<tr>";
		$out .= '<td>' . $dxmessage . '</td>	' ."\n";
		$out .= '<td>DX de ' . $qso[0] . ':</td>' . "\n";
		$out .= '<td>' . $qso[1] . '</td>' . "\n";
		$out .=	'<td><a href=javascript:fillClusterData("' . $qso[2] . '","' . $qso[1] . '","' . $clusterbandmode[1] . '"); style="color:' . $fontcolor . '; font-weight: bold;">' . $qso[2] . '</a></td>' . "\n";
		$out .= '<td>' . $qso[3] . '</td>' . "\n";
		$out .= '<td>' . $qso[4] . '</td>' . "\n";
		foreach($qso as $subkey => $detail){
				
    }
    $out .= "</tr>"."\n";
}
$out .= "</table>";

echo $out;
?>
</div>
</tr>

