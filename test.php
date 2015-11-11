<?php 
date_default_timezone_set("UTC"); 
echo "UTC:".time(); 
echo "\n"; 

date_default_timezone_set("Europe/Helsinki"); 
echo "Europe/Helsinki:".time(); 
echo "\n"; 
?>
