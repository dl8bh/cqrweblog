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
echo '<title>' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . ' \'s DXCC statistics</title>';
include("inc/metaheader.php");
?>
</head>
<body>

<?php
$statsactive=true;
include("inc/navbar.php");
echo '<h1 align="center">DXCC statistics of ' . strtoupper($Cqrlog_common->logid_to_call($log_id)) . '</h1><div class="hidden-xs hidden-sm"><br /><br /></div>';
include("inc/stats_input.php");

if ($inlog){
	echo '<div align="right"> <a href="javascript:window.close();">Close window</a></div>';
}

?>

<br /><br />

<?php
include("inc/stats_proc.php");
include("inc/dxccstats.php");
include("inc/metafooter.php");?>

</body>
</html>
