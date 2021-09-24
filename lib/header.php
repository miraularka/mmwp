<?php

/*
	Header for Mirau's Modular Website Platform
	This should be required on all pages before body content
*/

session_start();

$alert = [
		'type' => "info", /* success danger warning info */
		'msg' => NULL
		];

if ($_POST['log']){
	include "lib/login.php";
}
if ($_POST['out']){
	session_unset();
	$alert['type'] = "info";
	$alert['msg'] = "Successfully logged out.";
}

$page_title = "LarkaNet Test Environ";

if ($_SESSION['logged'] === TRUE) {
	$user = [
		'id' => $_SESSION['id'],
		'uid' => $_SESSION['uid'],	
		'name' => $_SESSION['name'],
		'nick' => $_SESSION['nick'],
		'power' => $_SESSION['power'],
		'color' => $_SESSION['color'],
		'keyc' => $_SESSION['keyc']
	];
	$page_title .= " (".$user['name'].")";
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myAlert").alert("close");
			});
		});
</script>
  </head>
  <body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3 top-panel">
    		<div class="container-fluid">
        		<a href="#" class="navbar-brand mr-3"><div class="logo d-none d-md-block mr-3"></div><span style="color:#F2F2F2">LarkaNet Primer</span></a>
        		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            			<span class="logo"></span>
        		</button>
        		<div class="collapse navbar-collapse" id="navbarCollapse">
            			<div class="navbar-nav">
							<?php 
							if ($_SESSION['logged'] === TRUE) { echo "<a href=\"#\" class=\"nav-item nav-link\">Profile</a>";} ?>
							<a href="#" class="nav-item nav-link">News</a>
                			<a href="#" class="nav-item nav-link">Servers</a>
                			<a href="#" class="nav-item nav-link">Discord</a>
            			</div>
            			<div class="navbar-nav ml-auto">
						<?php
						if ($_SESSION['logged'] === TRUE) {
							echo "<form action=\"#\" method=post><div class=\"row align-items-center g-3\"><div class=\"col-auto\">
								<input type=\"hidden\" id=\"out\" name=\"out\" value=TRUE><button type=\"submit\" class=\"btn btn-primary\" >
								Logout</button></div></div></form>";
						} else {
							echo "<form action=\"#\" method=post><div class=\"row align-items-center g-3\"><div class=\"col-auto\">
									<input type=\"text\" class=\"form-control\" id=\"usr\" name=\"usr\" placeholder=\"Username\" required></div><div class=\"col-auto\">
									<input type=\"password\" class=\"form-control\" id=\"pwd\" name=\"pwd\" placeholder=\"Password\" required></div><div class=\"col-auto\">
									<input type=\"hidden\" id=\"log\" name=\"log\" value=TRUE><button type=\"submit\" class=\"btn btn-primary\" >Login</button></div></div></form>";
						}
						?>
            			</div>
        		</div>
    		</div>    
	</nav>
	<div class="keychain swing d-none d-md-block"><img src="/img/keychaintest.png"><div class="keychain-key swing d-none d-md-block"><img src="/img/jonib.png" style="height:48px;"></div></div>
	<div class="container">
<?php
if (isset($alert['msg'])){
echo "<div class=\"alert alert-".$alert['type']." alert-dismissible fade show\">".$alert['msg']."<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>";
}
?>