<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
$page = basename(__FILE__, '.php');
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include("inc/logbook.php");
    $Logbook = new Logbook($DbSpawner->newdb(), $log_id);
    echo '<title>' . 'Import ADIF to logbook of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</title>'
    ?>
    <link rel="stylesheet" type="text/css" href="inc/css/logold.css">
    <meta charset="UTF-8">
    <?php include("inc/metaheader.php"); ?>
</head>

<body>

    <?php
    include("inc/navbar.php");
    echo '<h1 align="center">Import ADIF to logbook of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</h1><div class="hidden-xs hidden-sm"><br /><br /></div>';
    include("inc/import_input.php");
    include_once("inc/adif.php");
    include("inc/import_proc.php");


    ?>

    <?php
    include("inc/metafooter.php");

    ?>
</body>

</html>