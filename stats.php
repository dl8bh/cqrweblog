<?php
include("config_defaults.php");
include("config.php");
include("inc/header.php");
include("inc/parse_stats.php");
?>

<!DOCTYPE html> 
<html>
<head>
<?php 
echo '<title>' . strtoupper(logid_to_call($log_id)) . ' \'s DXCC statistics</title>';
include("inc/metaheader.php");
?>
</head>
<body style="overflow:auto;">

<?php
$statsactive=true;
include("inc/navbar.php");
echo '<h1 align="center">DXCC statistics of ' . strtoupper(logid_to_call($log_id)) . '</h1><br /><br />';
include("inc/stats_input.php");
include("inc/stats_proc.php");
include("inc/dxccstats.php");
include("inc/metafooter.php");

?>

</body>
</html>
