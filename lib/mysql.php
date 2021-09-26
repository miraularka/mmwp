<?php

$words = (file("config/settings.conf"));
	$dbadd = substr($words[0], 0, -1);
	$dbuser = substr($words[1], 0, -1);
	$dbpwd = substr($words[2], 0, -1);
	$dbnom = $words[3];

$mysqli = new mysqli($dbadd, $dbuser, $dbpwd, $dbnom);

?>