<?php
echo '<form class="form" role="form" action="import.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post", enctype="multipart/form-data">'
?>
<div class="row">

    <div class="col-md-5 col-sm-5 col-xs-4"></div>
    <div class="col-md-2 col-sm-2 col-xs-4">

        <div class="form-group col-md-15 col-sm-13 col-xs-16">
            <label for="import_adif_file" class="control-label">File Upload</label>
            <input class="form-control" type="file" id="import_adif_file" name="import_adif_file">

        </div>



    </div>
    <div class="col-md-1 col-sm-1"></div>
</div>

<div class="row">

    <div class="col-md-5 col-sm-5 col-xs-4"></div>
    <div class="col-md-2 col-sm-2 col-xs-4">
        <div class"checkbox">
            <label><input type="checkbox" name="ignore_dupes" value="ignore_dupes">Ignore Dupes</label>
        </div>
        <input class="btn btn-primary col-sm-12 col-xs-12 " type="submit" value="Import">
    </div>
</div>

</form>