<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_log.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    $logactive = true;
    include("inc/logbook.php");
    $Logbook = new Logbook($DbSpawner->newdb(), $log_id);
    $where = array();
    echo '<title>' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . ' \'s Logbook</title>';
    include("inc/metaheader.php");
    ?>
</head>

<body style="overflow:auto;">
    <div id="root">
        <?php
        include("inc/navbar.php");
        echo '<div id="head">' . "\n";
        echo '<h1 align="center">Logbook of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</h1><div class="hidden-xs hidden-sm"><br /><br /></div>';
        echo '</div>' . "\n";
        if ($Userconfig->get_cluster_enabled() && $hamqth_api && !($hamqthtimeout)) {
            include("inc/cluster.php");
        }
        echo '<div class="hidden-xs hidden-sm"><br /><br /></div>';
        include("inc/log_input.php");
        ?>
        <div class="col-xs-*">
            <br />
        </div>
        <?php
        include("inc/log_proc.php");


        $qso_amount = $Logbook->count_qsos();
        switch ($qso_amount) {
            case 0:
                echo '<div class=" hidden-xs col-md-3 col-sm-3 alert alert-danger">' . "\n" .
                    '<strong>NO </strong> QSO found' . "\n" .
                    '</div>';
                break;
            case 1:
                echo '<div class="hidden-xs col-md-3 col-sm-3 alert alert-info">' . "\n" .
                    '<strong>' . $qso_amount . '</strong> QSO found' . "\n" .
                    '</div>';

                break;
            default:
                echo '<div class="col-sm-2 col-md-3 hidden-xs alert alert-info">' . "\n" .
                    '<strong>' . $qso_amount . '</strong> QSOs found' . "\n" .
                    '</div>';
        }

        ?>

    </div>

    <?php
    ?>
    <?php include("inc/qsotable.php"); ?>

    <script src="inc/js/addshortcuts.js" type="text/javascript" name="addshortcuts/addshortcuts"></script>
    <?php include("inc/metafooter.php"); ?>
</body>

</html>