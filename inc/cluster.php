<div id="cluster" class="table-responsive">
    <?php

    if (isset($band)) {
        $spots = get_cluster_spots($cluster_spot_num, $band);
    } else {
        $spots = get_cluster_spots($cluster_spot_num, "ALL");
    }
    $out  = "";
    echo '<table class="table table-hover borderless table-condensed" align="center" >' . "\n";

    foreach ($spots as $key => $spot) {
        $dxmessage = '';
        $clusterbandmode = $Cqrlog_common->freq_to_band_mode($spot[1] / 1000);
        $checkadif = $Logbook->get_stats($spot[10], array("paper" => TRUE, "lotw" => TRUE, "eqsl" => FALSE));
        $qsoarray = array(
            "callsign" => $spot[2],
            "band" => $clusterbandmode[0],
            "mode" => $clusterbandmode[1]
        );
        $band = $clusterbandmode[0];
        $mode = $clusterbandmode[1];
        $qso = new Qso($qsoarray);
        if ($Logbook->check_dupe($qso)) {
            $fontcolor = $dupecolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">DUPE</font></b>';
        } elseif (!isset($checkadif[$spot[10]])) {
            $fontcolor = $atnocolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">NEW ONE</font></b>';
        } elseif (!isset($checkadif[$spot[10]][$band][$mode])) {
            if (!isset($checkadif[$spot[10]][$band])) {
                $fontcolor = $newbandcolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW BAND</font></b>';
            } elseif (!isset($checkadif[$spot[10]][$mode])) {
                $fontcolor = $newmodecolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW MODE</font></b>';
            }
        } else {
            switch ($checkadif[$spot[10]][$band][$mode]) {
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
        $out .= '<td class="hidden-xs">DX de ' . $spot[0] . ':</td>' . "\n";
        $out .= '<td>' . $spot[1] . '</td>' . "\n";
        $out .=    '<td><a href="javascript:fillClusterData(\'' . $spot[2] . '\',\'' . $spot[1] . '\',\'' . $clusterbandmode[1] . '\');" style="color:' . $fontcolor . '; font-weight: bold;">' . $spot[2] . '</a></td>' . "\n";
        $out .= '<td>' . $spot[3] . '</td>' . "\n";
        $out .= '<td>' . $spot[4] . '</td>' . "\n";
        $out .= "</tr>" . "\n";
    }
    $out .= "</table>";

    echo $out;
    ?>
</div>