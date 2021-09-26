<?php

/*
	Login schema for Mirau's Modular Website Platform
	
*/
echo "phase 1 complete</br>";
$usr = $_POST['usr'] ?? 'none';
$pwd = $_POST['pwd'] ?? 'none';
$sql = "SELECT * FROM `user` WHERE name='".$usr."'";
echo "phase 2 complete</br>";
require "lib/mysql.php";
$valid = FALSE;
$result = $mysqli->query($sql);
echo "phase 3 complete</br>";
foreach ($result as $rows){
	echo "phase 3.1 complete</br>";
	echo "User is: ".$usr." and Pwd: ".$pwd."</br>";
	echo var_dump($rows)."</br>";
	echo hash(sha256, $pwd)."</br>";
	echo $rows['secret']."</br>";
	if($rows['secret'] == hash(sha256, $pwd)) {
			echo "phase 3.2 compelte</br>";
			$alert['type'] = "success";
			$alert['msg'] = "Logged in as <strong>".$rows['name']." (".$rows['nick'].") successfully!";
			$_SESSION['id'] = $rows['id'];
			$_SESSION['uid'] = $rows['uid'];
			$_SESSION['name'] = $rows['name'];
			$_SESSION['nick'] = $rows['nick'];
			$_SESSION['power'] = $rows['power'];
			$_SESSION['color'] = $rows['color'];
			$_SESSION['keyc'] = $rows['keyc'];
			$_SESSION['logged'] = TRUE;
			$valid = TRUE;
	}
}
echo "phase 4 complete</br>";
if ($valid === FALSE){
	$alert['type'] = "danger";
	$alert['msg'] = "Account name or password are invalid.";
	session_unset();
}
