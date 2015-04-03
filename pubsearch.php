<?php
include("inc/header.php");
include("inc/parse_search.php");
?>

<html>
<head>
<?php 
echo '<title>Am I in ' . strtoupper(logid_to_call($log_id)) . ' \'s Log</title>'
?>
<!--<link rel="stylesheet" type="text/css" href="inc/log.css">-->
<meta charset="UTF-8">
</head>
<body>

<?php
if ($pubsearch_enabled) {
$pubsearch=true;
echo '<h1 align="center">Am I in ' . strtoupper(logid_to_call($log_id)) . '\'s Log?</h1><br /><br />';
include("inc/pubsearch_input.php");
echo '<br /><br />' . "\n";

include("inc/search_proc.php");

if (!empty($call))
{
echo '<p align="right">' . count_qsos( $log_id ) . ' QSO with you in the log</p>' . "\n";
}
echo '<hr>' . "\n" . '<br><br>' . "\n" ;

if (!empty($call))
{
include("inc/qsotable.php");
}
}
else
{
		echo '<h1 align="center">Pubsearch or Publog not enabled!</h1><br /><br />' . "\n";
}
?>

</body>
</html>
