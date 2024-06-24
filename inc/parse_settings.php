<?php
// Parse Input
if (isset($_POST["cluster_skimmer_mode"])) {
    $cluster_enabled = (int) $_POST["cluster_skimmer_mode"];
    $Userconfig->set_cluster_skimmer_mode($cluster_enabled);
}

if (isset($_POST["cluster_spot_count"])) {
    $cluster_spot_count = htmlentities($_POST["cluster_spot_count"]);
    $Userconfig->set_cluster_spot_number($cluster_spot_count);
}
if (isset($_POST["cluster_mode_settings"])) {
    $cluster_mode_settings = $_POST["cluster_mode_settings"];
    $Userconfig->set_cluster_modes($cluster_mode_settings);
}

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
