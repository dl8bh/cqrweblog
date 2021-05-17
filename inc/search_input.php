<?php
echo '<form class="form" role="form" action="logsearch.php?log_id=' . $log_id . '&qso_count=' . $qso_count . '" method="post">'
?>
<div class="row">

    <div class="col-md-1 "></div>
    <div class="col-md-10 col-sm-10 col-xs-12">

        <div class="form-group col-md-2 col-sm-2 col-xs-6">
            <label for="band" class="control-label">Band</label>
            <select class="form-control" id="band" name="band">
                <?php
                echo '<option>select</option>';
                $dbconnect->select_db("cqrlog_common");
                $ergebnis = mysqli_query($dbconnect, "SELECT band FROM bands order by b_begin asc");
                while ($row = mysqli_fetch_object($ergebnis)) {
                    $band_in = $row->band;
                    echo '<option>' . $band_in . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group col-md-2 col-sm-3 col-xs-6">
            <label for="callsign" class="control-label">Callsign</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="callsign" type="text" maxlength="55" size="15" name="call" data-toggle="tooltip" title="use % as wildcard">
        </div>

        <div class="form-group col-md-1 col-sm-2 col-xs-6">
            <label for="dxcc" class="control-label">DXCC</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="dxcc" type="text" maxlength="55" size="15" name="dxcc">
        </div>

        <div class="form-group col-md-1 col-sm-2 col-xs-6">
            <label for="mode" class="control-label">Mode</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="mode" type="text" name="mode" size="5" value="" maxlength="7">
        </div>

        <div class="form-group col-md-2 col-sm-3 col-xs-6">
            <label for="name" class="control-label">Name</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="name" type="text" name="name" maxlength="55" data-toggle="tooltip" title="use % as wildcard">
        </div>

        <div class="form-group col-md-2 col-sm-3 col-xs-6">
            <label for="remarks" class="control-label">Remarks</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="remarks" type="text" name="remarks" maxlength="55" data-toggle="tooltip" title="use % as wildcard">
        </div>

        <div class="form-group col-md-2 col-sm-3 col-xs-6">
            <label for="locator" class="control-label">Locator</label>
            <input onClick="this.setSelectionRange(0,this.value.length)" class="form-control" id="locator" type="text" name="locator" maxlength="55" data-toggle="tooltip" title="use % as wildcard">
        </div>

    </div>
    <div class="col-md-1 col-sm-1"></div>
</div>

<div class="row">

    <div class="col-md-5 col-sm-5 col-xs-4"></div>
    <div class="col-md-2 col-sm-2 col-xs-4">
        <div class"checkbox">
            <label><input type="checkbox" name="adif_export" value="export">Export ADIF</label>
        </div>
        <input class="btn btn-primary col-sm-12 col-xs-12 " type="submit" value="Search">
    </div>
</div>
<?php
if ($inlog) {
    echo '<div align="center"> <a href="javascript:window.close();" class="btn btn-warning visible-xs visible-xm ">Close window</a></div>';
    echo '<input type="hidden" name="inlog" value="1">';
}
?>
</form>