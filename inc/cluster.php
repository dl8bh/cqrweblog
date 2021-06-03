<div id="cluster" class="table-responsive">
    <?php
    include("./inc/cluster_class.php");
    $cluster = new dxcccluster("https://api.dl8bh.de/cluster/");
    if (isset($band)) {
        $spots = $cluster->get_cluster_spots($cluster_spot_num, array(
            "bands" => array($band),
            "modes" => $Userconfig->get_cluster_modes(),
            "skimmer_mode" => $Userconfig->get_cluster_skimmer_mode()
        ));
    } else {
        $spots = $cluster->get_cluster_spots($cluster_spot_num, array(
            "bands" => $Userconfig->get_cluster_bands(),
            "modes" => $Userconfig->get_cluster_modes(),
            "skimmer_mode" => $Userconfig->get_cluster_skimmer_mode()
        ));
    }
    $out  = "";
    echo '<table class="table table-hover borderless table-condensed" align="center" >' . "\n";
    $checkadif = $Logbook->get_stats(0, array("paper" => TRUE, "lotw" => TRUE, "eqsl" => FALSE));
    foreach ($spots as $key => $spot) {

        $dxmessage = '';
        $clusterbandmode = $Cqrlog_common->freq_to_band_mode($spot["qrg"] / 1000);
        $qsoarray = array(
            "callsign" => $spot["dx_call"],
            "band" => $clusterbandmode[0],
            "mode" => $clusterbandmode[1]
        );
        $band = $clusterbandmode[0];
        $mode = $clusterbandmode[1];
        $qso = new Qso($qsoarray);
        if ($spot["adif"] == 0) {
            $fontcolor = $dupecolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">INVALID DXCC</font></b>';
        } elseif ($Logbook->check_dupe($qso)) {
            $fontcolor = $dupecolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">DUPE</font></b>';
        } elseif (!isset($checkadif[$spot["adif"]])) {
            $fontcolor = $atnocolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">NEW ONE</font></b>';
        } elseif (!isset($checkadif[$spot["adif"]][$band][$mode])) {
            if (!isset($checkadif[$spot["adif"]][$band])) {
                $fontcolor = $newbandcolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW BAND</font></b>';
            } elseif (!isset($checkadif[$spot["adif"]][$mode])) {
                $fontcolor = $newmodecolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW MODE</font></b>';
            }
        } else {
            switch ($checkadif[$spot["adif"]][$band][$mode]) {
                case "C":
                    $fontcolor = $confirmedcolor;
                    break;
                case "W":
                    $fontcolor = $workedcolor;
                    break;
            }
        }



        $out .= '<tr class="small">';
        $out .= '<td class="hidden-xs">' . $dxmessage . '</td>	' . "\n";
        $out .= '<td class="hidden-xs">DX de ' . $spot["de_call"] . ':</td>' . "\n";
        $out .= '<td>' . number_format($spot["qrg"], 1, ".", "") . '</td>' . "\n";
        $out .=    '<td><a href="javascript:fillClusterData(\'' . $spot["dx_call"] . '\',\'' . $spot["qrg"] . '\',\'' . $clusterbandmode[1] . '\');" style="color:' . $fontcolor . '; font-weight: bold;">' . $spot["dx_call"] . '</a></td>' . "\n";
        $out .= '<td>' . $spot["comment"] . '</td>' . "\n";
        $out .= '<td>' . $spot["timestamp"] . '</td>' . "\n";
        $out .= "</tr>" . "\n";
    }
    $out .= "</table>";

    echo $out;
    ?>
</div>