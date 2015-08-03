<?php
$count_searches = ("searches.txt");
$searches = file($count_searches);
$newcount=$searches[$log_id-1]+1;
array_splice($searches, ($log_id - 1), 1, $newcount . "\n");
$string = implode("",$searches);
file_put_contents("searches.txt", $string);
?>
