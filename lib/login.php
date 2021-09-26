<?php

/*
	Login schema for Mirau's Modular Website Platform
	
*/

require "config/settings.php";
require "lib/functions.php";

$usr = $_POST['usr'];
$pwd = $_POST['pwd'];

$sql = "SELECT name FROM user ORDER BY id ASC";
$result = $mysqli->query($sql);
$valid = FALSE;
foreach ($result as $row) {
	if ($row['name'] == $usr){
		$valid = TRUE;
	}
}

if ($valid === TRUE){
	$sql = "SELECT secret FROM user WHERE name='".$usr."'";
	$result = $mysqli->query($sql);
	foreach ($result as $row) {
		if($row['secret'] === hash(sha256, $pwd)) {
				$sql = "SELECT * FROM user WHERE name='".$usr."'";
				$info = $mysqli->query($sql);
				foreach ($info as $user) {
					$alert['type'] = "success";
					$alert['msg'] = "Logged in as <strong>".$user['name']." (".$user['nick'].") successfully!";
					$_SESSION['id'] = $user['id'];
					$_SESSION['uid'] = $user['uid'];
					$_SESSION['name'] = $user['name'];
					$_SESSION['nick'] = $user['nick'];
					$_SESSION['power'] = $user['power'];
					$_SESSION['color'] = $user['color'];
					$_SESSION['keyc'] = $user['keyc'];
					$_SESSION['logged'] = TRUE;
				}
		} else {
				$valid = FALSE;
		}
	}	
}

if ($valid === FALSE){
	$alert['type'] = "danger";
	$alert['msg'] = "Account name or password are invalid.";
	session_unset();
}
