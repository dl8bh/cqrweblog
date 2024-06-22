<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_settings.php");
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    $settingsactive = true;

    echo '<title>' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . ' \'s Settings</title>'
    ?>
    <link rel="stylesheet" type="text/css" href="inc/css/logold.css">
    <meta charset="UTF-8">
    <?php include("inc/metaheader.php"); ?>
</head>

<body>

    <?php
    include("inc/navbar.php");
    echo '<h1 align="center">Settings of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</h1><div class="hidden-xs hidden-sm"><br /><br /></div>';
    include("inc/settings_input.php");
    include("inc/metafooter.php");

    ?>
</body>

</html>