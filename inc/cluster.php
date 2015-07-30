<div id="cluster">
<?php
//include("inc/include.php");

if (isset($band)) {
		$spots=get_cluster_spots($cluster_spot_num, $band);
}
else {
		$spots=get_cluster_spots($cluster_spot_num, "ALL");
}
$out  = "";
echo '<table class="cluster" align="center" >' . "\n";

foreach($spots as $key => $qso){

		//$checkadif = check_adif($qso[10], $log_id, freq_to_band($qso[1]/1000), "ALL", "1", "1", "1");
		$checkadif = check_adif($qso[10], $log_id, freq_to_band($qso[1]/1000));
    switch ($checkadif[0]) {
				case "N":
					$fontcolor='red';
					break;
				case "C":
					$fontcolor='black';
					break;
				case "W":
					$fontcolor='green';
					break;
				default:
					$fontcolor='green';
		}
		$out .= "<tr>";
		
		$out .= '<td>DX de ' . $qso[0] . ':</td>' . "\n";
		$out .= '<td>' . $qso[1] . '</td>' . "\n";
		$out .=	'<td><a href=javascript:fillClusterData("' . $qso[2] . '","' . $qso[1] . '"); style="color:' . $fontcolor     .'">' . $qso[2] . '</a></td>' . "\n";
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

