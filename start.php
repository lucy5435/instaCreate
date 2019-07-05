<?php
require('class.php');
@set_time_limit(0);
@clearstatcache();
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);

$count = 1;
$sleep = 10;
$i = new instaCreator();
$i->userCreate($count,$sleep);
