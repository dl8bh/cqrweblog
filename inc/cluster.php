<div id="cluster" class="table-responsive">
    <?php

    if (isset($band)) {
        $spots = get_cluster_spots($cluster_spot_num, $band);
    } else {
        $spots = get_cluster_spots($cluster_spot_num, "ALL");
    }
    $out  = "";
    echo '<table class="table table-hover borderless table-condensed" align="center" >' . "\n";

    foreach ($spots as $key => $qso) {
        $dxmessage = '';
        $clusterbandmode = $Cqrlog_common->freq_to_band_mode($qso[1] / 1000);
        $checkadif = $Logbook->get_stats($qso[10], array());
        $qsoarray = array(
            "callsign" => $qso[2],
            "band" => $clusterbandmode[0],
            "mode" => $clusterbandmode[1]
        );
        $band = $clusterbandmode[0];
        $mode = $clusterbandmode[1];
        $qsoobject = new Qso($qsoarray);
        if ($Logbook->check_dupe($qsoobject)) {
            $fontcolor = $dupecolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">DUPE</font></b>';
        } elseif (!isset($checkadif[$qso[10]])) {
            $fontcolor = $atnocolor;
            $dxmessage = '<b><font color="' . $fontcolor . '">NEW ONE</font></b>';
        } elseif (!isset($checkadif[$qso[10]][$band][$mode])) {
            if (!isset($checkadif[$qso[10]][$band])) {
                $fontcolor = $newbandcolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW BAND</font></b>';
            } elseif (!isset($checkadif[$qso[10]][$mode])) {
                $fontcolor = $newmodecolor;
                $dxmessage = '<b><font color="' . $fontcolor . '">NEW MODE</font></b>';
            }
        } else {
            switch ($checkadif[$qso[10]][$band][$mode]) {
                case "C":
                    $fontcolor = $confirmedcolor;
                case "W":
                    $fontcolor = $workedcolor;
            }
        }

 
        
        $out .= '<tr class="small">';
        $out .= '<td class="hidden-xs">' . $dxmessage . '</td>	' . "\n";
        $out .= '<td class="hidden-xs">DX de ' . $qso[0] . ':</td>' . "\n";
        $out .= '<td>' . $qso[1] . '</td>' . "\n";
        $out .=    '<td><a href="javascript:fillClusterData(\'' . $qso[2] . '\',\'' . $qso[1] . '\',\'' . $clusterbandmode[1] . '\');" style="color:' . $fontcolor . '; font-weight: bold;">' . $qso[2] . '</a></td>' . "\n";
        $out .= '<td>' . $qso[3] . '</td>' . "\n";
        $out .= '<td>' . $qso[4] . '</td>' . "\n";
        $out .= "</tr>" . "\n";
    }
    $out .= "</table>";

    echo $out;
    ?>
</div>