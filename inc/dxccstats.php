<div class="table-responsive">
    <table class="table table-hover table-condensed" align="center" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="30px">DXCC</th>
                <?php
                echo '<th width="160px"><div class="hidden-xs">Name / Mode</div></th>' . "\n";

                $i = 0;
                $bands = $Logbook->get_active_bands();
                foreach ($bands as $band_in) {
                    echo '<th style="text-align:center" width="30px">' . $band_in . '</th>' . "\n";
                }
                ?>
        </thead>
        </tr>
        <?php

        $dbconnect->select_db("cqrlog_common");
        $query = mysqli_query($dbconnect, 'SELECT distinct adif,pref,name from dxcc_ref ' . $wheredxcc);
        while ($row = mysqli_fetch_object($query)) {
            $dxcc = $row->pref;
            $name = $row->name;
            $adif = $row->adif;
            echo '<tr>' . "\n";
            echo '<td>' . $dxcc . '</td>' . "\n";

            echo '<td><div class="hidden-xs">' . $name . '</div></td>' . "\n";

            foreach ($bands as $band_in) {
                $checkadif = check_adif($adif, $log_id, $band_in, 'ALL', $paperqsl, $lotwqsl, $eqslqsl);
                if ($checkadif[0] == "N") {
                    echo  '<td style="text-align:center">' . $band_in . $checkadif[2] . "\n";
                } else {
                    echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
                }
            }


            foreach ($mode as $mode_proc) {
                echo '<tr>' . "\n";
                echo '<td></td>' . "\n";
                echo '<td align="right">' . $mode_proc . '</td>' . "\n";

                foreach ($bands as $band_in) {
                    $checkadif = check_adif($adif, $log_id, $band_in, $mode_proc, $paperqsl, $lotwqsl, $eqslqsl);
                    echo  $checkadif[1] . $band_in . $checkadif[2] . "\n";
                }
                echo '</tr>' . "\n";
            }
        }
        echo '</table></div>' . "\n";
        if (empty($call)) {
            echo '<div class="table-responsive">' . "\n";
            echo '<table class="table table-condensed" align="center" cellpadding="0" cellspacing="0">' . "\n";
            echo '<tr><th> DXCC Count</th>' . "\n";

            foreach ((array) $bands as $band_in) {
                echo '<th style="text-align:center" >' . $band_in . '</th>' . "\n";
            }
            echo '<th style="text-align:center" >Allband Count</th>' . "\n";
            echo '</tr>' . "\n";

            array_unshift($mode, 'ALL');
            foreach ($mode as $mode_proc) {

                echo '<tr>' . "\n";
                echo '<td align="right">' . $mode_proc . ' confirmed</td>' . "\n";
                foreach ($bands as $band_in) {
                    echo '<td align="center" class="success">' . count_dxcc($log_id, $band_in, $mode_proc, $paperqsl, $lotwqsl, $eqslqsl) . '</td>' . "\n";
                }
                echo '<td align="center" class="success">' . count_dxcc($log_id, "ALL", $mode_proc, $paperqsl, $lotwqsl, $eqslqsl) . '</td>' . "\n";
                echo '</tr>' . "\n";


                echo '<tr>' . "\n";
                echo '<td align="right">' . $mode_proc . ' worked</td>' . "\n";
                foreach ($bands as $band_in) {
                    echo  '<td align="center" class="danger">' . count_dxcc($log_id, $band_in, $mode_proc, false, false, false) . '</td>' . "\n";
                }
                echo  '<td align="center" class="danger">' . count_dxcc($log_id, "ALL", $mode_proc, false, false, false) . '</td>' . "\n";
                echo '</tr>' . "\n";
            }
        }
        echo '</table></div>' . "\n";
        ?>