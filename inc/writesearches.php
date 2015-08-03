<?php
$count_searches = ("searches.txt");
$searches = file($count_searches);
$searches[0] ++;
$fp = fopen($count_searches , "w");
fputs($fp , "$searches[0]");
fclose($fp);
?>