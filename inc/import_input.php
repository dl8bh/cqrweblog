<?php
echo '<form class="form" role="form" action="import.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post", enctype="multipart/form-data">'
?>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="form-group col-sm-2 col-xs-4">
        <label for="import_adif_file" class="control-label">File Upload</label>
        <input class="form-control" type="file" id="import_adif_file" name="import_adif_file">
    </div>

    <div class="form-group col-sm-1 col-xs-4">

        <label for="import_settings" class="control-label">Import Settings</label>
        <div id="import_settings">

            <div class="checkbox">
                <label><input type="checkbox" name="import_settings[]" value="ignore_dupes">Ignore Dupes</label>
            </div>


        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-5"></div>
    <input class="btn btn-primary col-sm-1 col-xs-12" type="submit" value="Import">
</div>

</form>