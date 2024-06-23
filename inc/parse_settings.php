<?php
// Parse Input
//print_r($_POST);

if (isset($_POST["cluster_spot_count"])) {
    $cluster_spot_count = htmlentities($_POST["cluster_spot_count"]);
    $Userconfig->set_cluster_spot_number($cluster_spot_count);
}

$modearray = array();
if (isset($_POST["cluster_cw_enabled"])) {
    array_push($modearray, "CW");
}
if (isset($_POST["cluster_ssb_enabled"])) {
    array_push($modearray, "SSB");
}
if (isset($_POST["cluster_rtty_enabled"])) {
    array_push($modearray, "RTTY");
}
$Userconfig->set_cluster_modes($modearray);

if (isset($_POST["enabled_bands"])) {
    $Userconfig->set_cluster_bands($_POST["enabled_bands"]);
}
if (isset($_POST["pubsearch_settings"])) {
    $pubsearch_settings = $_POST["pubsearch_settings"];
    if (in_array("pubsearch_enabled", $pubsearch_settings)) {
        $Userconfig->enable_pubsearch();
    } else {
        $Userconfig->disable_pubsearch();
    }
    if (in_array("pubsearch_qslr_visible", $pubsearch_settings)) {
        $Userconfig->enable_pubqslr();
    } else {
        $Userconfig->disable_pubqslr();
    }
    if (in_array("pubsearch_qsls_visible", $pubsearch_settings)) {
        $Userconfig->enable_pubqsls();
    } else {
        $Userconfig->disable_pubqsls();
    }
}
