<?php

/*
	Installer Interface for Mirau's Modular Website Platform
	This should be deleted after installed!
*/

$ver = "0.0.2";
$page = $_POST['page'] ?? 1;
$page_title = "Mirau Modular Website System -Installer- v".$ver;

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
	<div class="container pt-4">
<?php
if (isset($alert['msg'])){
echo "<div class=\"alert alert-".$alert['type']." alert-dismissible fade show\">".$alert['msg']."<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>";
}
?>

<div class="jumbotron container-fluid" style=" padding-bottom: 8px;">


<?php 
if($page == 1) {
	
    echo "<h1>Mirau's Modular Website Platform™</h1>
			<sup>Yeah so this isn't actually trademarked, but that's our secret!</br></br></sup>
		<p>
		Welcome to the installer for MMWP. This installer was built to automatically create and populate the tables required for MMWP to function properly. Do keep in mind that this is an early alpha release of this platform, and as such you may encounter:
		<ul>
			<li>Unresponsive or incorrectly marked hyperlinks</li>
			<li>Non-optimized code with slowdowns in various areas</li>
			<li>Incompatibilities with current trending devices</li>
			<li>Generally lacking planned features not yet fully implemented</li>
			<li>Environment and control displacement at irregular intervals</li>
			<li>A mostly unpolished, yet constantly improving, experience</li>
		</ul>
		</p>
	<div class=\"container-fluid\" style=\"text-align:right;\">Thanks for using MMWP!<br />~ The MMWP Team</div>
	<hr>
	<form action=\"#\" method=post style=\"text-align:center;\">
	<input type=\"hidden\" id=\"page\" name=\"page\" value=2>
	<input type=\"hidden\" id=\"complete\" name=\"complete\" value=1>
	<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Begin Installation -</button>
	</form>
	<hr>
	<div class=\"text-center small\">- ver ".$ver." - Latest version of MMWP is available in the <a href=\"https://github.com/miraularka/mmwp\">GitHub Repo</a> -</div>";
}
if($page == 2) {
	echo "<h3>Getting Started...</h3>
	<p>There are a few requirements we need to make sure are met before attemping this installation:
	<ul>
		<li>PHP 8.0.10+</li>
		<li>mysqli extension for PHP</li>
		<li>MariaDB 10.0.28+ (Protocol ver 10)</li>
		<li>a dedicated database</li>
	</ul>
	The installation may succeed even without these, however the Discord bot that ties this system together requires PHP 8.0.10 for most functions to work consistently (i.e.without crashing).  Unfortunately, support will not be provided for outdated tools.</br></br> You can check your PHP version by running <kbd>PHP -v</kbd> in a terminal. </br>You can check your mysql version by running <kbd>mysql -V</kbd> in a terminal.</p>
	<hr>
	<form action=\"#\" method=post style=\"text-align:center;\">
	<input type=\"hidden\" id=\"page\" name=\"page\" value=3>
	<input type=\"hidden\" id=\"complete\" name=\"complete\" value=1>
	<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Next -</button>
	</form>
	<hr>
	";
}
if($page == 3) {
	echo "<h3>Database Configuration...</h3>
	<p>Enter the SQL Database credentials to give the installer access to build the appropriate tables.</p>
	<form action=\"#\" method=post style=\"text-align:center;\">
	<input type=\"text\" class=\"form-control\" id=\"dbadd\" name=\"dbadd\" placeholder=\"Server Address\" required>
	<input type=\"text\" class=\"form-control\" id=\"dbnom\" name=\"dbnom\" placeholder=\"Database Name\" required>
	<input type=\"text\" class=\"form-control\" id=\"dbusr\" name=\"dbusr\" placeholder=\"Username\" required>
	<input type=\"password\" class=\"form-control\" id=\"dbpwd\" name=\"dbpwd\" placeholder=\"Password\" required>
	<input type=\"hidden\" id=\"page\" name=\"page\" value=4>
	<input type=\"hidden\" id=\"complete\" name=\"complete\" value=1><hr>
	<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Next -</button>
	</form>
	<hr>
	";
}
if($page == 4) {
	$dbadd = $_POST['dbadd'];
	$dbusr = $_POST['dbusr'];
	$dbpwd = $_POST['dbpwd'];
	$dbnom = $_POST['dbnom'];	
	$test = @mysqli_connect($dbadd, $dbusr, $dbpwd, $dbnom);

	if (!$test) {
		echo "<p>Connection error! We were unable to connect to the database using the provided credentials.</p>
		<form action=\"#\" method=post style=\"text-align:center;\">
		<input type=\"hidden\" id=\"page\" name=\"page\" value=3>
		<input type=\"hidden\" id=\"complete\" name=\"complete\" value=1><hr>
		<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Back -</button>
		</form>
		<hr>
		";
	} else {
		echo "<p>Connection successful! Click - Next - to create the necessary tables and populate them.</p>
		<form action=\"#\" method=post style=\"text-align:center;\">
		<input type=\"hidden\" class=\"form-control\" id=\"dbadd\" name=\"dbadd\" value=".$dbadd.">
		<input type=\"hidden\" class=\"form-control\" id=\"dbnom\" name=\"dbnom\" value=".$dbnom." >
		<input type=\"hidden\" class=\"form-control\" id=\"dbusr\" name=\"dbusr\" value=".$dbusr." >
		<input type=\"hidden\" class=\"form-control\" id=\"dbpwd\" name=\"dbpwd\" value=".$dbpwd." >
		<input type=\"hidden\" id=\"page\" name=\"page\" value=5>
		<input type=\"hidden\" id=\"complete\" name=\"complete\" value=3><hr>
		<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Next -</button>
		</form>
		<hr>
		";
	}
}
if($page == 5) {
	$dbadd = $_POST['dbadd'];
	$dbusr = $_POST['dbusr'];
	$dbpwd = $_POST['dbpwd'];
	$dbnom = $_POST['dbnom'];
	$mysqli = new mysqli($dbadd, $dbusr, $dbpwd, $dbnom);
	$sql = "SELECT uid FROM user";
	$result = $mysqli->query($sql);
	$exists = FALSE;
	if($result){
		$exists = TRUE;	
	}
	if($exists === FALSE){
		echo "Table space allocated and ready to be built. Test account 'admin' will be created with the following password...";
	} else {
		echo "Table already exists! To continue allocating required space, the current mmwp table will be deleted - including all stored data. Test account 'admin' will be created with the following password...";
	}	
	echo "
		<form action=\"#\" method=post style=\"text-align:center;\">
		<input type=\"hidden\" class=\"form-control\" id=\"dbdrp\" name=\"dbdrp\" value=".$exists.">
		<input type=\"hidden\" class=\"form-control\" id=\"dbadd\" name=\"dbadd\" value=".$dbadd.">
		<input type=\"hidden\" class=\"form-control\" id=\"dbnom\" name=\"dbnom\" value=".$dbnom." >
		<input type=\"hidden\" class=\"form-control\" id=\"dbusr\" name=\"dbusr\" value=".$dbusr." >
		<input type=\"hidden\" class=\"form-control\" id=\"dbpwd\" name=\"dbpwd\" value=".$dbpwd." >
		<input type=\"hidden\" id=\"page\" name=\"page\" value=6>
		<input type=\"hidden\" id=\"complete\" name=\"complete\" value=10><hr>
		<input type=\"password\" class=\"form-control\" id=\"adminpwd\" name=\"adminpwd\" placeholder=\"Admin Password\" required>
		<button type=\"submit\" class=\"btn btn-success btn-lg \" >- Next -</button>
		</form>
		<hr>
	";
}
if($page == 6) {
	$exists = $_POST['dbdrp'];
	$dbadd = $_POST['dbadd'];
	$dbusr = $_POST['dbusr'];
	$dbpwd = $_POST['dbpwd'];
	$dbnom = $_POST['dbnom'];
	$adminpwd = $_POST['adminpwd'];
	$mysqli = new mysqli($dbadd, $dbusr, $dbpwd, $dbnom);
	if($exists === TRUE){
		$sql = "DROP TABLE user";
		$mysqli->query($sql);
	}
	$sql = "CREATE TABLE user (
     id INT NOT NULL AUTO_INCREMENT,
     name TEXT NOT NULL,
	 uid TEXT NOT NULL,
	 nick TEXT NULL,
	 secret TEXT NOT NULL,
	 ip TEXT NOT NULL,
	 power INT NOT NULL,
	 title TEXT NULL,
	 mail TEXT NULL,
	 avatar TEXT NULL,
	 avatarb TEXT NULL,
	 color INT NULL,
	 reg_date DATE NOT NULL,
	 keyc TEXT NULL,
	 flair TEXT NULL,
     PRIMARY KEY (id))";
		$mysqli->query($sql);
		$adminpwdh = hash('sha256', $adminpwd);
		$sql = "INSERT INTO user (name, nick, uid, ip, secret, power, reg_date) VALUES ('admin', 'Test Admin', '1337', '".$_SERVER['REMOTE_ADDR']."', '".$adminpwdh."', 4, '".date('Y-m-d')."')";
		$mysqli->query($sql);
		/* Make sure we save the database connection info */
		$settingsfile = fopen('config/settings.conf', 'w'); 
		fwrite ($settingsfile, $dbadd.PHP_EOL);
		fwrite ($settingsfile, $dbusr.PHP_EOL);
		fwrite ($settingsfile, $dbpwd.PHP_EOL);
		fwrite ($settingsfile, $dbnom);
		fclose($settingsfile);
		
		
	echo "<h1>Installation Complete</h1><p>Table successfully built. Test account 'admin' created. Settings configuration file created and populated. The website backend is setup. The only remaining thing to do is to configure the bot by copying the '/config/settings.conf' file to the same directory as your 'RBot.php' so it can read the database (and setup the bot token if you have not yet done so also). You should rename or delete this file as soon as possible for safety. Enjoy using MMWP!</p>";
}

?>
</div>
		<footer>
        	<div class="row">
            		<div class="col">
                		<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: <?php echo $_POST['complete'] ?>0%"></div>
						</div>
            		</div>
        	</div>
    		</footer>
	</div>
  <script type="text/javascript" src="/js/particles.js"></script>
  <script type="text/javascript" src="/js/app.js"></script>
  <script src="/js/main.js"></script>
  </body>
</html>