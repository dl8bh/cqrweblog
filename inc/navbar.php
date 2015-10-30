<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    <div class="dropdown navbar-brand">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Log
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
		<?php
		$ergebnis = mysqli_query($dbconnect, "SELECT log_nr, log_name FROM log_list");
		while($row = mysqli_fetch_object($ergebnis))
		{
				$log_nr = $row->log_nr;
				$log_name = $row->log_name;
				if (isset($logactive)) {
					echo '<li><td><a href=index.php?log_id=' . $log_nr . '>' . $log_name . '</a></li>' . "\n";
				}
				else if (isset($searchactive)) {
					echo '<li><td><a href=logsearch.php?log_id=' . $log_nr . '>' . $log_name . '</a></li>' . "\n";
				}
				else if (isset($statsactive)) {
				if ($altstats[$log_nr]) {
					echo '<li><td><a href=stats2.php?log_id=' . $log_nr . '>' . $log_name . '</a></li>' . "\n";
				}
				else {
					echo '<li><td><a href=stats.php?log_id=' . $log_nr . '>' . $log_name . '</a></li>' . "\n";
				}

				}
		}
		?>
    </ul>
  </div> 
 <!--			<a class="navbar-brand" href="
		<?php echo $cqrweblog_root . '/'  ?>
			">Index</a>-->
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li 
					<?php if (isset($logactive)) { echo 'class="active"';}?>
				><a href="
					<?php echo $cqrweblog_root.'index.php?log_id=' . $log_id ?>
				">Log</a></li>
        <li
					<?php if (isset($searchactive)) { echo 'class="active"';}?>
				><a href="
				<?php echo $cqrweblog_root.'logsearch.php?log_id=' . $log_id ?>
				">Search / Export</a></li>
        <li
					<?php if (isset($statsactive)) { echo 'class="active"';}?>
				><a href="
				<?php
				if ($altstats[$log_id]) {
						echo $cqrweblog_root.'stats2.php?log_id=' . $log_id ;
				}
				else {
						echo $cqrweblog_root.'stats.php?log_id=' . $log_id ;
				}

				?>
				">Statistics</a></li>
        <li><a href="
				<?php echo $cqrweblog_root.'publog.php?log_id=' . $log_id ; ?>
				">Public</a></li>
				<li><a href="
				<?php echo $cqrweblog_root.'logold.php?log_id=' . $log_id ; ?>
				">Classic View</a></li>
			</ul>
    </div>
  </div>
</nav>
