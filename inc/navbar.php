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
                        if ($page == "index") {
                            echo '<li><a href="index.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        } else if ($page == "logsearch") {
                            echo '<li><a href="logsearch.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        } else if ($page == "stats") {
                            echo '<li><a href="stats.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        } else if ($page == "settings") {
                            echo '<li><a href="settings.php?log_id=' . $log_nr . '">' . $log_name . '</a></li>' . "\n";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li<?php if ($page == "index") {echo ' class="active"'; } ?>>
                    <a href="<?php echo $cqrweblog_root . 'index.php?log_id=' . $log_id ?>">Log</a>
                </li>
                <li<?php if ($page == "logsearch") {echo ' class="active"'; } ?>>
                    <a href="<?php echo $cqrweblog_root . 'logsearch.php?log_id=' . $log_id ?>">Search / Export</a>
                </li>
                <li<?php if ($page == "stats") {echo ' class="active"'; }?>>
                    <a href="<?php echo $cqrweblog_root . 'stats.php?log_id=' . $log_id; ?>">Statistics</a>
                </li>
                <li class="hidden-xs">
                    <a href="<?php echo $cqrweblog_root . 'publog.php?log_id=' . $log_id; ?>">Public</a>
                </li>
                <li <?php if ($page == "settings") { echo 'class="active"'; } ?>>
                        <a href="<?php echo $cqrweblog_root . 'settings.php?log_id=' . $log_id; ?>">Settings</a>
                </li>
                <li>
                    <a href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>