<?php
$homepage = file_get_contents('https://api.ipify.org/?format=text');
echo $homepage;
?>