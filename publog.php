<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
?>
<html>

<head>
    <title>Logbook</title>
    <style type="text/css">
        .hl {
            font-size: 12pt;
            font-style: italic;
            color: blue;
        }
    </style>
    <meta charset="UTF-8">
    <?php include("inc/metaheader.php"); ?>
</head>

<body>

    <?php
    include("inc/logbook.php");
    $Logbook = new Logbook($DbSpawner->newdb(), $log_id);
    $where = array();
    if ($publog_enabled) {
        $publog = true;
        if ($qso_count > $max_public_count) {
            $qso_count = $max_public_count;
        }
        echo '<h1 align="center">Last ' . $qso_count . ' QSOs of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />' . "\n";
        if ($pubsearch_enabled) {
            include("inc/pubsearch_input.php");
        }

        if ($Userconfig->get_searchcount_enabled()) {
    ?>
            </br>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="alert alert-info col-sm-4">
                    There have been <?php echo $Userconfig->get_searchcount(); ?> searches from <?php echo count_qsos($log_id); ?> QSOs in Log.
                </div>
            </div>
        <?php
        } else {
        ?>
            </br>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="alert alert-info col-sm-4">
                    <?php echo    count_qsos($log_id); ?> QSO in Log
                </div>
            </div>
    <?php
        }
        include("inc/pubqsotable.php");
    } else {
        echo '<h1 align="center">Publog not enabled</h1><br /><br />' . "\n";
    }
    ?>

    <p align="center"><a href="http://www.dl8bh.de/cqrweblog/">cqrweblog</a>, a simple webinterface for <a href="http://cqrlog.com">CQRLOG</a></p>

</body>

</html>