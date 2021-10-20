<?php

/*
	Login schema for Mirau's Modular Website Platform
	
*/

$usr = $_POST['usr'] ?? 'none';
$pwd = $_POST['pwd'] ?? 'none';
$sql = "SELECT * FROM `user` WHERE name='".$usr."'";
require "lib/mysql.php";
$valid = FALSE;
$result = $mysqli->query($sql);
if(isset($result)){
	foreach ($result as $rows){
		if($rows['secret'] == hash('sha256', $pwd)) {
				$alert['type'] = "success";
				$alert['msg'] = "Logged in as <strong>".$rows['name']." (".$rows['nick'].") successfully!";
				$_SESSION['id'] = $rows['id'];
				$_SESSION['uid'] = $rows['uid'];
				$_SESSION['name'] = $rows['name'];
				$_SESSION['nick'] = $rows['nick'];
				$_SESSION['power'] = $rows['power'];
				$_SESSION['color'] = $rows['color'];
				$_SESSION['keyc'] = $rows['keyc'];
				$_SESSION['rep'] = $rows['rep'];
				$_SESSION['logged'] = TRUE;
				$valid = TRUE;
		}
	}
}

if ($valid === FALSE){
	$alert['type'] = "danger";
	$alert['msg'] = "Account name or password are invalid.";
	session_unset();
}
