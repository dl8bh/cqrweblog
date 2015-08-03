<?php
$count_searches = ("searches.txt");
$searches = file($count_searches);
echo $searches[0];
?>