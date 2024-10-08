<div class="table-responsive" id=qso>
    <table align="center" class="table table-condensed table-hover" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="100px">Date</th>
                <th width="50px">Time</th>
                <th style="text-align:center" width="40px">Band</th>
                <th style="text-align:center" width="150px">Call sign</th>
                <th style="text-align:center" width="100px">Mode</th>
                <th class="hidden-xs" width="90px">RST Sent</th>
                <th class="hidden-xs" width="90px">RST Rcvd</th>
                <th class="hidden-xs" width="100px">Name</th>
                <?php if ($Userconfig->get_pubqslr_enabled()) {
                    echo '<th class="hidden-xs" width="100px">QSL Rcvd</th>' . "\n";
                }
                if ($Userconfig->get_pubqsls_enabled()) {
                    echo '<th class="hidden-xs" width="100px">QSL Sent</th>' . "\n";
                } ?>
        </thead>
        </tr>
        <?php
        $qso_count = mysqli_real_escape_string($dbconnect, $qso_count);
        $qsotable = $Logbook->get_log($qso_count, $where);
        foreach ($qsotable as $qso) {
            if ($Userconfig->get_pubqslr_enabled()) {
                switch ($qso->get_qsl_r()) {
                    case 'Q':
                        $qsl_r = $qso->get_qslr_date();
                        break;
                    case '':
                    default:
                        $qsl_r = '';
                        break;
                }
            }

            if ($Userconfig->get_pubqsls_enabled()) {
                switch ($qso->get_qsl_s()) {
                    case 'B':
                        $qsl_s =  $qso->get_qsls_date() . ' via Bureau';
                        break;
                    case 'MB':
                        $qsl_s = $qso->get_qsls_date() . ' via Bureau';
                        break;
                    case 'D':
                        $qsl_s = $qso->get_qsls_date() . ' via Direct';
                        break;
                    case 'MD':
                        $qsl_s = $qso->get_qsls_date() . ' via Direct';
                        break;
                    case 'SB':
                        $qsl_s = '';
                        break;


                    case '':
                    default:
                        $qsl_s = '';
                        break;
                }
            }
            echo '<tr>' . "\n";
            echo (sprintf("<td>%s</td>\n", $qso->get_qsodate()));
            echo (sprintf("<td>%s</td>\n", $qso->get_time_on()));
            echo (sprintf("<td align=\"center\">%s</td>\n", $qso->get_band()));
            echo (sprintf("<td align=\"center\"><font color=\"red\"><b>%s</b></font></td>\n", $qso->get_callsign()));
            echo (sprintf("<td align=\"center\"><i>%s </i></td>\n", $qso->get_mode()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_rst_s()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_rst_r()));
            echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qso->get_name()));
            if ($Userconfig->get_pubqslr_enabled()) {
                echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qsl_r));
            }
            if ($Userconfig->get_pubqsls_enabled()) {
                echo (sprintf("<td class=\"hidden-xs\">%s</td>\n", $qsl_s));
            }
            echo '</tr>' . "\n";
        }
        ?>
    </table>