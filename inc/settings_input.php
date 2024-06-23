<?php
echo '<form class="form" role="form" action="settings.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post">';
//print_r($_POST);
?>
<div class="row">

    <div class="col-md-1 "></div>
    <div class="col-md-10 col-sm-10 col-xs-12">


        <div class="form-group col-md-1 col-sm-2 col-xs-3">
            <label for="cluster_spot_count" class="control-label"># of spots</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="cluster_spot_count" value="<?php echo ($Userconfig->get_cluster_spot_number()) ?>" type="text" maxlength="55" size="15" name="cluster_spot_count" data-toggle="tooltip" title="use n for number of spots, 0 for cluster disable">
        </div>
        <div class="form-group col-md-2 col-sm-2 col-xs-6">
            <label for="cluster_mode" class="control-label">Cluster Mode</label>
            <?php
            $skimmer_mode = $Userconfig->get_cluster_skimmer_mode();
            $select_options = "";
            if ($skimmer_mode == 0) {
                $select_options .= '<option value="0" selected>Cluster disabled</option>';
            } else {
                $select_options .= '<option value="0">Cluster disabled</option>';
            }
            if ($skimmer_mode == 1) {
                $select_options .= '<option value="1" selected>Cluster only</option>';
            } else {
                $select_options .= '<option value="1">Cluster only</option>';
            }
            if ($skimmer_mode == 2) {
                $select_options .= '<option value="2" selected>Skimmer only</option>';
            } else {
                $select_options .= '<option value="2">Skimmer only</option>';
            }
            if ($skimmer_mode == 3) {
                $select_options .= '<option value="3" selected>Skimmer and Cluster</option>';
            } else {
                $select_options .= '<option value="3">Skimmer and Cluster</option>';
            }



            ?>
            <select class="form-control" id="band" name="band">
                <?php
                echo $select_options;
                ?>
            </select>
        </div>
        <?php
        $enabled_modes = $Userconfig->get_cluster_modes();
        ?>
        <div class="form-group col-sm-1 col-xs-4">
            <label for="cluster_modes" class="control-label">Cluster Modes</label>
            <div id="Cluster Modes">
                <div class="checkbox">
                    <label><input type="checkbox" name="cluster_cw_enabled" value="true"<?php if (in_array("CW", $enabled_modes)) {echo " checked";}?>>CW</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cluster_ssb_enabled" value="true"<?php if (in_array("SSB", $enabled_modes)) {echo " checked";}?>>SSB</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="cluster_rtty_enabled" value="true"<?php if (in_array("RTTY", $enabled_modes)) {echo " checked";}?>>RTTY / DATA</label>
                </div>

            </div>
        </div>
        <div class="form-group col-sm-1 col-xs-4">
            <label for="cluster_bands" class="control-label">Cluster Bands</label>
            <div id="Cluster Bands">
                <?php
                $enabled_bands = $Userconfig->get_cluster_bands();
                foreach ($Cqrlog_common->get_band_list() as $band) {
                    if(in_array($band[0], $enabled_bands)) {
                    }
                ?>
                    <div class="checkbox">
                        <label><input type="checkbox" name="enabled_bands[]; ?>_enabled" value="<?php echo $band; ?>"<?php if (in_array($band, $enabled_bands)) {echo " checked";} ?>><?php echo $band ?></label>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>


        <div class="form-group col-sm-2 col-xs-4">
            <label for="pubsearch" class="control-label">Public Search</label>
            <div id="pubsearch">
                <div class="checkbox">
                    <label><input type="checkbox" name="pubsearch_enable" value="pubsearch_enable"<?php if ($Userconfig->get_pubsearch_enabled()) {echo " checked";}?>>Public Search Enabled</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="pubsearch_qslr_visible" value="pubsearch_qslr_visible"<?php if ($Userconfig->get_pubqslr_enabled()) {echo " checked";}?>>QSL Received public visible</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="pubsearch_qsls_visible" value="pubsearch_qsls_visible"<?php if ($Userconfig->get_pubqsls_enabled()) {echo " checked";}?>>QSL Sent visible</label>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-sm-1"></div>
    </div>

    <div class="row">

        <div class="col-md-5 col-sm-5 col-xs-4"></div>
        <div class="col-md-2 col-sm-2 col-xs-4">
            <input class="btn btn-primary col-sm-12 col-xs-12 " type="submit" value="Save">
        </div>
    </div>
    </form>