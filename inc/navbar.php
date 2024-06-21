<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="dropdown navbar-brand">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Log
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($Cqrlog_common->get_log_list() as $log) {
                        $log_nr = $log["log_nr"];
                        $log_name = $log["log_name"];
                        if (isset($logactive)) {
                            echo '<li><a href="index.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        } else if (isset($searchactive)) {
                            echo '<li><a href="logsearch.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        } else if (isset($statsactive)) {
                            echo '<li><a href="stats.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li<?php if (isset($statsactive)) {echo ' class="active"'; }?>>
                    <a href="<?php echo $cqrweblog_root . 'stats.php?log_id=' . $log_id; ?>">Statistics</a>
                </li>
                <li class="hidden-xs">
            </ul>
        </div>
    </div>
</nav>