<?php
require('class.php');


$count = $_GET['count'];
$sleep = 10;
$i = new instaCreator();
$i->userCreate($count,$sleep);
