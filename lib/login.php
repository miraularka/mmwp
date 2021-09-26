<?php

/*
	Login schema for Mirau's Modular Website Platform
	
*/

$usr = $_POST['usr'] ?? 'none';
$pwd = $_POST['pwd'] ?? 'none';
echo "check 1 passed";
$sql = "SELECT name FROM user ORDER BY id ASC";
$result = $mysqli->query($sql);
$valid = FALSE;
foreach ($result as $row) {
	if ($row['name'] == $usr){
		$valid = TRUE;
	}
}
echo "check 2 passed";
if ($valid === TRUE){
	$sql = "SELECT secret FROM user WHERE name='".$usr."'";
	$result = $mysqli->query($sql);
	echo "check 3 passed";
	foreach ($result as $row) {
		if($row['secret'] === hash(sha256, $pwd)) {
				echo "check 4 passed";
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
