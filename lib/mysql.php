<?php

$handle = fopen("config/settings.conf", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
		$words = explode(" ", $line);
		if ($words[0] == "address"){
			$dbadd = $words[1];
		}
		if ($words[0] == "user"){
			$dbuser = $words[1];
		}
		if ($words[0] == "pass"){
			$dbpwd = $words[1];
		}
		if ($words[0] == "name"){
			$dbnom = $words[1];
		}
    }
    fclose($handle);
}

$mysqli = new mysqli($dbadd, $dbusr, $dbpwd, $dbnom);

?>