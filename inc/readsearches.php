<?php
$count_searches = ("searches.txt");
$searches = file($count_searches);
// counting starts with one
echo $searches[$log_id-1];
?>
