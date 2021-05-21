<div class="table-responsive" id="qso">
    <table id=qsotable class="table table-condensed table-hover" align="center" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="100px">Date</th>
                <th width="50px">Time</th>
                <th style="text-align:center" width="40px">Band</th>
                <th style="text-align:center" width="150px">Call sign</th>
                <th style="text-align:center" width="100px">Mode</th>
                <th class="hidden-xs" width="100px">RST Sent</th>
                <th class="hidden-xs" width="100px">RST Rcvd</th>
                <th class="hidden-xs" width="200px">Name</th>
                <th class="hidden-xs" width="450px">Remarks</th>
                <th width="40px">Edit</th>
            </tr>
        </thead>
        <?php
        $qso_count = mysqli_real_escape_string($dbconnect, $qso_count);
        $qsotable = $Logbook->get_log($qso_count, $where);
        foreach ($qsotable as $qso) {
            echo '<tr>' . "\n";
            echo (sprintf("<td>%s</td>\n", $qso->get_qsodate()));
            echo (sprintf("<td>%s</td>\n", $qso->get_time_on()));
            echo (sprintf("<td align=\"center\">%s</td>\n", $qso->get_band()));
            echo (sprintf("<td align=\"center\"><font color=\"red\"><b>%s</b></font></td>\n", $qso->get_callsign()));
            echo (sprintf("<td align=\"center\"><i>%s </i></td>\n", $qso->get_mode()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_rst_s()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_rst_r()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_name()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_remarks()));
            echo (sprintf("<td><a href=\"edit.php?log_id=%u&qso_id=%u\" target=\"_blank\">Edit</a></td>\n", $log_id, $qso->get_id_cqrlog_main()));
            echo '</tr>' . "\n";
        }

        ?>
    </table>
</div>